<?php
/**
 * Header template.
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#B8A7E0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link screen-reader-text" href="#main"><?php _e( 'Bỏ qua tới nội dung', 'salut' ); ?></a>

<header class="site-header" id="site-header">
    <div class="header-inner container">
        <div class="site-brand">
            <?php if ( has_custom_logo() ) : the_custom_logo(); else : ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="brand-link">
                    <span class="brand-mark">SALUT</span>
                    <span class="brand-tag">Chia sẻ Pháp ngữ</span>
                </a>
            <?php endif; ?>
        </div>

        <nav class="site-nav" aria-label="Menu chính">
            <?php
            wp_nav_menu( array(
                'theme_location' => 'primary',
                'container'      => false,
                'menu_class'     => 'primary-menu',
                'fallback_cb'    => 'salut_default_menu',
                'depth'          => 2,
            ) );
            ?>
        </nav>

        <div class="header-cta">
            <a href="tel:<?php echo esc_attr( preg_replace('/\s/', '', salut_opt('salut_phone')) ); ?>" class="phone-link" aria-label="Gọi điện">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                <span><?php echo esc_html( salut_opt( 'salut_phone' ) ); ?></span>
            </a>
            <a href="#dang-ky" class="btn btn-primary">Đăng ký tư vấn</a>
        </div>

        <button class="menu-toggle" aria-label="Mở menu" aria-expanded="false">
            <span></span><span></span><span></span>
        </button>
    </div>
</header>

<?php
function salut_default_menu() {
    echo '<ul class="primary-menu">';
    echo '<li><a href="' . esc_url( home_url('/') ) . '">Trang chủ</a></li>';
    echo '<li><a href="' . esc_url( home_url('/#gioi-thieu') ) . '">Về Salut</a></li>';
    echo '<li><a href="' . esc_url( home_url('/khoa-hoc/') ) . '">Khoá học</a></li>';
    echo '<li><a href="' . esc_url( home_url('/#lich-khai-giang') ) . '">Lịch khai giảng</a></li>';
    echo '<li><a href="' . esc_url( home_url('/blog/') ) . '">Blog</a></li>';
    echo '<li><a href="' . esc_url( home_url('/lien-he/') ) . '">Liên hệ</a></li>';
    echo '</ul>';
}
?>

<main id="main" class="site-main">
