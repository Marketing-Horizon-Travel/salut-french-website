<?php
/**
 * About section — why Salut.
 */
?>
<section class="about-section" id="gioi-thieu">
    <div class="container grid-2">
        <div class="about-visual">
            <div class="about-sticker sticker-1">Bonjour!</div>
            <div class="about-sticker sticker-2">à bientôt</div>
            <div class="about-image-wrap">
                <?php
                $about_img = SALUT_URI . '/assets/images/about.jpg';
                ?>
                <img src="<?php echo esc_url( $about_img ); ?>" alt="Lớp học Salut" loading="lazy"
                     onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                <div class="about-image-fallback" style="display:none;">
                    <span class="fallback-emoji">🥐</span>
                    <p>Học viên Salut</p>
                </div>
            </div>
        </div>

        <div class="about-text">
            <p class="section-kicker">Về Salut</p>
            <h2 class="section-title">
                <span class="handwritten">Không chỉ</span> học tiếng Pháp,
                <br>mà là <em>yêu</em> tiếng Pháp.
            </h2>
            <p class="section-lede">
                Salut ra đời từ tình yêu với ngôn ngữ và văn hoá Pháp.
                Chúng mình tin rằng học ngoại ngữ không phải là gánh nặng —
                mà là hành trình khám phá đầy thú vị.
            </p>

            <ul class="about-points">
                <li>
                    <span class="point-icon">🎓</span>
                    <div>
                        <strong>Giảng viên bản ngữ & du học sinh</strong>
                        <p>Đội ngũ trẻ, có kinh nghiệm thi TCF/DELF điểm cao, hiểu rõ nhu cầu người Việt.</p>
                    </div>
                </li>
                <li>
                    <span class="point-icon">🗺️</span>
                    <div>
                        <strong>Lộ trình cá nhân hoá</strong>
                        <p>Từ con số 0 đến B2. Mỗi học viên một lộ trình riêng, phù hợp mục tiêu (du học, định cư, làm việc).</p>
                    </div>
                </li>
                <li>
                    <span class="point-icon">💬</span>
                    <div>
                        <strong>Học mà chơi</strong>
                        <p>Lớp nhỏ 6-10 người, workshop văn hoá, café Pháp hàng tuần — tiếng Pháp trở thành một phần cuộc sống.</p>
                    </div>
                </li>
            </ul>

            <a href="#dang-ky" class="btn btn-primary">Tìm hiểu lộ trình phù hợp →</a>
        </div>
    </div>
</section>
