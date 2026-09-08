<?php
/**
 * Podcast & Video Feed — Spotify show embed + podcast RSS episodes + YouTube channel videos.
 *
 * How the pieces fit together:
 *
 *  - Spotify does not publish an RSS feed for a show, so the episode list is
 *    read from the podcast's *source* feed (the one the hosting platform
 *    submits to Spotify/Apple). Editors can paste that URL in the section
 *    settings. When it is left blank we try to discover it automatically:
 *    Spotify's oEmbed endpoint gives us the show title, and the iTunes Search
 *    API maps that exact title to a feedUrl. Manual URL always wins.
 *
 *  - The Spotify embed player is rendered from the show URL alone and works
 *    even when no RSS feed could be found.
 *
 *  - YouTube publishes an Atom feed per channel, keyed by channel ID. Editors
 *    can paste any channel URL (@handle, /c/, /user/, /channel/UC...); handles
 *    are resolved to the UC… ID by reading the channel page once and caching
 *    the result.
 *
 *  - All remote reads go through WordPress' feed cache (SimplePie) or
 *    transients, so page loads never wait on Spotify/YouTube more than once
 *    per cache window.
 */

const DS_PODCAST_FEED_TTL       = HOUR_IN_SECONDS;          // podcast + YouTube feed cache
const DS_PODCAST_DISCOVERY_TTL  = DAY_IN_SECONDS;           // Spotify → RSS discovery (hit)
const DS_PODCAST_DISCOVERY_MISS = 6 * HOUR_IN_SECONDS;      // Spotify → RSS discovery (miss)
const DS_PODCAST_CHANNEL_TTL    = 30 * DAY_IN_SECONDS;      // YouTube handle → channel ID
const DS_PODCAST_NS_ITUNES      = 'http://www.itunes.com/dtds/podcast-1.0.dtd';
const DS_PODCAST_NS_YT          = 'http://www.youtube.com/xml/schemas/2015';
const DS_PODCAST_NS_MEDIA       = 'http://search.yahoo.com/mrss/';

// ── Defaults (editable per section in ACF) ───────────

function ds_podcast_defaults() {
    return [
        'heading'          => 'PODCAST & VIDEO',
        'intro'            => '',
        'spotify_url'      => 'https://open.spotify.com/show/033uzGmCceJj47Lh966Oqy',
        'rss_url'          => '',
        'show_player'      => true,
        'episodes_heading' => 'LATEST EPISODES',
        'episodes_count'   => 6,
        'youtube_url'      => 'https://www.youtube.com/@mydigitalstride',
        'videos_heading'   => 'LATEST VIDEOS',
        'videos_count'     => 6,
    ];
}

// ── Spotify ──────────────────────────────────────────

/**
 * Extract the show ID from any open.spotify.com/show/... URL or spotify:show: URI.
 */
function ds_podcast_spotify_show_id( $url ) {
    $url = trim( (string) $url );
    if ( ! $url ) return '';
    if ( preg_match( '~open\.spotify\.com/(?:intl-[a-z]+/)?show/([A-Za-z0-9]{22})~i', $url, $m ) ) return $m[1];
    if ( preg_match( '~^spotify:show:([A-Za-z0-9]{22})$~', $url, $m ) ) return $m[1];
    if ( preg_match( '~^[A-Za-z0-9]{22}$~', $url ) ) return $url;
    return '';
}

function ds_podcast_spotify_show_url( $show_id ) {
    return $show_id ? 'https://open.spotify.com/show/' . rawurlencode( $show_id ) : '';
}

function ds_podcast_spotify_embed_url( $show_id ) {
    if ( ! $show_id ) return '';
    return add_query_arg(
        [ 'utm_source' => 'generator', 'theme' => 0 ],
        'https://open.spotify.com/embed/show/' . rawurlencode( $show_id )
    );
}

/**
 * Show title + artwork from Spotify's public oEmbed endpoint (no auth needed).
 */
