<?php
/**
 * Salut Français - Theme functions
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'SALUT_VERSION', '1.0.0' );
define( 'SALUT_DIR', get_template_directory() );
define( 'SALUT_URI', get_template_directory_uri() );

require_once SALUT_DIR . '/inc/theme-setup.php';
require_once SALUT_DIR . '/inc/custom-post-types.php';
require_once SALUT_DIR . '/inc/contact-form.php';

function salut_enqueue_assets() {
    wp_enqueue_style(
        'salut-google-fonts',
        'https://fonts.googleapis.com/css2?family=Caveat:wght@400;600;700&family=Poppins:wght@300;400;500;600;700;800&family=Pacifico&display=swap',
        array(),
        null
    );

    wp_enqueue_style(
        'salut-main',
        SALUT_URI . '/assets/css/main.css',
        array( 'salut-google-fonts' ),
        SALUT_VERSION
    );

    wp_enqueue_script(
        'salut-main',
        SALUT_URI . '/assets/js/main.js',
        array( 'jquery' ),
        SALUT_VERSION,
        true
    );

    wp_localize_script( 'salut-main', 'salutData', array(
        'ajaxUrl' => admin_url( 'admin-ajax.php' ),
        'nonce'   => wp_create_nonce( 'salut_nonce' ),
    ) );
}
add_action( 'wp_enqueue_scripts', 'salut_enqueue_assets' );

function salut_register_menus() {
    register_nav_menus( array(
        'primary' => __( 'Menu chính', 'salut' ),
        'footer'  => __( 'Menu footer', 'salut' ),
    ) );
}
add_action( 'after_setup_theme', 'salut_register_menus' );

function salut_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Sidebar Blog', 'salut' ),
        'id'            => 'sidebar-blog',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'salut_widgets_init' );

function salut_excerpt_length( $length ) { return 25; }
add_filter( 'excerpt_length', 'salut_excerpt_length' );

function salut_excerpt_more( $more ) { return '…'; }
add_filter( 'excerpt_more', 'salut_excerpt_more' );
