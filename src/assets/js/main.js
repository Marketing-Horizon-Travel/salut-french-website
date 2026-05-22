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
        initTestimonialCarousel();
        initStatCountUp();
    });

    /* Count-up animation for hero stat numbers. Parses each target string
       ("88,75%", "72,5", "+4 000") to preserve prefix/suffix, decimals,
       and thousand-space formatting; triggers once on viewport entry. */
    function initStatCountUp() {
        var nodes = document.querySelectorAll('.hero-stat strong');
        if (!nodes.length) return;

        function parse(text) {
            var m = text.match(/^([+\-]?)([\d.,\s]+)(.*)$/);
            if (!m) return null;
            var prefix = m[1];
            var numStr = m[2].trim();
            var suffix = m[3] || '';
            var hasDecimal = numStr.indexOf(',') !== -1;
            var hasSpace = numStr.indexOf(' ') !== -1;
            var decimals = hasDecimal ? numStr.split(',')[1].length : 0;
            var numeric = parseFloat(numStr.replace(/\s/g, '').replace(',', '.'));
            return { prefix: prefix, suffix: suffix, numeric: numeric, decimals: decimals, hasSpace: hasSpace };
        }

        function format(value, info) {
            var out;
            if (info.decimals > 0) {
                out = value.toFixed(info.decimals).replace('.', ',');
            } else if (info.hasSpace) {
                out = Math.round(value).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ' ');
            } else {
                out = Math.round(value).toString();
            }
            return info.prefix + out + info.suffix;
        }

        function animate(node, info, duration) {
            var start = null;
            // Reserve width so the layout doesn't jiggle while digits change
            node.style.minWidth = node.getBoundingClientRect().width + 'px';
            function step(ts) {
                if (start === null) start = ts;
                var t = Math.min(1, (ts - start) / duration);
                // easeOutCubic
                var eased = 1 - Math.pow(1 - t, 3);
                node.textContent = format(info.numeric * eased, info);
                if (t < 1) requestAnimationFrame(step);
                else node.textContent = format(info.numeric, info); // ensure exact final
            }
            requestAnimationFrame(step);
        }

        var prepared = [];
        nodes.forEach(function (node) {
            var info = parse(node.textContent.trim());
            if (!info || isNaN(info.numeric)) return;
            prepared.push({ node: node, info: info });
            node.textContent = format(0, info);
        });
        if (!prepared.length) return;

        function runAll() {
            prepared.forEach(function (item) { animate(item.node, item.info, 1400); });
        }

        if ('IntersectionObserver' in window) {
            var io = new IntersectionObserver(function (entries) {
                entries.forEach(function (e) {
                    if (e.isIntersecting) {
                        io.disconnect();
                        runAll();
                    }
                });
            }, { threshold: 0.4 });
            io.observe(prepared[0].node);
        } else {
            runAll();
        }
    }

    /* Testimonial carousel (homepage section 04b) */
    function initTestimonialCarousel() {
        document.querySelectorAll('[data-testimonial-carousel]').forEach(function (root) {
            var track = root.querySelector('.testimonial-track');
            var slides = root.querySelectorAll('.testimonial-slide');
            var dots = root.querySelectorAll('.testimonial-dot');
            var prev = root.querySelector('.testimonial-prev');
            var next = root.querySelector('.testimonial-next');
            if (!track || slides.length < 2) {
                if (prev) prev.style.display = 'none';
                if (next) next.style.display = 'none';
                if (root.querySelector('.testimonial-dots')) root.querySelector('.testimonial-dots').style.display = 'none';
                return;
            }
            var total = slides.length;
            var current = 0;
            var autoTimer = null;

            function go(i) {
                current = (i + total) % total;
                track.style.transform = 'translateX(-' + (current * 100) + '%)';
                dots.forEach(function (d, idx) {
                    d.classList.toggle('is-active', idx === current);
                });
            }
            function nextSlide() { go(current + 1); }
            function prevSlide() { go(current - 1); }
            function resetAuto() {
                if (autoTimer) clearInterval(autoTimer);
                autoTimer = setInterval(nextSlide, 7000);
            }

            if (prev) prev.addEventListener('click', function () { prevSlide(); resetAuto(); });
            if (next) next.addEventListener('click', function () { nextSlide(); resetAuto(); });
            dots.forEach(function (d) {
                d.addEventListener('click', function () { go(parseInt(d.getAttribute('data-slide'), 10) || 0); resetAuto(); });
            });
            root.addEventListener('mouseenter', function () { if (autoTimer) clearInterval(autoTimer); });
            root.addEventListener('mouseleave', resetAuto);

            resetAuto();
        });
    }

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

    /* Shrink/color-change header on scroll + hide on scroll-down / show on scroll-up */
    function initHeaderScroll() {
        var header = document.getElementById('site-header');
        if (!header) return;
        var scrolled = false;
        var hidden = false;
        var lastY = window.scrollY;
        var threshold = 80; // px before we start the hide/show behavior
        window.addEventListener('scroll', function () {
            var y = window.scrollY;

            // color/shrink state at the very top
            var isScrolled = y > 10;
            if (isScrolled !== scrolled) {
                scrolled = isScrolled;
                header.classList.toggle('is-scrolled', scrolled);
            }

            // hide on scroll-down, show on scroll-up (after threshold)
            if (y > threshold) {
                var delta = y - lastY;
                if (delta > 4 && !hidden) {
                    hidden = true;
                    header.classList.add('is-hidden');
                } else if (delta < -4 && hidden) {
                    hidden = false;
                    header.classList.remove('is-hidden');
                }
            } else if (hidden) {
                hidden = false;
                header.classList.remove('is-hidden');
            }
            lastY = y;
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
