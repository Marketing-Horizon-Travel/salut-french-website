<?php
/**
 * Footer template.
 */
?>
</main>

<section class="cta-band">
    <div class="container cta-band-inner">
        <div class="cta-text">
            <p class="cta-kicker">Oui Oui Baguette!</p>
            <h2>Sẵn sàng nói tiếng Pháp <span class="handwritten">cùng Salut</span>?</h2>
            <p>Để lại thông tin, đội ngũ Salut sẽ liên hệ tư vấn lộ trình học phù hợp nhất cho bạn.</p>
        </div>
        <a href="#dang-ky" class="btn btn-yellow btn-lg">Đăng ký ngay →</a>
    </div>
</section>

<footer class="site-footer" id="site-footer">
    <div class="container footer-grid">
        <div class="footer-col">
            <div class="footer-brand">SALUT</div>
            <p class="footer-tag">Chia sẻ Pháp ngữ · Hà Nội</p>
            <p class="footer-desc">Trung tâm tiếng Pháp dành cho người bắt đầu từ con số 0 đến luyện thi TCF, DELF, TEF. Học cùng đội ngũ giảng viên trẻ, tận tâm, phương pháp vui và hiệu quả.</p>
            <div class="socials">
                <?php if ( $fb = salut_opt('salut_facebook') ) : ?>
                    <a href="<?php echo esc_url( $fb ); ?>" target="_blank" rel="noopener" aria-label="Facebook">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.44 8.87 8 9.8V15H8v-3h2V9.5C10 7.57 11.57 6 13.5 6H16v3h-2c-.55 0-1 .45-1 1v2h3v3h-3v6.95c5.05-.5 9-4.76 9-9.95z"/></svg>
                    </a>
                <?php endif; ?>
                <?php if ( $tt = salut_opt('salut_tiktok') ) : ?>
                    <a href="<?php echo esc_url( $tt ); ?>" target="_blank" rel="noopener" aria-label="TikTok">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5.8 20.1a6.34 6.34 0 0 0 10.86-4.43V8.84a8.16 8.16 0 0 0 4.77 1.52V6.94a4.85 4.85 0 0 1-1.84-.25z"/></svg>
                    </a>
                <?php endif; ?>
                <?php if ( $yt = salut_opt('salut_youtube') ) : ?>
                    <a href="<?php echo esc_url( $yt ); ?>" target="_blank" rel="noopener" aria-label="YouTube">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M23.5 6.19a3 3 0 0 0-2.12-2.12C19.5 3.5 12 3.5 12 3.5s-7.5 0-9.38.57A3 3 0 0 0 .5 6.19 31.26 31.26 0 0 0 0 12a31.26 31.26 0 0 0 .5 5.81 3 3 0 0 0 2.12 2.12C4.5 20.5 12 20.5 12 20.5s7.5 0 9.38-.57a3 3 0 0 0 2.12-2.12A31.26 31.26 0 0 0 24 12a31.26 31.26 0 0 0-.5-5.81zM9.75 15.5v-7l6.5 3.5z"/></svg>
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <div class="footer-col">
            <h4>Khoá học</h4>
            <ul>
                <li><a href="<?php echo esc_url( home_url('/khoa-hoc/')); ?>">TCF Canada · TEF</a></li>
                <li><a href="<?php echo esc_url( home_url('/khoa-hoc/')); ?>">DELF A2 · B1 · B2</a></li>
                <li><a href="<?php echo esc_url( home_url('/khoa-hoc/')); ?>">TCF TP · TCF IRN</a></li>
                <li><a href="<?php echo esc_url( home_url('/khoa-hoc/')); ?>">Ngữ pháp nền tảng</a></li>
                <li><a href="<?php echo esc_url( home_url('/khoa-hoc/')); ?>">Tiếng Pháp từ số 0</a></li>
            </ul>
        </div>

        <div class="footer-col">
            <h4>Liên hệ</h4>
            <ul class="footer-contact">
                <li>📍 <?php echo esc_html( salut_opt('salut_address') ); ?></li>
                <li>📞 <a href="tel:<?php echo esc_attr( preg_replace('/\s/', '', salut_opt('salut_phone')) ); ?>"><?php echo esc_html( salut_opt('salut_phone') ); ?></a></li>
                <?php if ( $fr = salut_opt('salut_phone_fr') ) : ?>
                    <li>🇫🇷 <?php echo esc_html( $fr ); ?></li>
                <?php endif; ?>
                <li>✉️ <a href="mailto:<?php echo esc_attr( salut_opt('salut_email') ); ?>"><?php echo esc_html( salut_opt('salut_email') ); ?></a></li>
            </ul>
        </div>

        <div class="footer-col">
            <h4>Đăng ký nhận tin</h4>
            <p class="footer-desc">Cẩm nang học tiếng Pháp, tips luyện thi & ưu đãi khoá mới — 1 email/tuần.</p>
            <form class="newsletter" onsubmit="event.preventDefault(); alert('Cảm ơn bạn đã đăng ký!');">
                <input type="email" placeholder="email@cua-ban.com" required>
                <button type="submit" class="btn btn-primary">Gửi</button>
            </form>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <p>© <?php echo date('Y'); ?> Salut - Chia sẻ Pháp ngữ. Tous droits réservés. · Made with 🥐 in Hanoi</p>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
