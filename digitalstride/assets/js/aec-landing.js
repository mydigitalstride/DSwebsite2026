/**
 * AEC Landing Page (page-aec-landing.php)
 * - Segment selector: all collapsed, one opens at a time on click.
 * - Guided pathway accordion: opening a tab closes the others.
 * The testimonial carousel is handled by main.js.
 */
(function () {
    'use strict';

    // ── Who We Serve: segment selector ───────────────────
    // All boxes start collapsed; clicking one opens it (and closes the
    // others), clicking it again collapses it.
    document.querySelectorAll('[data-aec-segments]').forEach(function (grid) {
        var boxes = Array.prototype.slice.call(grid.querySelectorAll('.ds-aec-segment'));

        function select(target) {
            boxes.forEach(function (box) {
                var on = box === target;
                box.classList.toggle('is-active', on);
                box.setAttribute('aria-expanded', on ? 'true' : 'false');
            });
        }

        boxes.forEach(function (box) {
            box.addEventListener('click', function () {
                select(box.classList.contains('is-active') ? null : box);
            });
        });

        grid.classList.add('is-ready');
    });

    // ── Where Are You Starting?: accordion ───────────────
    document.querySelectorAll('[data-aec-accordion]').forEach(function (list) {
        var items = Array.prototype.slice.call(list.querySelectorAll('.ds-aec-path__item'));

        function panelOf(item) { return item.querySelector('.ds-aec-path__panel'); }

        function setOpen(item, open) {
            var panel = panelOf(item);
            var toggle = item.querySelector('.ds-aec-path__toggle');
            toggle.setAttribute('aria-expanded', open ? 'true' : 'false');

            if (open) {
                panel.hidden = false;
                // Let the un-hidden panel render at 0fr before animating open.
                requestAnimationFrame(function () {
                    requestAnimationFrame(function () {
                        if (toggle.getAttribute('aria-expanded') === 'true') item.classList.add('is-open');
                    });
                });
            } else if (item.classList.contains('is-open')) {
                item.classList.remove('is-open');
                var done = function (e) {
                    if (e && e.target !== panel) return;
                    panel.removeEventListener('transitionend', done);
                    clearTimeout(fallback);
                    if (!item.classList.contains('is-open')) panel.hidden = true;
                };
                var fallback = setTimeout(done, 500);
                panel.addEventListener('transitionend', done);
            } else {
                panel.hidden = true;
            }
        }

        items.forEach(function (item) {
            // Closed panels start hidden so their links stay out of the tab order.
            if (!item.classList.contains('is-open')) panelOf(item).hidden = true;

            item.querySelector('.ds-aec-path__toggle').addEventListener('click', function () {
                var wasOpen = this.getAttribute('aria-expanded') === 'true';
                items.forEach(function (other) { if (other !== item) setOpen(other, false); });
                setOpen(item, !wasOpen);
            });
        });

        list.classList.add('is-ready');
    });
})();
