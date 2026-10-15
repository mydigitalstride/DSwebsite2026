/**
 * Digital Stride Dashboard page (page-dsd.php)
 * - Sector tabs (Tailored Solutions).
 * - Lead simulator: sidebar tabs, industry filter, expandable leads with a
 *   simulated call player and status tagger, the live "Total Revenue
 *   Pipeline Identified" counter, the Job & Ad ROI table, the Contract
 *   Value Log and 1-click Field Approvals.
 * The testimonial carousel is handled by main.js.
 */
(function () {
    'use strict';

    var reduceMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    var SOLD = 'Booked / Sold';

    function money(n) { return '$' + Math.round(n).toLocaleString('en-US'); }
    function clock(s) { s = Math.floor(s); return Math.floor(s / 60) + ':' + ('0' + (s % 60)).slice(-2); }
    function statusClass(v) { return v.toLowerCase().replace(/[^a-z0-9]/g, '-'); }
    function toArray(list) { return Array.prototype.slice.call(list); }
    function replay(el, cls) {
        if (reduceMotion || !el) return;
        el.classList.remove(cls);
        void el.offsetWidth;
        el.classList.add(cls);
    }

    /**
     * ARIA tabs: click or arrow keys (Up/Down too, for the vertical list)
     * select a tab and show its panel.
     */
    function initTabs(tabs, onSelect) {
        tabs = toArray(tabs);
        function panelOf(tab) { return document.getElementById(tab.getAttribute('aria-controls')); }
        function select(tab, focus) {
            tabs.forEach(function (t) {
                var on = t === tab;
                t.classList.toggle('is-active', on);
                t.setAttribute('aria-selected', on ? 'true' : 'false');
                t.tabIndex = on ? 0 : -1;
                var panel = panelOf(t);
                if (panel) panel.hidden = !on;
            });
            replay(panelOf(tab), 'is-entering');
            if (focus) tab.focus();
            if (onSelect) onSelect(tab);
        }
        tabs.forEach(function (tab, i) {
            var panel = panelOf(tab);
            if (panel) panel.hidden = tab.getAttribute('aria-selected') !== 'true';
            tab.addEventListener('click', function () { select(tab, false); });
            tab.addEventListener('keydown', function (e) {
                var to = null;
                if (e.key === 'ArrowRight' || e.key === 'ArrowDown') to = (i + 1) % tabs.length;
                if (e.key === 'ArrowLeft' || e.key === 'ArrowUp') to = (i - 1 + tabs.length) % tabs.length;
                if (e.key === 'Home') to = 0;
                if (e.key === 'End') to = tabs.length - 1;
                if (to === null) return;
                e.preventDefault();
                select(tabs[to], true);
            });
        });
    }

    // ── Sector tabs ──────────────────────────────────────
    document.querySelectorAll('[data-dsd-tabs]').forEach(function (section) {
        initTabs(section.querySelectorAll('.ds-dsd-ind__tab'));
    });

    // ── Lead simulator ───────────────────────────────────
    document.querySelectorAll('[data-dsd-sim]').forEach(function (sim) {
        var cards = toArray(sim.querySelectorAll('.sim-lead-card'));
        var totalEl = sim.querySelector('#dsd-pipeline-total');
        var widget = sim.querySelector('.ds-dsd-stat--pipeline');
        var deltaEl = sim.querySelector('.ds-dsd-stat__delta');
        var contractsEl = sim.querySelector('[data-contracts]');
        var contractsEmpty = sim.querySelector('[data-contracts-empty]');

        function cardValue(card) { return parseFloat(card.getAttribute('data-value') || 0) || 0; }
        function statusOf(card) {
            var select = card.querySelector('.lead-status-select');
            return select ? select.value : '';
        }
        function isSold(card) { return statusOf(card) === SOLD; }
        function bookedSum() {
            return cards.reduce(function (sum, card) { return sum + (isSold(card) ? cardValue(card) : 0); }, 0);
        }

        // Live revenue pipeline. The counter opens at the configured value,
        // which already includes the leads that start Booked / Sold, so
        // only changes move it.
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
                deltaEl.className = 'ds-dsd-stat__delta ' + (diff > 0 ? 'is-up' : 'is-down');
                replay(deltaEl, 'is-show');
            }
            if (diff) replay(widget, 'is-bump');

            cancelAnimationFrame(tween);
            if (reduceMotion || !diff) {
                totalEl.textContent = money(target);
                return;
            }
            var start = null;
            (function step(ts) {
                if (start === null) start = ts;
                var p = Math.min(1, (ts - start) / 700);
                totalEl.textContent = money(from + diff * (1 - Math.pow(1 - p, 3)));
                if (p < 1) tween = requestAnimationFrame(step);
            })(performance.now());
        }

        // Job & Ad ROI: leads and booked revenue per source.
        function updateRoi() {
            sim.querySelectorAll('[data-roi-source]').forEach(function (row) {
                var source = row.getAttribute('data-roi-source');
                var spend = parseFloat(row.getAttribute('data-spend')) || 0;
                var leads = 0, revenue = 0;
                cards.forEach(function (card) {
                    if (card.getAttribute('data-source') !== source) return;
                    leads++;
                    if (isSold(card)) revenue += cardValue(card);
                });
                var roas = spend ? revenue / spend : 0;
                row.querySelector('[data-roi="leads"]').textContent = leads;
                row.querySelector('[data-roi="revenue"]').textContent = money(revenue);
                var roasEl = row.querySelector('[data-roi="roas"]');
                roasEl.textContent = (roas >= 10 ? Math.round(roas) : roas.toFixed(1)) + 'x';
                roasEl.classList.toggle('is-zero', !revenue);
            });
        }

        // Contract Value Log: every Booked / Sold lead.
        function updateContracts() {
            if (!contractsEl) return;
            contractsEl.textContent = '';
            var sold = cards.filter(isSold);
            sold.forEach(function (card) {
                var li = document.createElement('li');
                var text = document.createElement('span');
                text.textContent = card.getAttribute('data-name');
                var meta = document.createElement('em');
                meta.textContent = card.getAttribute('data-service') + ' · ' + card.getAttribute('data-source');
                text.appendChild(meta);
                var value = document.createElement('strong');
                value.textContent = money(cardValue(card));
                li.appendChild(text);
                li.appendChild(value);
                contractsEl.appendChild(li);
            });
            if (contractsEmpty) contractsEmpty.hidden = sold.length > 0;
        }

        // Status tagger: badge reads "Booked ($12,000)" for sold leads.
        function syncCard(card) {
            var status = statusOf(card);
            var badge = card.querySelector('.status-badge');
            if (badge) {
                badge.textContent = status === SOLD ? 'Booked (' + money(cardValue(card)) + ')' : status;
                badge.className = 'status-badge ' + statusClass(status);
            }
            card.classList.toggle('is-sold', status === SOLD);
            card.classList.toggle('is-disqualified', status === 'Disqualified');
        }

        sim.addEventListener('change', function (e) {
            if (!e.target.classList.contains('lead-status-select')) return;
            syncCard(e.target.closest('.sim-lead-card'));
            updatePipelineTotal();
            updateRoi();
            updateContracts();
        });

        // Simulated call player: one call at a time; pausing keeps the
        // position, reaching the end resets it.
        var playing = null;

        function playerState(player) {
            if (!player._dsd) {
                player._dsd = {
                    elapsed: 0,
                    duration: parseFloat(player.getAttribute('data-duration')) || 120,
                    bars: toArray(player.querySelectorAll('.ds-dsd-call__wave i')),
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
        function stopIfInside(el) { if (playing && el.contains(playing.btn)) stop(); }

        // Clicking a lead opens its recording + tagger.
        function toggleLead(card, open) {
            var row = card.querySelector('.ds-dsd-lead__row');
            var detail = card.querySelector('.ds-dsd-lead__detail');
            if (!row || !detail) return;
            row.setAttribute('aria-expanded', open ? 'true' : 'false');
            detail.hidden = !open;
            card.classList.toggle('is-open', open);
            if (!open) stopIfInside(card);
        }

        sim.addEventListener('click', function (e) {
            var audioBtn = e.target.closest('.sim-audio-btn');
            if (audioBtn) {
                var wasThis = playing && playing.btn === audioBtn;
                stop();
                if (!wasThis) play(audioBtn);
                return;
            }

            var row = e.target.closest('.ds-dsd-lead__row');
            if (row) {
                var card = row.closest('.sim-lead-card');
                toggleLead(card, row.getAttribute('aria-expanded') !== 'true');
                return;
            }

            var approve = e.target.closest('[data-approve], [data-changes]');
            if (approve) {
                var item = approve.closest('.ds-dsd-approval');
                var ok = approve.hasAttribute('data-approve');
                item.classList.add('is-done', ok ? 'is-approved' : 'is-changes');
                item.querySelector('.ds-dsd-approval__state').textContent = ok ? '✓ Approved just now' : '↺ Changes requested';
                var left = sim.querySelector('[data-approvals-left]');
                if (left) left.textContent = sim.querySelectorAll('.ds-dsd-approval:not(.is-done)').length;
            }
        });

        // Industry filter.
        var filters = toArray(sim.querySelectorAll('.ds-dsd-filter'));
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
                    if (!show) stopIfInside(card);
                    var wasHidden = card.hidden;
                    card.hidden = !show;
                    if (show && wasHidden) replay(card, 'is-entering');
                });
            });
        });

        // Sidebar tabs; leaving the feed stops any call that's playing.
        initTabs(sim.querySelectorAll('.ds-dsd-app__tab'), function (tab) {
            if (tab.id !== 'dsd-sim-tab-feed') stop();
        });

        cards.forEach(syncCard);
        updateRoi();
        updateContracts();
        if (totalEl) totalEl.textContent = money(shown);
    });
})();
