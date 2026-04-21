<?php
/**
 * Hero section — lavender bg, handwritten headline, Eiffel silhouette.
 */
?>
<section class="hero" aria-label="Giới thiệu">
    <div class="hero-decorations" aria-hidden="true">
        <svg class="deco deco-plane" viewBox="0 0 64 64" fill="none" stroke="#6B5B95" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M4 30 L60 4 L44 60 L34 36 L10 28 Z"/>
            <path d="M34 36 L44 22"/>
            <path d="M8 40 Q14 38 20 40" stroke-dasharray="2 3"/>
            <path d="M6 48 Q14 46 22 48" stroke-dasharray="2 3"/>
        </svg>
        <svg class="deco deco-star" viewBox="0 0 24 24" fill="#FFE066"><path d="M12 2 L14 10 L22 12 L14 14 L12 22 L10 14 L2 12 L10 10 Z"/></svg>
        <svg class="deco deco-star deco-star-2" viewBox="0 0 24 24" fill="#FFE066"><path d="M12 2 L14 10 L22 12 L14 14 L12 22 L10 14 L2 12 L10 10 Z"/></svg>
        <svg class="deco deco-sparkle" viewBox="0 0 24 24" fill="none" stroke="#6B5B95" stroke-width="2" stroke-linecap="round">
            <path d="M12 2 V8 M12 16 V22 M2 12 H8 M16 12 H22"/>
        </svg>
    </div>

    <div class="container hero-grid">
        <div class="hero-left">
            <span class="hero-kicker">Oui Oui Baguette!</span>
            <h1 class="hero-title">
                <span class="handwritten-big">Nói tiếng Pháp</span>
                <span class="hero-subline">cùng <em class="hero-brand">Salut</em></span>
            </h1>
            <p class="hero-lede">
                <?php echo esc_html( salut_opt( 'salut_hero_subtitle', 'Luyện thi TCF · DELF · TEF từ con số 0 cùng đội ngũ giảng viên tận tâm tại Hà Nội.' ) ); ?>
            </p>

            <div class="hero-ctas">
                <a href="#dang-ky" class="btn btn-primary btn-lg">Đăng ký tư vấn miễn phí</a>
                <a href="#khoa-hoc" class="btn btn-outline btn-lg">Xem khoá học →</a>
            </div>

            <ul class="hero-stats">
                <li><strong>500+</strong><span>Học viên</span></li>
                <li><strong>95%</strong><span>Đạt mục tiêu</span></li>
                <li><strong>4.9★</strong><span>Phản hồi</span></li>
            </ul>
        </div>

        <div class="hero-right">
            <div class="hero-card">
                <p class="card-kicker">Các khoá học</p>
                <ul class="course-pills">
                    <li>🎯 TCF Canada · TEF</li>
                    <li>📜 DELF A2 · B1 · B2</li>
                    <li>🌏 TCF TP · TCF IRN</li>
                    <li>📖 Ngữ pháp nền tảng</li>
                </ul>
                <p class="card-tag">Đào tạo tiếng Pháp luyện thi từ con số 0</p>
            </div>

            <svg class="hero-eiffel" viewBox="0 0 200 400" fill="none" stroke="#6B5B95" stroke-width="1.5" aria-hidden="true">
                <path d="M100 20 L100 60"/>
                <path d="M90 60 L110 60"/>
                <path d="M85 80 L115 80 L100 60 Z"/>
                <path d="M80 100 L120 100"/>
                <path d="M80 100 L70 180 L130 180 L120 100"/>
                <path d="M70 180 L60 260 L140 260 L130 180"/>
                <path d="M60 260 L40 380 L160 380 L140 260"/>
                <path d="M50 320 L150 320"/>
                <path d="M65 280 L135 280"/>
                <path d="M80 140 L120 140"/>
                <path d="M85 200 L115 200"/>
                <path d="M40 380 L30 400 L170 400 L160 380"/>
            </svg>
        </div>
    </div>

    <div class="hero-wave" aria-hidden="true">
        <svg viewBox="0 0 1440 80" preserveAspectRatio="none">
            <path d="M0,40 Q360,80 720,40 T1440,40 L1440,80 L0,80 Z" fill="#FFF9F0"/>
        </svg>
    </div>
</section>