function ds_podcast_spotify_oembed( $show_id ) {
    if ( ! $show_id ) return null;

    $key    = 'ds_pod_oembed_' . $show_id;
    $cached = get_transient( $key );
    if ( is_array( $cached ) ) return $cached;

    $res = wp_remote_get(
        add_query_arg( 'url', ds_podcast_spotify_show_url( $show_id ), 'https://open.spotify.com/oembed' ),
        [ 'timeout' => 8, 'headers' => [ 'Accept' => 'application/json' ] ]
    );
    $data = [];
    if ( ! is_wp_error( $res ) && wp_remote_retrieve_response_code( $res ) === 200 ) {
        $json = json_decode( wp_remote_retrieve_body( $res ), true );
        if ( is_array( $json ) ) {
            $data = [
                'title'     => sanitize_text_field( $json['title'] ?? '' ),
                'thumbnail' => esc_url_raw( $json['thumbnail_url'] ?? '' ),
            ];
        }
    }
    set_transient( $key, $data, $data ? DS_PODCAST_DISCOVERY_TTL : DS_PODCAST_DISCOVERY_MISS );
    return $data;
}

/**
 * Try to find the podcast's source RSS feed for a Spotify show.
 *
 * Spotify has no RSS endpoint, but the iTunes Search API returns feedUrl for
 * podcasts, and virtually every show on Spotify is also on Apple Podcasts.
 * We only accept a result whose title matches the Spotify title exactly
 * (case/punctuation-insensitive) so a same-named show can't sneak in.
 */
function ds_podcast_discover_rss( $show_id ) {
    if ( ! $show_id ) return '';

    $key    = 'ds_pod_rss_' . $show_id;
    $cached = get_transient( $key );
    if ( $cached !== false ) return (string) $cached;

    $feed   = '';
    $oembed = ds_podcast_spotify_oembed( $show_id );
    $title  = $oembed['title'] ?? '';

    if ( $title ) {
        $res = wp_remote_get(
            add_query_arg(
                [ 'term' => $title, 'media' => 'podcast', 'entity' => 'podcast', 'limit' => 25 ],
                'https://itunes.apple.com/search'
            ),
            [ 'timeout' => 8 ]
        );
        if ( ! is_wp_error( $res ) && wp_remote_retrieve_response_code( $res ) === 200 ) {
            $json = json_decode( wp_remote_retrieve_body( $res ), true );
            $want = ds_podcast_normalize_title( $title );
            foreach ( (array) ( $json['results'] ?? [] ) as $row ) {
                if ( empty( $row['feedUrl'] ) ) continue;
                if ( ds_podcast_normalize_title( $row['collectionName'] ?? '' ) === $want ) {
                    $feed = esc_url_raw( $row['feedUrl'] );
                    break;
                }
            }
        }
    }

    set_transient( $key, $feed, $feed ? DS_PODCAST_DISCOVERY_TTL : DS_PODCAST_DISCOVERY_MISS );
    return $feed;
}

function ds_podcast_normalize_title( $s ) {
    $s = strtolower( remove_accents( (string) $s ) );
    return trim( preg_replace( '/[^a-z0-9]+/', ' ', $s ) );
}

// ── Feeds (SimplePie via fetch_feed) ─────────────────

function ds_podcast_feed_ttl() {
    return DS_PODCAST_FEED_TTL;
}

/**
 * fetch_feed() with our own cache lifetime and a graceful null on failure.
 */
function ds_podcast_fetch_feed( $url ) {
    $url = esc_url_raw( trim( (string) $url ) );
    if ( ! $url ) return null;

    if ( ! function_exists( 'fetch_feed' ) ) {
        require_once ABSPATH . WPINC . '/feed.php';
    }

    add_filter( 'wp_feed_cache_transient_lifetime', 'ds_podcast_feed_ttl' );
    $feed = fetch_feed( $url );
    remove_filter( 'wp_feed_cache_transient_lifetime', 'ds_podcast_feed_ttl' );

    return is_wp_error( $feed ) ? null : $feed;
}

/**
 * Episodes from a podcast RSS feed.
 *
 * @return array[] Each: title, link, date (unix), description, audio, mime, duration, image
 */
