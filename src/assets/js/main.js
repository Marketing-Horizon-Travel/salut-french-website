/**
 * Salut Français — frontend JS
 */
(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', function () {
        initMobileMenu();
        initHeaderScroll();
        initSmoothScroll();
        initLeadForm();
        initRevealOnScroll();
        initRoadmapTabs();
    });

    /* Roadmap tabs (homepage section 04) */
    function initRoadmapTabs() {
        document.querySelectorAll('[data-roadmap]').forEach(function (root) {
            var tabs = root.querySelectorAll('.roadmap-tab');
            var panels = root.querySelectorAll('.roadmap-panel');
            tabs.forEach(function (tab) {
                tab.addEventListener('click', function () {
                    var target = tab.getAttribute('data-target');
                    tabs.forEach(function (t) {
                        var active = t === tab;
                        t.classList.toggle('is-active', active);
                        t.setAttribute('aria-selected', active ? 'true' : 'false');
                    });
                    panels.forEach(function (p) {
                        p.classList.toggle('is-active', p.id === target);
                    });
                });
            });
        });
    }

    /* Mobile menu toggle */
    function initMobileMenu() {
        var toggle = document.querySelector('.menu-toggle');
        var nav = document.querySelector('.site-nav');
        if (!toggle || !nav) return;

        toggle.addEventListener('click', function () {
            var open = nav.classList.toggle('is-open');
            toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
        });

        nav.querySelectorAll('a').forEach(function (link) {
            link.addEventListener('click', function () {
                nav.classList.remove('is-open');
                toggle.setAttribute('aria-expanded', 'false');
            });
        });
    }

    /* Shrink/color-change header on scroll */
    function initHeaderScroll() {
        var header = document.getElementById('site-header');
        if (!header) return;
        var scrolled = false;
        window.addEventListener('scroll', function () {
            var isScrolled = window.scrollY > 10;
            if (isScrolled !== scrolled) {
                scrolled = isScrolled;
                header.classList.toggle('is-scrolled', scrolled);
            }
        }, { passive: true });
    }

    /* Smooth scroll for in-page anchors */
    function initSmoothScroll() {
        document.querySelectorAll('a[href^="#"]').forEach(function (link) {
            link.addEventListener('click', function (e) {
                var href = link.getAttribute('href');
                if (!href || href === '#') return;
                var target = document.querySelector(href);
                if (!target) return;
                e.preventDefault();
                var headerOffset = 80;
                var y = target.getBoundingClientRect().top + window.pageYOffset - headerOffset;
                window.scrollTo({ top: y, behavior: 'smooth' });
                history.pushState(null, '', href);
            });
        });
    }

    /* Reveal sections as they come into view */
    function initRevealOnScroll() {
        if (!('IntersectionObserver' in window)) return;
        var targets = document.querySelectorAll(
            '.section-head, .course-card, .why-card, .testimonial-card, .post-card, .about-points li, .hero-stats li'
        );
        targets.forEach(function (el, i) {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
            el.style.transition = 'opacity .6s ease ' + (i * 0.04) + 's, transform .6s ease ' + (i * 0.04) + 's';
        });
        var io = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                    io.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });
        targets.forEach(function (el) { io.observe(el); });
    }

    /* Lead form submission — works with Formspree, Getform, Web3Forms, FormSubmit */
    function initLeadForm() {
        var form = document.getElementById('salut-lead-form');
        if (!form) return;

        form.addEventListener('submit', function (e) {
            e.preventDefault();

            var btn = form.querySelector('button[type="submit"]');
            var msg = form.querySelector('.form-message');
            var action = form.getAttribute('action') || '';

            msg.className = 'form-message';
            msg.textContent = '';

            if (!action || action.indexOf('YOUR_FORMSPREE_ID') > -1) {
                msg.className = 'form-message is-error';
                msg.textContent = '⚠️ Form chưa được cấu hình. Vui lòng liên hệ qua hotline hoặc Facebook.';
                return;
            }

            btn.classList.add('is-loading');
            btn.disabled = true;

            var data = new FormData(form);

            fetch(action, {
                method: 'POST',
                body: data,
                headers: { 'Accept': 'application/json' }
            })
                .then(function (res) {
                    btn.classList.remove('is-loading');
                    btn.disabled = false;

                    if (res.ok) {
                        msg.className = 'form-message is-success';
                        msg.textContent = '✅ Cảm ơn bạn! Salut sẽ liên hệ trong 24h. À bientôt!';
                        form.reset();
                        if (typeof gtag === 'function') {
                            gtag('event', 'lead_submit', { event_category: 'engagement' });
                        }
                        if (typeof fbq === 'function') {
                            fbq('track', 'Lead');
                        }
                        return;
                    }
                    return res.json().then(function (json) {
                        var errMsg = 'Có lỗi xảy ra, vui lòng thử lại.';
                        if (json && Array.isArray(json.errors) && json.errors.length) {
                            errMsg = json.errors.map(function (er) { return er.message; }).join(' · ');
                        }
                        msg.className = 'form-message is-error';
                        msg.textContent = errMsg;
                    });
                })
                .catch(function () {
                    btn.classList.remove('is-loading');
                    btn.disabled = false;
                    msg.className = 'form-message is-error';
                    msg.textContent = 'Không thể kết nối. Vui lòng thử lại hoặc gọi hotline.';
                });
        });
    }
})();
