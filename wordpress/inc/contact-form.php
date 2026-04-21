<?php
/**
 * Form đăng ký tư vấn — AJAX, lưu vào CPT "lead" + gửi email.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'init', function() {
    register_post_type( 'lead', array(
        'labels' => array(
            'name'          => 'Đăng ký tư vấn',
            'singular_name' => 'Lượt đăng ký',
            'menu_name'     => 'Đăng ký',
        ),
        'public'        => false,
        'show_ui'       => true,
        'menu_icon'     => 'dashicons-email-alt',
        'supports'      => array( 'title' ),
        'capability_type' => 'post',
    ) );
} );

function salut_handle_lead() {
    check_ajax_referer( 'salut_nonce', 'nonce' );

    $name    = isset( $_POST['name'] )    ? sanitize_text_field( wp_unslash( $_POST['name'] ) )    : '';
    $phone   = isset( $_POST['phone'] )   ? sanitize_text_field( wp_unslash( $_POST['phone'] ) )   : '';
    $email   = isset( $_POST['email'] )   ? sanitize_email( wp_unslash( $_POST['email'] ) )        : '';
    $course  = isset( $_POST['course'] )  ? sanitize_text_field( wp_unslash( $_POST['course'] ) )  : '';
    $message = isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';

    if ( empty( $name ) || empty( $phone ) ) {
        wp_send_json_error( array( 'msg' => 'Vui lòng nhập họ tên và số điện thoại.' ) );
    }

    if ( ! preg_match( '/^[0-9+\s\-()]{8,20}$/', $phone ) ) {
        wp_send_json_error( array( 'msg' => 'Số điện thoại không hợp lệ.' ) );
    }

    $lead_id = wp_insert_post( array(
        'post_type'   => 'lead',
        'post_status' => 'publish',
        'post_title'  => sprintf( '%s - %s - %s', $name, $phone, current_time( 'Y-m-d H:i' ) ),
        'post_content' => $message,
    ) );

    if ( is_wp_error( $lead_id ) || ! $lead_id ) {
        wp_send_json_error( array( 'msg' => 'Có lỗi xảy ra, vui lòng thử lại.' ) );
    }

    update_post_meta( $lead_id, '_lead_name',   $name );
    update_post_meta( $lead_id, '_lead_phone',  $phone );
    update_post_meta( $lead_id, '_lead_email',  $email );
    update_post_meta( $lead_id, '_lead_course', $course );

    $admin_email = salut_opt( 'salut_email', get_option( 'admin_email' ) );
    $subject     = '[Salut] Đăng ký tư vấn mới: ' . $name;
    $body        = "Học viên vừa đăng ký tư vấn trên website:\n\n"
                 . "Họ tên: {$name}\n"
                 . "SĐT: {$phone}\n"
                 . "Email: {$email}\n"
                 . "Quan tâm: {$course}\n"
                 . "Tin nhắn: {$message}\n\n"
                 . "Xem chi tiết: " . admin_url( 'post.php?post=' . $lead_id . '&action=edit' );

    wp_mail( $admin_email, $subject, $body );

    wp_send_json_success( array( 'msg' => 'Cảm ơn bạn! Salut sẽ liên hệ trong 24h. À bientôt!' ) );
}
add_action( 'wp_ajax_salut_lead', 'salut_handle_lead' );
add_action( 'wp_ajax_nopriv_salut_lead', 'salut_handle_lead' );

/**
 * Hiển thị cột thông tin trong danh sách Leads ở admin.
 */
add_filter( 'manage_lead_posts_columns', function( $cols ) {
    $cols['lead_phone']  = 'SĐT';
    $cols['lead_email']  = 'Email';
    $cols['lead_course'] = 'Quan tâm';
    return $cols;
} );
add_action( 'manage_lead_posts_custom_column', function( $col, $post_id ) {
    echo esc_html( get_post_meta( $post_id, '_' . $col, true ) );
}, 10, 2 );
