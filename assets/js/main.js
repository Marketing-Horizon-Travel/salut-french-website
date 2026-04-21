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
    });

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

    /* AJAX lead form submission */
    function initLeadForm() {
        var form = document.getElementById('salut-lead-form');
        if (!form) return;

        form.addEventListener('submit', function (e) {
            e.preventDefault();

            var btn = form.querySelector('button[type="submit"]');
            var msg = form.querySelector('.form-message');
            msg.className = 'form-message';
            msg.textContent = '';

            btn.classList.add('is-loading');
            btn.disabled = true;

            var data = new FormData(form);
            data.append('action', 'salut_lead');
            data.append('nonce', window.salutData ? window.salutData.nonce : '');

            var ajaxUrl = window.salutData ? window.salutData.ajaxUrl : '/wp-admin/admin-ajax.php';

            fetch(ajaxUrl, {
                method: 'POST',
                body: data,
                credentials: 'same-origin'
            })
                .then(function (r) { return r.json(); })
                .then(function (json) {
                    btn.classList.remove('is-loading');
                    btn.disabled = false;

                    if (json && json.success) {
                        msg.className = 'form-message is-success';
                        msg.textContent = json.data.msg || 'Cảm ơn bạn!';
                        form.reset();
                        if (typeof gtag === 'function') {
                            gtag('event', 'lead_submit', { event_category: 'engagement' });
                        }
                    } else {
                        msg.className = 'form-message is-error';
                        msg.textContent = (json && json.data && json.data.msg) || 'Có lỗi xảy ra, vui lòng thử lại.';
                    }
                })
                .catch(function () {
                    btn.classList.remove('is-loading');
                    btn.disabled = false;
                    msg.className = 'form-message is-error';
                    msg.textContent = 'Không thể kết nối máy chủ. Vui lòng thử lại hoặc gọi hotline.';
                });
        });
    }
})();
