(function () {
    'use strict';

    // Mobile menu toggle
    var hamburger = document.getElementById('ds-hamburger');
    var nav = document.getElementById('ds-nav');
    if (hamburger && nav) {
        hamburger.addEventListener('click', function () {
            nav.classList.toggle('is-open');
            this.classList.toggle('is-active');
        });
    }

    // Mobile mega-menu toggle (tap to open/close)
    document.querySelectorAll('.ds-nav__item--mega > .ds-nav__link').forEach(function (link) {
        link.addEventListener('click', function (e) {
            if (window.innerWidth <= 1024) {
                e.preventDefault();
                var item = this.closest('.ds-nav__item--mega');
                item.classList.toggle('is-open');
            }
        });
    });

    // Generic accordion (FAQ, etc.)
    document.querySelectorAll('.ds-accordion__header').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var item = this.closest('.ds-accordion__item');
            var isOpen = item.classList.contains('is-active');
            item.parentElement.querySelectorAll('.ds-accordion__item').forEach(function (el) {
                el.classList.remove('is-active');
                el.querySelector('.ds-accordion__header').setAttribute('aria-expanded', 'false');
            });
            if (!isOpen) {
                item.classList.add('is-active');
                this.setAttribute('aria-expanded', 'true');
            }
        });
    });

    // Services split — desktop tabs + mobile accordion
    document.querySelectorAll('.ds-services-split').forEach(function (split) {
        var items = split.querySelectorAll('.ds-services-split__item');
        var panels = split.querySelectorAll('.ds-services-split__panel');
        var isMobile = function () { return window.innerWidth <= 1024; };

        function desktopActivate(index) {
            items.forEach(function (el) {
                el.classList.remove('is-active');
                el.querySelector('.ds-services-split__header').setAttribute('aria-expanded', 'false');
            });
            panels.forEach(function (el) { el.classList.remove('is-active'); });
            items[index].classList.add('is-active');
            items[index].querySelector('.ds-services-split__header').setAttribute('aria-expanded', 'true');
            if (panels[index]) panels[index].classList.add('is-active');
        }

        function mobileToggle(index) {
            var item = items[index];
            var isOpen = item.classList.contains('is-active');
            items.forEach(function (el) {
                el.classList.remove('is-active');
                el.querySelector('.ds-services-split__header').setAttribute('aria-expanded', 'false');
            });
            if (!isOpen) {
                item.classList.add('is-active');
                item.querySelector('.ds-services-split__header').setAttribute('aria-expanded', 'true');
            }
        }

        items.forEach(function (item, i) {
            item.querySelector('.ds-services-split__header').addEventListener('click', function () {
                if (isMobile()) {
                    mobileToggle(i);
                } else {
                    desktopActivate(i);
                }
            });
        });

        function handleResize() {
            if (isMobile()) {
                items.forEach(function (el) {
                    el.classList.remove('is-active');
                    el.querySelector('.ds-services-split__header').setAttribute('aria-expanded', 'false');
                });
                panels.forEach(function (el) { el.classList.remove('is-active'); });
            } else {
                var hasActive = split.querySelector('.ds-services-split__item.is-active');
                if (!hasActive) desktopActivate(0);
            }
        }

        window.addEventListener('resize', handleResize);
        if (!isMobile()) {
            desktopActivate(0);
        } else {
            items.forEach(function (el) {
                el.classList.remove('is-active');
                el.querySelector('.ds-services-split__header').setAttribute('aria-expanded', 'false');
            });
        }
    });

    // Full-Width Angled Carousel
    window.initFwCarousel = function (el, slides) {
        if (!el || !slides.length) return;

        var panels  = el.querySelectorAll('.ds-fwc__panel');
        var imgLeft  = panels[0].querySelector('.ds-fwc__img');
        var imgCenter = panels[1].querySelector('.ds-fwc__img');
        var imgRight  = panels[2].querySelector('.ds-fwc__img');
        var dots    = el.querySelectorAll('.ds-fwc__dot');
        var current = 0;
        var n       = slides.length;
        var timer;

        function idx(i) { return (i + n) % n; }

        function setImg(imgEl, slide) {
            if (!slide || !slide.src) { imgEl.src = ''; return; }
            if (imgEl.src === slide.src) return;
            imgEl.classList.add('is-loading');
            imgEl.onload = function () { imgEl.classList.remove('is-loading'); };
            imgEl.src  = slide.src;
            imgEl.alt  = slide.alt || '';
        }

        function render() {
            setImg(imgLeft,   slides[idx(current - 1)]);
            setImg(imgCenter, slides[idx(current)]);
            setImg(imgRight,  slides[idx(current + 1)]);
            dots.forEach(function (d, i) {
                d.classList.toggle('is-active', i === current);
            });
        }

        function goTo(i) {
            current = idx(i);
            render();
        }

        function next() { goTo(current + 1); }

        function startAuto() {
            if (n > 1) timer = setInterval(next, 5000);
        }
        function resetAuto() { clearInterval(timer); startAuto(); }

        dots.forEach(function (d) {
            d.addEventListener('click', function () {
                goTo(parseInt(this.dataset.index, 10));
                resetAuto();
            });
        });

        // Swipe support
        var touchStartX = 0;
        el.addEventListener('touchstart', function (e) { touchStartX = e.touches[0].clientX; }, { passive: true });
        el.addEventListener('touchend', function (e) {
            var dx = e.changedTouches[0].clientX - touchStartX;
            if (Math.abs(dx) > 50) { goTo(current + (dx < 0 ? 1 : -1)); resetAuto(); }
        });

        render();
        startAuto();
    };
    document.dispatchEvent(new CustomEvent('ds:fwc-ready'));

    // Generic fade carousel factory — used by project carousel and testimonial carousel
    function initFadeCarousel(selector, autoInterval) {
        document.querySelectorAll(selector).forEach(function (wrap) {
            var slides = wrap.querySelectorAll('[class$="__slide"], [class*="__slide "]');
            var dots   = wrap.querySelectorAll('[class$="__dot"], [class*="__dot "]');
            var prev   = wrap.querySelector('[class$="__btn--prev"], [class*="__btn--prev"]');
            var next   = wrap.querySelector('[class$="__btn--next"], [class*="__btn--next"]');
            var current = 0;
            var timer;

            if (!slides.length) return;

            function goTo(index) {
                slides[current].classList.remove('is-active');
                slides[current].setAttribute('aria-hidden', 'true');
                if (dots.length) dots[current].classList.remove('is-active');
                current = (index + slides.length) % slides.length;
                slides[current].classList.add('is-active');
                slides[current].setAttribute('aria-hidden', 'false');
                if (dots.length) dots[current].classList.add('is-active');
            }

            function resetAuto() {
                clearInterval(timer);
                if (autoInterval) timer = setInterval(function () { goTo(current + 1); }, autoInterval);
            }

            if (prev) prev.addEventListener('click', function () { goTo(current - 1); resetAuto(); });
            if (next) next.addEventListener('click', function () { goTo(current + 1); resetAuto(); });
            dots.forEach(function (dot) {
                dot.addEventListener('click', function () { goTo(parseInt(this.dataset.slide, 10)); resetAuto(); });
            });

            if (autoInterval && slides.length > 1) resetAuto();
        });
    }

    initFadeCarousel('.ds-project-carousel', 6000);
    initFadeCarousel('.ds-testimonial-carousel', 7000);
    initFadeCarousel('.ds-portfolio-carousel', 8000);

    // Pricing Feature Table — tab switcher
    document.querySelectorAll('.ds-section--pft').forEach(function (section) {
        var tabs   = section.querySelectorAll('.ds-pft__tab');
        var panels = section.querySelectorAll('.ds-pft__panel');
        tabs.forEach(function (tab, i) {
            tab.addEventListener('click', function () {
                tabs.forEach(function (t) { t.classList.remove('is-active'); t.setAttribute('aria-selected', 'false'); });
                panels.forEach(function (p) { p.classList.remove('is-active'); p.setAttribute('aria-hidden', 'true'); });
                tab.classList.add('is-active');
                tab.setAttribute('aria-selected', 'true');
                if (panels[i]) { panels[i].classList.add('is-active'); panels[i].setAttribute('aria-hidden', 'false'); }
            });
        });
    });

    // Pricing Stack — rotating 3-card perspective carousel
    var STACK_DURATION = 1100;
    var STACK_EASE = STACK_DURATION + 'ms cubic-bezier(0.16, 1, 0.3, 1)';
    var STYLE_ACTIVE = {
        background: 'linear-gradient(135deg, #0993BF 0%, #051879 100%)',
        color:      'white',
        transform:  'scale(1.1)',
        zIndex:     '10',
        opacity:    '1',
        margin:     '0 -60px',
        boxShadow:  '0 25px 60px rgba(0,0,0,0.5)'
    };
    var STYLE_SIDE = {
        background: '#F2F5FB',
        color:      '#020B24',
        transform:  'scale(0.85)',
        zIndex:     '1',
        opacity:    '0.7',
        margin:     '0',
        boxShadow:  '0 20px 50px rgba(0,0,0,0.3)'
    };

    function buildCardHTML(data) {
        return '<h3 class="josefin">' + data.title + '</h3>' +
            '<p class="desc merriweather">' + data.desc + '</p>' +
            '<div class="services merriweather"><strong class="josefin">' + data.servicesLabel + '</strong>' +
            '<ul>' + data.services.map(function(s){ return '<li>' + s + '</li>'; }).join('') + '</ul></div>' +
            '<p class="price merriweather">' + data.price + '</p>' +
            '<button class="btn-orange josefin" onclick="window.location.href=\'' + data.btnLink + '\';event.stopPropagation();">' + data.btnText + '</button>';
    }

    function applyStackStyle(el, isActive, withTrans) {
        var t = withTrans ? ['transform','opacity','margin','box-shadow','background'].map(function(p){ return p + ' ' + STACK_EASE; }).join(', ') : 'none';
        el.style.transition = t;
        var s = isActive ? STYLE_ACTIVE : STYLE_SIDE;
        Object.keys(s).forEach(function(k){ el.style[k] = s[k]; });
        var h3 = el.querySelector('h3');
        if (h3) h3.style.color = isActive ? 'white' : '#020B24';
    }

    window.initPricingStack = function (stackId, mobileId, allCards) {
        var stackEl  = document.getElementById(stackId);
        var mobileEl = document.getElementById(mobileId);
        if (!stackEl || !allCards.length) return;

        var activeIndex = Math.floor(allCards.length / 2);
        var isAnimating = false;
        var slots = [];

        // Build 3 slot elements
        stackEl.innerHTML = '';
        for (var i = 0; i < 3; i++) {
            var card = document.createElement('div');
            card.className = 'price-card';
            stackEl.appendChild(card);
            slots.push(card);
        }

        function getIndices() {
            var n = allCards.length;
            return [(activeIndex - 1 + n) % n, activeIndex, (activeIndex + 1) % n];
        }

        function populate() {
            var idx = getIndices();
            slots.forEach(function (el, i) {
                el.innerHTML = buildCardHTML(allCards[idx[i]]);
                applyStackStyle(el, i === 1, false);
            });
            attachClicks();
        }

        function attachClicks() {
            slots[0].onclick = function (e) { if (e.target.tagName !== 'BUTTON' && !isAnimating) rotate(-1); };
            slots[1].onclick = null;
            slots[2].onclick = function (e) { if (e.target.tagName !== 'BUTTON' && !isAnimating) rotate(1); };
        }

        function rotate(dir) {
            isAnimating = true;
            var movingIdx = dir === 1 ? 2 : 0;
            slots[movingIdx].style.zIndex = '20';
            var trans = ['transform','opacity','margin','box-shadow','background'].map(function(p){ return p + ' ' + STACK_EASE; }).join(', ');
            requestAnimationFrame(function(){ requestAnimationFrame(function(){
                [slots[1], slots[movingIdx]].forEach(function(el, i){
                    el.style.transition = trans;
                    var active = i === 1;
                    var s = active ? STYLE_ACTIVE : STYLE_SIDE;
                    Object.keys(s).forEach(function(k){ el.style[k] = s[k]; });
                    var h3 = el.querySelector('h3');
                    if (h3) h3.style.color = active ? 'white' : '#020B24';
                });
            }); });
            setTimeout(function () {
                activeIndex = (activeIndex + dir + allCards.length) % allCards.length;
                populate();
                isAnimating = false;
            }, STACK_DURATION + 100);
        }

        populate();

        // Mobile
        if (!mobileEl) return;
        var mobileActive = activeIndex;
        function renderMobile() {
            mobileEl.innerHTML = '';
            var tabBar = document.createElement('div');
            tabBar.className = 'mobile-tabs';
            allCards.forEach(function (data, i) {
                var tab = document.createElement('button');
                tab.className = 'mobile-tab josefin' + (i === mobileActive ? ' active' : '');
                tab.textContent = data.title;
                tab.onclick = function () { mobileActive = i; renderMobile(); };
                tabBar.appendChild(tab);
            });
            mobileEl.appendChild(tabBar);
            var data = allCards[mobileActive];
            var card = document.createElement('div');
            card.className = 'mobile-card';
            card.innerHTML = '<h3>' + data.title + '</h3>' +
                '<p class="desc">' + data.desc + '</p>' +
                '<div class="services"><strong>' + data.servicesLabel + '</strong>' +
                '<ul>' + data.services.map(function(s){ return '<li>' + s + '</li>'; }).join('') + '</ul></div>' +
                '<p class="price">' + data.price + '</p>' +
                '<button class="btn-orange" onclick="window.location.href=\'' + data.btnLink + '\'">' + data.btnText + '</button>';
            mobileEl.appendChild(card);
        }
        renderMobile();
    };

    document.dispatchEvent(new CustomEvent('ds:pricing-stack-ready'));

    // Industry Tabs — desktop tabs + mobile accordion
    document.querySelectorAll('.ds-industry-tabs').forEach(function (widget) {
        var tabs   = widget.querySelectorAll('.ds-industry-tabs__tab');
        var panels = widget.querySelectorAll('.ds-industry-tabs__panel');
        var mobilePanels = widget.querySelectorAll('.ds-industry-tabs__mobile-panel');
        var isMobile = function () { return window.innerWidth <= 768; };

        function activateDesktop(index) {
            tabs.forEach(function (t, i) {
                t.classList.toggle('is-active', i === index);
                t.setAttribute('aria-selected', i === index ? 'true' : 'false');
            });
            panels.forEach(function (p, i) {
                p.classList.toggle('is-active', i === index);
                p.setAttribute('aria-hidden', i === index ? 'false' : 'true');
            });
        }

        function toggleMobile(index) {
            var isOpen = mobilePanels[index].classList.contains('is-active');
            tabs.forEach(function (t) { t.classList.remove('is-active'); });
            mobilePanels.forEach(function (p) { p.classList.remove('is-active'); });
            if (!isOpen) {
                tabs[index].classList.add('is-active');
                mobilePanels[index].classList.add('is-active');
            }
        }

        tabs.forEach(function (tab, i) {
            tab.addEventListener('click', function () {
                if (isMobile()) { toggleMobile(i); } else { activateDesktop(i); }
            });
        });

        window.addEventListener('resize', function () {
            if (!isMobile()) { activateDesktop(0); }
        });
    });

    // Mega menu top — dynamically measured from header's actual bottom position.
    // Accounts for WP admin bar (32px desktop / 46px mobile) and any other offsets.
    var header = document.getElementById('ds-header');
    function updateMegaTop() {
        if (!header) return;
        var bottom = header.getBoundingClientRect().bottom + window.scrollY;
        // Use scrollY so the value stays correct when the page is scrolled.
        // For a fixed header this equals the header's rendered bottom from the viewport top.
        var viewportBottom = header.getBoundingClientRect().bottom;
        document.documentElement.style.setProperty('--ds-mega-top', Math.round(viewportBottom-28) + 'px');
    }
    updateMegaTop();
    window.addEventListener('resize', updateMegaTop);
    window.addEventListener('scroll', updateMegaTop);

    // Header shadow on scroll
    if (header) {
        window.addEventListener('scroll', function () {
            header.style.boxShadow = window.scrollY > 10 ? '0 2px 20px rgba(0,0,0,0.3)' : 'none';
        });
    }

    // Hero carousel
    document.querySelectorAll('.ds-hero__carousel').forEach(function (carousel) {
        var slides = carousel.querySelectorAll('.ds-hero__slide');
        var dots = carousel.querySelectorAll('.ds-hero__carousel-dot');
        var prevBtn = carousel.querySelector('.ds-hero__carousel-btn--prev');
        var nextBtn = carousel.querySelector('.ds-hero__carousel-btn--next');
        var current = 0;
        var timer;

        function goTo(index) {
            slides[current].classList.remove('is-active');
            slides[current].setAttribute('aria-hidden', 'true');
            if (dots.length) dots[current].classList.remove('is-active');
            current = (index + slides.length) % slides.length;
            slides[current].classList.add('is-active');
            slides[current].setAttribute('aria-hidden', 'false');
            if (dots.length) dots[current].classList.add('is-active');
        }

        function startAuto() {
            timer = setInterval(function () { goTo(current + 1); }, 5000);
        }

        function resetAuto() {
            clearInterval(timer);
            startAuto();
        }

        if (slides.length > 1) {
            if (prevBtn) prevBtn.addEventListener('click', function () { goTo(current - 1); resetAuto(); });
            if (nextBtn) nextBtn.addEventListener('click', function () { goTo(current + 1); resetAuto(); });
            dots.forEach(function (dot) {
                dot.addEventListener('click', function () { goTo(parseInt(this.dataset.slide, 10)); resetAuto(); });
            });
            startAuto();
        }
    });

    // Logo carousel — auto-scrolling with center-scale effect
    document.querySelectorAll('.ds-logo-carousel').forEach(function (carousel) {
        var track = carousel.querySelector('.ds-logo-carousel__track');
        var slides = track.querySelectorAll('.ds-logo-carousel__slide');
        if (slides.length < 3) return;

        var current = 0;
        var slideWidth = 0;
        var visibleCount = 5;
        var timer;

        function measure() {
            slideWidth = slides[0].offsetWidth;
            visibleCount = Math.round(carousel.offsetWidth / slideWidth);
        }

        function updateClasses() {
            var centerIndex = Math.floor(visibleCount / 2);
            slides.forEach(function (s) {
                s.classList.remove('is-center', 'is-adjacent');
            });
            var ci = current + centerIndex;
            if (ci < slides.length) slides[ci].classList.add('is-center');
            if (ci - 1 >= 0 && ci - 1 < slides.length) slides[ci - 1].classList.add('is-adjacent');
            if (ci + 1 < slides.length) slides[ci + 1].classList.add('is-adjacent');
        }

        function advance() {
            current++;
            if (current > slides.length - visibleCount) {
                current = 0;
                track.style.transition = 'none';
                track.style.transform = 'translateX(0)';
                track.offsetHeight;
                track.style.transition = 'transform 0.5s ease';
            }
            track.style.transform = 'translateX(-' + (current * slideWidth) + 'px)';
            updateClasses();
        }

        function start() {
            timer = setInterval(advance, 3000);
        }

        measure();
        updateClasses();
        start();

        window.addEventListener('resize', function () {
            measure();
            track.style.transform = 'translateX(-' + (current * slideWidth) + 'px)';
            updateClasses();
        });

        carousel.addEventListener('mouseenter', function () { clearInterval(timer); });
        carousel.addEventListener('mouseleave', start);
    });

    // Gallery lightbox
    (function () {
        var lightbox  = document.getElementById('ds-lightbox');
        if (!lightbox) return;
        var lbImg     = lightbox.querySelector('.ds-lightbox__img');
        var lbCap     = lightbox.querySelector('.ds-lightbox__caption');
        var closeBtn  = lightbox.querySelector('.ds-lightbox__close');
        var prevBtn   = lightbox.querySelector('.ds-lightbox__prev');
        var nextBtn   = lightbox.querySelector('.ds-lightbox__next');
        var items     = [];
        var current   = 0;

        function collect() {
            items = Array.from(document.querySelectorAll('.ds-gallery__lightbox'));
        }

        function open(index) {
            collect();
            current = index;
            show(current);
            lightbox.classList.add('is-open');
            lightbox.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';
        }

        function close() {
            lightbox.classList.remove('is-open');
            lightbox.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
        }

        function show(index) {
            var el  = items[index];
            var img = el.querySelector('img');
            lbImg.src = el.href;
            lbImg.alt = img ? img.alt : '';
            lbCap.textContent = el.dataset.caption || '';
            prevBtn.style.display = items.length > 1 ? '' : 'none';
            nextBtn.style.display = items.length > 1 ? '' : 'none';
        }

        document.addEventListener('click', function (e) {
            var link = e.target.closest('.ds-gallery__lightbox');
            if (!link) return;
            e.preventDefault();
            collect();
            open(items.indexOf(link));
        });

        closeBtn.addEventListener('click', close);
        lightbox.addEventListener('click', function (e) { if (e.target === lightbox) close(); });
        prevBtn.addEventListener('click', function () { current = (current - 1 + items.length) % items.length; show(current); });
        nextBtn.addEventListener('click', function () { current = (current + 1) % items.length; show(current); });
        document.addEventListener('keydown', function (e) {
            if (!lightbox.classList.contains('is-open')) return;
            if (e.key === 'Escape') close();
            if (e.key === 'ArrowLeft') { current = (current - 1 + items.length) % items.length; show(current); }
            if (e.key === 'ArrowRight') { current = (current + 1) % items.length; show(current); }
        });
    })();

    // Marketing Needs Survey — multi-step form with conditional routing
    document.querySelectorAll('.ds-survey').forEach(function (survey) {
        var form      = survey.querySelector('.ds-survey__form');
        var steps     = Array.from(survey.querySelectorAll('.ds-survey__step'));
        var backBtn   = survey.querySelector('.ds-survey__back');
        var nextBtn   = survey.querySelector('.ds-survey__next');
        var submitBtn = survey.querySelector('.ds-survey__submit');
        var fill      = survey.querySelector('.ds-survey__progress-fill');
        var progLabel = survey.querySelector('.ds-survey__progress-label');
        var formError = survey.querySelector('.ds-survey__form-error');
        var success   = survey.querySelector('.ds-survey__success');
        var current   = 0;

        if (!form || !steps.length) return;

        function answerFor(name) {
            var values = [];
            form.querySelectorAll('[name="' + name + '"], [name="' + name + '[]"]').forEach(function (input) {
                if (input.type === 'radio' || input.type === 'checkbox') {
                    if (input.checked) values.push(input.value);
                } else if (input.value.trim() !== '') {
                    values.push(input.value.trim());
                }
            });
            return values;
        }

        // Show/hide conditional questions; clear answers of hidden ones.
        function applyConditions() {
            survey.querySelectorAll('.ds-survey__q[data-show-if]').forEach(function (q) {
                var cond = JSON.parse(q.dataset.showIf);
                var met = answerFor(cond.field).some(function (v) {
                    return cond.values.indexOf(v) !== -1;
                });
                q.hidden = !met;
                if (!met) {
                    q.querySelectorAll('input, textarea, select').forEach(function (input) {
                        if (input.type === 'radio' || input.type === 'checkbox') {
                            input.checked = false;
                        } else {
                            input.value = '';
                        }
                    });
                }
            });
        }

        function validateStep(index) {
            var ok = true;
            steps[index].querySelectorAll('.ds-survey__q').forEach(function (q) {
                var error = q.querySelector('.ds-survey__error');
                error.hidden = true;
                q.classList.remove('has-error');
                if (q.hidden || !q.dataset.required) return;

                var answered;
                var input = q.querySelector('.ds-survey__input');
                if (input) {
                    var val = input.value.trim();
                    answered = val !== '';
                    if (answered && input.type === 'email') {
                        answered = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(val);
                    }
                } else {
                    answered = !!q.querySelector('input:checked');
                }

                if (!answered) {
                    ok = false;
                    error.hidden = false;
                    q.classList.add('has-error');
                }
            });
            return ok;
        }

        function show(index) {
            current = index;
            applyConditions();
            steps.forEach(function (step, i) {
                step.classList.toggle('is-active', i === index);
            });
            backBtn.hidden = index === 0;
            nextBtn.hidden = index === steps.length - 1;
            submitBtn.hidden = index !== steps.length - 1;
            fill.style.width = ((index + 1) / steps.length * 100) + '%';
            progLabel.textContent = 'Step ' + (index + 1) + ' of ' + steps.length + ' — ' + steps[index].dataset.stepTitle;
            var top = survey.getBoundingClientRect().top + window.pageYOffset - 120;
            if (window.pageYOffset > top) window.scrollTo({ top: top, behavior: 'smooth' });
        }

        nextBtn.addEventListener('click', function () {
            if (validateStep(current)) show(current + 1);
        });
        backBtn.addEventListener('click', function () { show(current - 1); });

        form.addEventListener('change', function (e) {
            applyConditions();
            // Exclusive checkbox (e.g. "not actively marketing") clears its siblings.
            var target = e.target;
            if (target.type === 'checkbox') {
                var group = target.closest('.ds-survey__options');
                if (!group) return;
                if (target.dataset.exclusive && target.checked) {
                    group.querySelectorAll('input:checked').forEach(function (input) {
                        if (input !== target) input.checked = false;
                    });
                } else if (target.checked) {
                    group.querySelectorAll('input[data-exclusive]').forEach(function (input) {
                        input.checked = false;
                    });
                }
            }
        });

        form.addEventListener('submit', function (e) {
            e.preventDefault();
            if (!validateStep(current)) return;
            formError.hidden = true;
            submitBtn.disabled = true;
            submitBtn.textContent = 'Sending…';

            // getAttribute: the "action" ajax field shadows form.action (DOM clobbering)
            fetch(form.getAttribute('action'), { method: 'POST', body: new FormData(form) })
                .then(function (res) { return res.json(); })
                .then(function (data) {
                    if (!data.success) throw data;
                    form.hidden = true;
                    survey.querySelector('.ds-survey__progress').hidden = true;
                    success.hidden = false;
                })
                .catch(function (err) {
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'Get My Assessment';
                    formError.textContent = (err && err.data && err.data.message)
                        ? err.data.message
                        : 'Something went wrong sending your answers. Please try again, or email us directly.';
                    formError.hidden = false;
                });
        });

        show(0);
    });

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(function (a) {
        a.addEventListener('click', function (e) {
            var t = document.querySelector(this.getAttribute('href'));
            if (t) {
                e.preventDefault();
                var off = header ? header.offsetHeight + 20 : 100;
                window.scrollTo({ top: t.getBoundingClientRect().top + window.pageYOffset - off, behavior: 'smooth' });
            }
        });
    });
})();