function ds_podcast_get_episodes( $rss_url, $count = 6 ) {
    $feed = ds_podcast_fetch_feed( $rss_url );
    if ( ! $feed ) return [];

    $show_image = $feed->get_image_url();
    if ( ! $show_image ) {
        $tag = $feed->get_channel_tags( DS_PODCAST_NS_ITUNES, 'image' );
        $show_image = $tag[0]['attribs']['']['href'] ?? '';
    }

    $episodes = [];
    foreach ( $feed->get_items( 0, max( 1, (int) $count ) ) as $item ) {
        $enclosure = $item->get_enclosure();
        $audio     = $enclosure ? $enclosure->get_link() : '';
        $mime      = $enclosure ? $enclosure->get_type() : '';

        $duration = $item->get_item_tags( DS_PODCAST_NS_ITUNES, 'duration' );
        $duration = $duration[0]['data'] ?? ( $enclosure ? $enclosure->get_duration() : '' );

        $image = $item->get_item_tags( DS_PODCAST_NS_ITUNES, 'image' );
        $image = $image[0]['attribs']['']['href'] ?? '';

        $episodes[] = [
            'title'       => wp_strip_all_tags( (string) $item->get_title() ),
            'link'        => esc_url_raw( (string) $item->get_permalink() ),
            'date'        => (int) $item->get_date( 'U' ),
            'description' => wp_strip_all_tags( (string) ( $item->get_description() ?: $item->get_content() ) ),
            'audio'       => esc_url_raw( (string) $audio ),
            'mime'        => (string) $mime,
            'duration'    => ds_podcast_format_duration( $duration ),
            'image'       => esc_url_raw( (string) ( $image ?: $show_image ) ),
        ];
    }
    return $episodes;
}

/**
 * itunes:duration comes as "3600", "59:30" or "1:02:15". Normalise to "1h 02m" / "59 min".
 */
function ds_podcast_format_duration( $raw ) {
    $raw = trim( (string) $raw );
    if ( $raw === '' ) return '';

    if ( ctype_digit( $raw ) ) {
        $secs = (int) $raw;
    } else {
        $parts = array_map( 'intval', explode( ':', $raw ) );
        $secs  = 0;
        foreach ( $parts as $p ) $secs = $secs * 60 + $p;
    }
    if ( $secs <= 0 ) return '';

    $h = intdiv( $secs, 3600 );
    $m = intdiv( $secs % 3600, 60 );
    if ( $h > 0 ) return sprintf( '%dh %02dm', $h, $m );
    return sprintf( '%d min', max( 1, $m ) );
}

// ── YouTube ──────────────────────────────────────────

/**
 * Resolve any YouTube channel URL (or raw UC… ID) to the channel ID.
 * Handles /channel/UC…, @handle, /c/name, /user/name; the last three need one
 * fetch of the channel page, cached for 30 days.
 */
function ds_podcast_youtube_channel_id( $url ) {
    $url = trim( (string) $url );
    if ( ! $url ) return '';

    if ( preg_match( '~^(UC[A-Za-z0-9_-]{22})$~', $url, $m ) ) return $m[1];
    if ( preg_match( '~youtube\.com/channel/(UC[A-Za-z0-9_-]{22})~i', $url, $m ) ) return $m[1];

    if ( ! preg_match( '~youtube\.com/~i', $url ) ) return '';

    $key    = 'ds_pod_ytid_' . md5( strtolower( $url ) );
    $cached = get_transient( $key );
    if ( $cached !== false ) return (string) $cached;

    $id  = '';
    $res = wp_remote_get( $url, [
        'timeout' => 8,
        'headers' => [
            'User-Agent'      => 'Mozilla/5.0 (compatible; WordPress/' . get_bloginfo( 'version' ) . '; +' . home_url( '/' ) . ')',
            'Accept-Language' => 'en-US,en;q=0.8',
        ],
    ] );
    if ( ! is_wp_error( $res ) && wp_remote_retrieve_response_code( $res ) === 200 ) {
        $html = wp_remote_retrieve_body( $res );
        if ( preg_match( '~<meta\s+itemprop="(?:channelId|identifier)"\s+content="(UC[A-Za-z0-9_-]{22})"~i', $html, $m )
          || preg_match( '~"(?:externalId|channelId)"\s*:\s*"(UC[A-Za-z0-9_-]{22})"~', $html, $m )
          || preg_match( '~youtube\.com/channel/(UC[A-Za-z0-9_-]{22})~', $html, $m ) ) {
            $id = $m[1];
        }
    }

    set_transient( $key, $id, $id ? DS_PODCAST_CHANNEL_TTL : DS_PODCAST_DISCOVERY_MISS );
    return $id;
}

