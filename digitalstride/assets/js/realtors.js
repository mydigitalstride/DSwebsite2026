/**
 * Realtors Landing Page (page-realtors.php)
 * - Capability card deck: the front card is readable and the next ones
 *   peek out behind it. Next / Previous, the dots, a click on the peeking
 *   card, Left / Right arrow keys and swipes rotate the deck.
 * The testimonial carousel and FAQ accordion are handled by main.js.
 */
(function () {
    'use strict';

    var reduceMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    var DURATION = 600; // matches the 0.6s deck animations in realtors.css

    document.querySelectorAll('[data-rlt-deck]').forEach(function (deck) {
        var stack = deck.querySelector('.ds-rlt-deck__stack');
        var cards = Array.prototype.slice.call(deck.querySelectorAll('.ds-rlt-deck__card'));
        var dots = Array.prototype.slice.call(deck.querySelectorAll('.ds-rlt-deck__dot'));
        var controls = deck.querySelector('.ds-rlt-deck__controls');
        var n = cards.length;
        var current = 0;

        if (n < 2) return;

        function wrap(i) { return (i % n + n) % n; }

        // Only the front card can be tabbed into or read out.
        function setInteractive(card, on) {
            card.setAttribute('aria-hidden', on ? 'false' : 'true');
            card.querySelectorAll('a, button').forEach(function (el) {
                if (on) el.removeAttribute('tabindex');
                else el.setAttribute('tabindex', '-1');
            });
        }

        function render() {
            cards.forEach(function (card, i) {
                var pos = wrap(i - current);
                card.setAttribute('data-pos', pos < 3 ? String(pos) : 'back');
                setInteractive(card, pos === 0);
            });
            dots.forEach(function (dot, i) {
                dot.setAttribute('aria-current', i === current ? 'true' : 'false');
            });
        }

        function animate(card, cls) {
            if (reduceMotion || !card) return;
            card.classList.remove('is-leaving', 'is-entering');
            // Restart the animation if the same class is re-applied quickly.
            void card.offsetWidth;
            card.classList.add(cls);
            var done = function () {
                card.removeEventListener('animationend', done);
                clearTimeout(fallback);
                card.classList.remove(cls);
            };
            var fallback = setTimeout(done, DURATION + 100);
            card.addEventListener('animationend', done);
        }

        function goTo(index) {
            index = wrap(index);
            if (index === current) return;
            var forward = wrap(index - current) <= n / 2;
            var leaving = cards[current];
            current = index;
            render();
            // Forward: the old front card swings out and drops to the back.
            // Backward: the new front card swings in from the left.
            if (forward) animate(leaving, 'is-leaving');
            else animate(cards[current], 'is-entering');
        }

        function next() { goTo(current + 1); }
        function prev() { goTo(current - 1); }

        var prevBtn = deck.querySelector('.ds-rlt-deck__btn-nav--prev');
        var nextBtn = deck.querySelector('.ds-rlt-deck__btn-nav--next');
        if (prevBtn) prevBtn.addEventListener('click', prev);
        if (nextBtn) nextBtn.addEventListener('click', next);

        dots.forEach(function (dot) {
            dot.addEventListener('click', function () {
                goTo(parseInt(this.getAttribute('data-index'), 10));
            });
        });

        // A click on a card waiting behind brings it to the front.
        cards.forEach(function (card, i) {
            card.addEventListener('click', function (e) {
                if (card.getAttribute('data-pos') === '0') return;
                e.preventDefault();
                goTo(i);
            });
        });

        deck.addEventListener('keydown', function (e) {
            if (e.key === 'ArrowRight') { next(); e.preventDefault(); }
            else if (e.key === 'ArrowLeft') { prev(); e.preventDefault(); }
        });

        var touchX = null;
        stack.addEventListener('touchstart', function (e) { touchX = e.touches[0].clientX; }, { passive: true });
        stack.addEventListener('touchend', function (e) {
            if (touchX === null) return;
            var dx = e.changedTouches[0].clientX - touchX;
            touchX = null;
            if (Math.abs(dx) > 50) { if (dx < 0) next(); else prev(); }
        });

        if (controls) controls.hidden = false;
        render();
        deck.classList.add('is-ready');
    });
})();
