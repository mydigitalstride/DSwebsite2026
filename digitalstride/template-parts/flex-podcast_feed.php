<?php
/**
 * Flex Layout: Podcast & Video Feed
 * Spotify show player + episode list from the podcast RSS feed, and the
 * latest videos from a YouTube channel. All fetching lives in inc/podcast.php.
 */
ds_render_podcast_feed( [
    'heading'          => get_sub_field( 'heading' ),
    'intro'            => get_sub_field( 'intro' ),
    'spotify_url'      => get_sub_field( 'spotify_url' ),
    'rss_url'          => get_sub_field( 'rss_url' ),
    'show_player'      => get_sub_field( 'show_player' ) === null ? null : (bool) get_sub_field( 'show_player' ),
    'episodes_heading' => get_sub_field( 'episodes_heading' ),
    'episodes_count'   => get_sub_field( 'episodes_count' ),
    'youtube_url'      => get_sub_field( 'youtube_url' ),
    'videos_heading'   => get_sub_field( 'videos_heading' ),
    'videos_count'     => get_sub_field( 'videos_count' ),
] );