function ds_podcast_youtube_feed_url( $channel_id ) {
    return $channel_id ? 'https://www.youtube.com/feeds/videos.xml?channel_id=' . rawurlencode( $channel_id ) : '';
}

/**
 * Latest uploads from a channel's Atom feed.
 *
 * @return array[] Each: id, title, link, date (unix), description, thumbnail
 */
function ds_podcast_get_videos( $channel_id, $count = 6 ) {
    $feed = ds_podcast_fetch_feed( ds_podcast_youtube_feed_url( $channel_id ) );
    if ( ! $feed ) return [];

    $videos = [];
    foreach ( $feed->get_items( 0, max( 1, (int) $count ) ) as $item ) {
        $vid = $item->get_item_tags( DS_PODCAST_NS_YT, 'videoId' );
        $vid = $vid[0]['data'] ?? '';
        if ( ! $vid && preg_match( '~[?&]v=([A-Za-z0-9_-]{6,})~', (string) $item->get_permalink(), $m ) ) {
            $vid = $m[1];
        }
        if ( ! preg_match( '~^[A-Za-z0-9_-]{6,}$~', $vid ) ) continue;

        $group = $item->get_item_tags( DS_PODCAST_NS_MEDIA, 'group' );
        $desc  = $group[0]['child'][ DS_PODCAST_NS_MEDIA ]['description'][0]['data'] ?? '';

        $videos[] = [
            'id'          => $vid,
            'title'       => wp_strip_all_tags( (string) $item->get_title() ),
            'link'        => 'https://www.youtube.com/watch?v=' . $vid,
            'date'        => (int) $item->get_date( 'U' ),
            'description' => wp_strip_all_tags( (string) $desc ),
            'thumbnail'   => 'https://i.ytimg.com/vi/' . $vid . '/hqdefault.jpg',
        ];
    }
    return $videos;
}

// ── Render ───────────────────────────────────────────

/**
 * Render the full section. Used by the ACF flex layout and the shortcode.
 */
