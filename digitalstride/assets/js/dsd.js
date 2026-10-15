/**
 * Digital Stride Dashboard page (page-dsd.php)
 * - Lead simulator: industry filter, simulated call player (play / pause,
 *   waveform progress, call timer), lead status tagger and the live
 *   "Total Revenue Pipeline Identified" counter.
 * The testimonial carousel is handled by main.js.
 */
(function () {
    'use strict';

    var reduceMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    var SOLD = 'Booked / Sold';

    function money(n) { return '$' + Math.round(n).toLocaleString('en-US'); }
    function clock(s) { s = Math.floor(s); return Math.floor(s / 60) + ':' + ('0' + (s % 60)).slice(-2); }
    function statusClass(v) { return v.toLowerCase().replace(/[^a-z0-9]/g, '-'); }

    document.querySelectorAll('[data-dsd-sim]').forEach(function (sim) {
        var cards = Array.prototype.slice.call(sim.querySelectorAll('.sim-lead-card'));
        var totalEl = sim.querySelector('#dsd-pipeline-total');
        var widget = sim.querySelector('.ds-dsd-pipeline');
        var deltaEl = sim.querySelector('.ds-dsd-pipeline__delta');

        function cardValue(card) { return parseFloat(card.getAttribute('data-value') || 0) || 0; }
        function isSold(card) {
            var select = card.querySelector('.lead-status-select');
            return !!select && select.value === SOLD;
        }
        function bookedSum() {
            return cards.reduce(function (sum, card) { return sum + (isSold(card) ? cardValue(card) : 0); }, 0);
        }

        // ── Live revenue pipeline ────────────────────────
        // The counter opens at the configured value; that already includes
        // the leads that start out Booked / Sold, so only changes move it.
        var base = Math.max(0, (parseFloat(sim.getAttribute('data-pipeline')) || 0) - bookedSum());
        var shown = base + bookedSum();
        var tween;

        function updatePipelineTotal() {
            var target = base + bookedSum();
            var from = shown;
            var diff = target - from;
            shown = target;
            if (!totalEl) return;

            if (diff && deltaEl) {
                deltaEl.textContent = (diff > 0 ? '+' : '−') + money(Math.abs(diff));
                deltaEl.className = 'ds-dsd-pipeline__delta ' + (diff > 0 ? 'is-up' : 'is-down');
                void deltaEl.offsetWidth;
                deltaEl.classList.add('is-show');
            }
            if (diff && widget && !reduceMotion) {
                widget.classList.remove('is-bump');
                void widget.offsetWidth;
                widget.classList.add('is-bump');
            }

            cancelAnimationFrame(tween);
            if (reduceMotion || !diff) {
                totalEl.textContent = money(target);
                return;
            }
            var start = null;
            var DURATION = 700;
            (function step(ts) {
                if (start === null) start = ts;
                var p = Math.min(1, (ts - start) / DURATION);
                var eased = 1 - Math.pow(1 - p, 3);
                totalEl.textContent = money(from + diff * eased);
                if (p < 1) tween = requestAnimationFrame(step);
            })(performance.now());
        }

        // ── Status tagger ────────────────────────────────
        function syncCard(card) {
            var select = card.querySelector('.lead-status-select');
            var badge = card.querySelector('.status-badge');
            if (!select) return;
            if (badge) {
                badge.textContent = select.value;
                badge.className = 'status-badge ' + statusClass(select.value);
            }
            card.classList.toggle('is-sold', select.value === SOLD);
            card.classList.toggle('is-disqualified', select.value === 'Disqualified');
        }

        sim.addEventListener('change', function (e) {
            if (!e.target.classList.contains('lead-status-select')) return;
            syncCard(e.target.closest('.sim-lead-card'));
            updatePipelineTotal();
        });

        // ── Simulated call player ────────────────────────
        // One call plays at a time; pausing keeps the position, reaching
        // the end resets it.
        var playing = null; // { player, btn, timer }

        function playerState(player) {
            if (!player._dsd) {
                player._dsd = {
                    elapsed: 0,
                    duration: parseFloat(player.getAttribute('data-duration')) || 120,
                    bars: Array.prototype.slice.call(player.querySelectorAll('.ds-dsd-call__wave i')),
                    out: player.querySelector('.ds-dsd-call__elapsed')
                };
            }
            return player._dsd;
        }

        function render(player) {
            var st = playerState(player);
            var played = Math.floor(st.bars.length * st.elapsed / st.duration);
            st.bars.forEach(function (bar, i) { bar.classList.toggle('is-played', i < played); });
            if (st.out) st.out.textContent = clock(st.elapsed);
        }

        function setButton(btn, on) {
            btn.classList.toggle('playing', on);
            btn.setAttribute('aria-pressed', on ? 'true' : 'false');
            var icon = btn.querySelector('.play-icon');
            if (icon) icon.textContent = on ? '⏸' : '▶';
            var label = btn.getAttribute('aria-label') || '';
            btn.setAttribute('aria-label', on ? label.replace(/^Play/, 'Pause') : label.replace(/^Pause/, 'Play'));
        }

        function stop() {
            if (!playing) return;
            clearInterval(playing.timer);
            setButton(playing.btn, false);
            playing.player.classList.remove('is-playing');
            playing = null;
        }

        function play(btn) {
            var player = btn.closest('.ds-dsd-call');
            var st = playerState(player);
            if (st.elapsed >= st.duration) st.elapsed = 0;
            var last = Date.now();
            playing = {
                player: player,
                btn: btn,
                timer: setInterval(function () {
                    var now = Date.now();
                    st.elapsed = Math.min(st.duration, st.elapsed + (now - last) / 1000);
                    last = now;
                    render(player);
                    if (st.elapsed >= st.duration) {
                        stop();
                        st.elapsed = 0;
                        render(player);
                    }
                }, 250)
            };
            setButton(btn, true);
            player.classList.add('is-playing');
        }

        sim.addEventListener('click', function (e) {
            var btn = e.target.closest('.sim-audio-btn');
            if (!btn) return;
            var wasThis = playing && playing.btn === btn;
            stop();
            if (!wasThis) play(btn);
        });

        // ── Industry filter ──────────────────────────────
        var filters = Array.prototype.slice.call(sim.querySelectorAll('.ds-dsd-filter'));
        filters.forEach(function (btn) {
            btn.addEventListener('click', function () {
                var cat = btn.getAttribute('data-filter');
                filters.forEach(function (b) {
                    var on = b === btn;
                    b.classList.toggle('is-active', on);
                    b.setAttribute('aria-pressed', on ? 'true' : 'false');
                });
                cards.forEach(function (card) {
                    var show = cat === 'all' || card.getAttribute('data-category') === cat;
                    if (!show && playing && card.contains(playing.btn)) stop();
                    var wasHidden = card.hidden;
                    card.hidden = !show;
                    if (show && wasHidden && !reduceMotion) {
                        card.classList.remove('is-entering');
                        void card.offsetWidth;
                        card.classList.add('is-entering');
                    }
                });
            });
        });

        cards.forEach(syncCard);
        if (totalEl) totalEl.textContent = money(shown);
    });
})();
