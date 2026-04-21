<?php
/**
 * 404 page.
 */
get_header(); ?>

<section class="error-404">
    <div class="container">
        <div class="error-emoji">🥐</div>
        <h1 class="handwritten">Oups! Trang không tồn tại</h1>
        <p>Có vẻ trang bạn tìm đã "đi Paris" rồi. Quay về trang chủ nhé!</p>
        <div class="error-actions">
            <a href="<?php echo esc_url( home_url('/') ); ?>" class="btn btn-primary">← Về trang chủ</a>
            <a href="<?php echo esc_url( home_url('/khoa-hoc/') ); ?>" class="btn btn-outline">Xem khoá học</a>
        </div>
    </div>
</section>

<?php get_footer();
