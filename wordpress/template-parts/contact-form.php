<?php
/**
 * Contact / lead registration form.
 */
?>
<section class="contact-section" id="dang-ky">
    <div class="contact-decoration" aria-hidden="true">
        <svg class="deco deco-cloud" viewBox="0 0 120 60" fill="#FFE066" opacity="0.6">
            <path d="M20 40 Q10 30 20 22 Q25 12 40 18 Q50 8 65 18 Q85 15 90 30 Q105 32 100 45 Q95 55 80 52 L30 52 Q15 50 20 40 Z"/>
        </svg>
    </div>

    <div class="container grid-2 contact-grid">
        <div class="contact-info">
            <p class="section-kicker">Liên hệ</p>
            <h2 class="section-title"><span class="handwritten">Đăng ký</span> tư vấn miễn phí</h2>
            <p class="section-lede">Để lại thông tin — Salut sẽ liên hệ trong 24h để tư vấn lộ trình phù hợp nhất với bạn. Hoàn toàn miễn phí, không cam kết gì cả!</p>

            <ul class="contact-list">
                <li>
                    <span class="ci-icon">📍</span>
                    <div>
                        <strong>Địa chỉ</strong>
                        <p><?php echo esc_html( salut_opt('salut_address') ); ?></p>
                    </div>
                </li>
                <li>
                    <span class="ci-icon">📞</span>
                    <div>
                        <strong>Hotline</strong>
                        <p>
                            <a href="tel:<?php echo esc_attr( preg_replace('/\s/', '', salut_opt('salut_phone')) ); ?>"><?php echo esc_html( salut_opt('salut_phone') ); ?></a>
                            <?php if ( $fr = salut_opt('salut_phone_fr') ) : ?>
                                <br><small>🇫🇷 Pháp: <?php echo esc_html( $fr ); ?></small>
                            <?php endif; ?>
                        </p>
                    </div>
                </li>
                <li>
                    <span class="ci-icon">✉️</span>
                    <div>
                        <strong>Email</strong>
                        <p><a href="mailto:<?php echo esc_attr( salut_opt('salut_email') ); ?>"><?php echo esc_html( salut_opt('salut_email') ); ?></a></p>
                    </div>
                </li>
                <li>
                    <span class="ci-icon">💬</span>
                    <div>
                        <strong>Facebook</strong>
                        <p><a href="<?php echo esc_url( salut_opt('salut_facebook') ); ?>" target="_blank" rel="noopener">Salut - Chia sẻ Pháp ngữ</a></p>
                    </div>
                </li>
            </ul>
        </div>

        <form class="contact-form" id="salut-lead-form" novalidate>
            <h3>Để Salut liên hệ bạn nhé!</h3>

            <div class="form-row">
                <label>
                    <span>Họ tên *</span>
                    <input type="text" name="name" required placeholder="VD: Nguyễn Thu Hà">
                </label>
            </div>

            <div class="form-row form-row-2">
                <label>
                    <span>Số điện thoại *</span>
                    <input type="tel" name="phone" required placeholder="VD: 0987 654 321">
                </label>
                <label>
                    <span>Email</span>
                    <input type="email" name="email" placeholder="email@cua-ban.com">
                </label>
            </div>

            <div class="form-row">
                <label>
                    <span>Quan tâm khoá học</span>
                    <select name="course">
                        <option value="">-- Chọn khoá học --</option>
                        <option>Tiếng Pháp từ số 0</option>
                        <option>Ngữ pháp nền tảng</option>
                        <option>DELF A2 - B1 - B2</option>
                        <option>TCF Canada - TEF</option>
                        <option>TCF TP - TCF IRN</option>
                        <option>Giao tiếp phản xạ</option>
                        <option>Tư vấn lộ trình cá nhân</option>
                    </select>
                </label>
            </div>

            <div class="form-row">
                <label>
                    <span>Lời nhắn (không bắt buộc)</span>
                    <textarea name="message" rows="3" placeholder="Mục tiêu của bạn? Trình độ hiện tại? Thời gian mong muốn?"></textarea>
                </label>
            </div>

            <button type="submit" class="btn btn-primary btn-lg btn-block">
                <span class="btn-label">Gửi đăng ký</span>
                <span class="btn-loader" aria-hidden="true"></span>
            </button>

            <div class="form-note">🔒 Thông tin của bạn được bảo mật. Salut không spam, không bán dữ liệu.</div>
            <div class="form-message" role="status" aria-live="polite"></div>
        </form>
    </div>
</section>