function ds_render_podcast_feed( $args = [] ) {
    // null = "not provided" → default; '' = editor deliberately left it blank.
    $a = wp_parse_args( array_filter( (array) $args, function ( $v ) { return $v !== null; } ), ds_podcast_defaults() );

    $show_id     = ds_podcast_spotify_show_id( $a['spotify_url'] );
    $show_url    = ds_podcast_spotify_show_url( $show_id );
    $show_player = $show_id && (bool) $a['show_player'];

    $rss_url = trim( (string) $a['rss_url'] );
    if ( ! $rss_url && $show_id ) $rss_url = ds_podcast_discover_rss( $show_id );
    $episodes = $rss_url ? ds_podcast_get_episodes( $rss_url, (int) $a['episodes_count'] ) : [];

    $channel_id  = ds_podcast_youtube_channel_id( $a['youtube_url'] );
    $channel_url = $channel_id ? 'https://www.youtube.com/channel/' . $channel_id : esc_url_raw( (string) $a['youtube_url'] );
    $videos      = $channel_id ? ds_podcast_get_videos( $channel_id, (int) $a['videos_count'] ) : [];

    $has_podcast = $show_player || $episodes;
    $has_videos  = (bool) $videos;
    $can_edit    = current_user_can( 'edit_posts' );

    if ( ! $has_podcast && ! $has_videos && ! $can_edit ) return;
    ?>
    <section class="ds-section ds-section--podcast">
        <div class="ds-container">
            <?php if ( $a['heading'] ) : ?>
                <h2 class="ds-section__heading"><?php echo esc_html( $a['heading'] ); ?></h2>
            <?php endif; ?>
            <?php if ( $a['intro'] ) : ?>
                <div class="ds-section__text ds-podcast__intro"><?php echo wp_kses_post( wpautop( $a['intro'] ) ); ?></div>
            <?php endif; ?>

            <?php if ( $can_edit ) : ?>
                <?php if ( $a['spotify_url'] && ! $show_id ) : ?>
                    <p class="ds-podcast__notice">Editor notice: the Spotify URL doesn't look like a show link (expected https://open.spotify.com/show/…).</p>
                <?php elseif ( $show_id && ! $rss_url ) : ?>
                    <p class="ds-podcast__notice">Editor notice: no RSS feed was found for this show, so only the Spotify player is shown. Paste the podcast's RSS feed URL (from your podcast host) in the "Podcast RSS Feed URL" field to list episodes.</p>
                <?php elseif ( $rss_url && ! $episodes ) : ?>
                    <p class="ds-podcast__notice">Editor notice: the RSS feed could not be read right now (<?php echo esc_html( $rss_url ); ?>).</p>
                <?php endif; ?>
                <?php if ( $a['youtube_url'] && ! $channel_id ) : ?>
                    <p class="ds-podcast__notice">Editor notice: couldn't resolve the YouTube channel ID from that URL. Paste the channel's /channel/UC… URL instead.</p>
                <?php elseif ( $channel_id && ! $videos ) : ?>
                    <p class="ds-podcast__notice">Editor notice: the YouTube feed returned no videos right now.</p>
                <?php endif; ?>
            <?php endif; ?>

            <?php if ( $has_podcast ) : ?>
            <div class="ds-podcast<?php echo $show_player ? '' : ' ds-podcast--no-player'; ?>">
                <?php if ( $show_player ) : ?>
                <aside class="ds-podcast__player">
                    <iframe
                        class="ds-podcast__embed"
                        src="<?php echo esc_url( ds_podcast_spotify_embed_url( $show_id ) ); ?>"
                        width="100%" height="352" frameborder="0"
                        allowfullscreen
                        allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture"
                        loading="lazy"
                        title="Spotify podcast player"></iframe>
                    <div class="ds-podcast__actions">
                        <a class="ds-btn ds-btn--primary" href="<?php echo esc_url( $show_url ); ?>" target="_blank" rel="noopener">
                            <i class="fa-brands fa-spotify" aria-hidden="true"></i> Follow on Spotify
                        </a>
                        <?php if ( $rss_url ) : ?>
                            <a class="ds-podcast__rss" href="<?php echo esc_url( $rss_url ); ?>" target="_blank" rel="noopener">
                                <i class="fa-solid fa-rss" aria-hidden="true"></i> RSS feed
                            </a>
                        <?php endif; ?>
                    </div>
                </aside>
                <?php endif; ?>

                <?php if ( $episodes ) : ?>
                <div class="ds-podcast__episodes">
                    <?php if ( $a['episodes_heading'] ) : ?>
                        <h3 class="ds-podcast__subheading"><?php echo esc_html( $a['episodes_heading'] ); ?></h3>
                    <?php endif; ?>
                    <ol class="ds-podcast__list">
                        <?php foreach ( $episodes as $ep ) : ?>
                            <li class="ds-episode">
                                <?php if ( $ep['image'] ) : ?>
                                    <img class="ds-episode__art" src="<?php echo esc_url( $ep['image'] ); ?>" alt="" loading="lazy" width="96" height="96">
                                <?php endif; ?>
                                <div class="ds-episode__body">
                                    <h4 class="ds-episode__title">
                                        <?php if ( $ep['link'] ) : ?>
                                            <a href="<?php echo esc_url( $ep['link'] ); ?>" target="_blank" rel="noopener"><?php echo esc_html( $ep['title'] ); ?></a>
                                        <?php else : ?>
                                            <?php echo esc_html( $ep['title'] ); ?>
                                        <?php endif; ?>
                                    </h4>
                                    <p class="ds-episode__meta">
                                        <?php if ( $ep['date'] ) : ?>
                                            <time datetime="<?php echo esc_attr( gmdate( 'c', $ep['date'] ) ); ?>"><i class="fa-regular fa-calendar" aria-hidden="true"></i> <?php echo esc_html( date_i18n( 'F j, Y', $ep['date'] ) ); ?></time>
                                        <?php endif; ?>
                                        <?php if ( $ep['duration'] ) : ?>
                                            <span><i class="fa-regular fa-clock" aria-hidden="true"></i> <?php echo esc_html( $ep['duration'] ); ?></span>
                                        <?php endif; ?>
                                    </p>
                                    <?php if ( $ep['description'] ) : ?>
                                        <p class="ds-episode__excerpt"><?php echo esc_html( wp_trim_words( $ep['description'], 32, '…' ) ); ?></p>
                                    <?php endif; ?>
                                    <?php if ( $ep['audio'] ) : ?>
                                        <audio class="ds-episode__audio" controls preload="none">
                                            <source src="<?php echo esc_url( $ep['audio'] ); ?>"<?php echo $ep['mime'] ? ' type="' . esc_attr( $ep['mime'] ) . '"' : ''; ?>>
                                        </audio>
                                    <?php endif; ?>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ol>
                </div>
                <?php endif; ?>
            </div>
            <?php endif; ?>

            <?php if ( $has_videos ) : ?>
            <div class="ds-podcast__videos">
                <?php if ( $a['videos_heading'] ) : ?>
                    <h3 class="ds-podcast__subheading"><?php echo esc_html( $a['videos_heading'] ); ?></h3>
                <?php endif; ?>
                <div class="ds-grid ds-grid--3 ds-video-grid">
                    <?php foreach ( $videos as $v ) : ?>
                        <article class="ds-video-card">
                            <div class="ds-video-card__media">
                                <button type="button" class="ds-video-card__play"
                                        data-video-id="<?php echo esc_attr( $v['id'] ); ?>"
                                        aria-label="Play: <?php echo esc_attr( $v['title'] ); ?>">
                                    <img class="ds-video-card__thumb" src="<?php echo esc_url( $v['thumbnail'] ); ?>" alt="" loading="lazy" width="480" height="360">
                                    <span class="ds-video-card__icon" aria-hidden="true"><i class="fa-solid fa-play"></i></span>
                                </button>
                            </div>
                            <div class="ds-video-card__body">
                                <h4 class="ds-video-card__title">
                                    <a href="<?php echo esc_url( $v['link'] ); ?>" target="_blank" rel="noopener"><?php echo esc_html( $v['title'] ); ?></a>
                                </h4>
                                <?php if ( $v['date'] ) : ?>
                                    <time class="ds-video-card__date" datetime="<?php echo esc_attr( gmdate( 'c', $v['date'] ) ); ?>">
                                        <i class="fa-regular fa-calendar" aria-hidden="true"></i> <?php echo esc_html( date_i18n( 'F j, Y', $v['date'] ) ); ?>
                                    </time>
                                <?php endif; ?>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
                <?php if ( $channel_url ) : ?>
                    <div class="ds-section__cta">
                        <a class="ds-btn ds-btn--outline" href="<?php echo esc_url( $channel_url ); ?>?sub_confirmation=1" target="_blank" rel="noopener">
                            <i class="fa-brands fa-youtube" aria-hidden="true"></i> Subscribe on YouTube
                        </a>
                    </div>
                <?php endif; ?>
            </div>
            <?php endif; ?>
        </div>
    </section>
    <?php
}

// ── Shortcode: [ds_podcast_feed] ─────────────────────
// Attributes mirror the section settings: heading, intro, spotify, rss, player (1/0),
// episodes_heading, episodes, youtube, videos_heading, videos.

add_shortcode( 'ds_podcast_feed', function ( $atts ) {
    $atts = shortcode_atts( [
        'heading'          => null,
        'intro'            => null,
        'spotify'          => null,
        'rss'              => null,
        'player'           => null,
        'episodes_heading' => null,
        'episodes'         => null,
        'youtube'          => null,
        'videos_heading'   => null,
        'videos'           => null,
    ], $atts, 'ds_podcast_feed' );

    ob_start();
    ds_render_podcast_feed( [
        'heading'          => $atts['heading'],
        'intro'            => $atts['intro'],
        'spotify_url'      => $atts['spotify'],
        'rss_url'          => $atts['rss'],
        'show_player'      => $atts['player'] === null ? null : (bool) (int) $atts['player'],
        'episodes_heading' => $atts['episodes_heading'],
        'episodes_count'   => $atts['episodes'],
        'youtube_url'      => $atts['youtube'],
        'videos_heading'   => $atts['videos_heading'],
        'videos_count'     => $atts['videos'],
    ] );
    return ob_get_clean();
} );
