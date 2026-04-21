<?php
/**
 * Theme setup — supports, image sizes, customizer.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

function salut_theme_setup() {
    load_theme_textdomain( 'salut', SALUT_DIR . '/languages' );

    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'custom-logo', array(
        'height'      => 80,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ) );
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'responsive-embeds' );
    add_theme_support( 'align-wide' );

    add_image_size( 'salut-course', 640, 420, true );
    add_image_size( 'salut-hero', 1600, 800, true );
    add_image_size( 'salut-card', 420, 280, true );
}
add_action( 'after_setup_theme', 'salut_theme_setup' );

/**
 * Customizer — contact info, hero text, social links.
 */
function salut_customize_register( $wp_customize ) {
    $wp_customize->add_section( 'salut_contact', array(
        'title'    => __( 'Thông tin liên hệ Salut', 'salut' ),
        'priority' => 30,
    ) );

    $fields = array(
        'salut_phone'     => array( 'label' => 'Số điện thoại', 'default' => '+84 827 030 018' ),
        'salut_phone_fr'  => array( 'label' => 'SĐT Pháp (nếu có)', 'default' => '+33 17 69 10 01 08' ),
        'salut_email'     => array( 'label' => 'Email', 'default' => 'contact@tiengphapsalut.vn' ),
        'salut_address'   => array( 'label' => 'Địa chỉ', 'default' => 'Hà Nội, Việt Nam' ),
        'salut_facebook'  => array( 'label' => 'Facebook URL', 'default' => 'https://www.facebook.com/Tiengphapsalut' ),
        'salut_tiktok'    => array( 'label' => 'TikTok URL', 'default' => '' ),
        'salut_youtube'   => array( 'label' => 'YouTube URL', 'default' => '' ),
        'salut_hero_title'    => array( 'label' => 'Tiêu đề hero', 'default' => 'Nói tiếng Pháp cùng Salut' ),
        'salut_hero_subtitle' => array( 'label' => 'Phụ đề hero', 'default' => 'Luyện thi TCF · DELF · TEF từ con số 0 cùng đội ngũ giảng viên tận tâm tại Hà Nội.' ),
    );

    foreach ( $fields as $id => $conf ) {
        $wp_customize->add_setting( $id, array(
            'default'           => $conf['default'],
            'sanitize_callback' => 'sanitize_text_field',
        ) );
        $wp_customize->add_control( $id, array(
            'label'   => $conf['label'],
            'section' => 'salut_contact',
            'type'    => 'text',
        ) );
    }
}
add_action( 'customize_register', 'salut_customize_register' );

function salut_opt( $key, $default = '' ) {
    return get_theme_mod( $key, $default );
}
