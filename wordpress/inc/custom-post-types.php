<?php
/**
 * Custom post types: Khoá học, Lịch khai giảng, Testimonial.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

function salut_register_cpts() {

    register_post_type( 'course', array(
        'labels' => array(
            'name'          => 'Khoá học',
            'singular_name' => 'Khoá học',
            'add_new_item'  => 'Thêm khoá học mới',
            'edit_item'     => 'Sửa khoá học',
            'menu_name'     => 'Khoá học',
        ),
        'public'        => true,
        'has_archive'   => true,
        'menu_icon'     => 'dashicons-welcome-learn-more',
        'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes' ),
        'rewrite'       => array( 'slug' => 'khoa-hoc' ),
        'show_in_rest'  => true,
    ) );

    register_taxonomy( 'course_level', 'course', array(
        'labels' => array(
            'name'          => 'Cấp độ',
            'singular_name' => 'Cấp độ',
        ),
        'hierarchical'  => true,
        'show_in_rest'  => true,
        'rewrite'       => array( 'slug' => 'cap-do' ),
    ) );

    register_post_type( 'schedule', array(
        'labels' => array(
            'name'          => 'Lịch khai giảng',
            'singular_name' => 'Lớp học',
            'add_new_item'  => 'Thêm lớp mới',
            'menu_name'     => 'Lịch khai giảng',
        ),
        'public'        => true,
        'has_archive'   => false,
        'menu_icon'     => 'dashicons-calendar-alt',
        'supports'      => array( 'title', 'editor' ),
        'rewrite'       => array( 'slug' => 'lich-hoc' ),
    ) );

    register_post_type( 'testimonial', array(
        'labels' => array(
            'name'          => 'Cảm nhận học viên',
            'singular_name' => 'Cảm nhận',
            'menu_name'     => 'Cảm nhận',
        ),
        'public'        => false,
        'show_ui'       => true,
        'menu_icon'     => 'dashicons-format-quote',
        'supports'      => array( 'title', 'editor', 'thumbnail' ),
    ) );
}
add_action( 'init', 'salut_register_cpts' );

/**
 * Meta boxes for Khoá học and Lịch khai giảng.
 */
function salut_add_meta_boxes() {
    add_meta_box( 'salut_course_meta', 'Chi tiết khoá học', 'salut_course_meta_cb', 'course', 'normal', 'high' );
    add_meta_box( 'salut_schedule_meta', 'Thông tin lớp học', 'salut_schedule_meta_cb', 'schedule', 'normal', 'high' );
    add_meta_box( 'salut_testimonial_meta', 'Thông tin học viên', 'salut_testimonial_meta_cb', 'testimonial', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'salut_add_meta_boxes' );

function salut_course_meta_cb( $post ) {
    wp_nonce_field( 'salut_course_meta', 'salut_course_nonce' );
    $price     = get_post_meta( $post->ID, '_salut_price', true );
    $duration  = get_post_meta( $post->ID, '_salut_duration', true );
    $sessions  = get_post_meta( $post->ID, '_salut_sessions', true );
    $goal      = get_post_meta( $post->ID, '_salut_goal', true );
    $icon      = get_post_meta( $post->ID, '_salut_icon', true );
    ?>
    <p><label><strong>Học phí</strong><br><input type="text" name="salut_price" value="<?php echo esc_attr( $price ); ?>" placeholder="VD: 3.500.000đ" style="width:100%"></label></p>
    <p><label><strong>Thời lượng</strong><br><input type="text" name="salut_duration" value="<?php echo esc_attr( $duration ); ?>" placeholder="VD: 3 tháng" style="width:100%"></label></p>
    <p><label><strong>Số buổi</strong><br><input type="text" name="salut_sessions" value="<?php echo esc_attr( $sessions ); ?>" placeholder="VD: 36 buổi" style="width:100%"></label></p>
    <p><label><strong>Mục tiêu đầu ra</strong><br><input type="text" name="salut_goal" value="<?php echo esc_attr( $goal ); ?>" placeholder="VD: Đạt DELF B1" style="width:100%"></label></p>
    <p><label><strong>Icon emoji</strong><br><input type="text" name="salut_icon" value="<?php echo esc_attr( $icon ); ?>" placeholder="VD: 🥐" style="width:100%"></label></p>
    <?php
}

function salut_schedule_meta_cb( $post ) {
    wp_nonce_field( 'salut_schedule_meta', 'salut_schedule_nonce' );
    $start_date = get_post_meta( $post->ID, '_salut_start_date', true );
    $time       = get_post_meta( $post->ID, '_salut_time', true );
    $level      = get_post_meta( $post->ID, '_salut_level', true );
    $teacher    = get_post_meta( $post->ID, '_salut_teacher', true );
    $slots      = get_post_meta( $post->ID, '_salut_slots', true );
    ?>
    <p><label><strong>Ngày khai giảng</strong><br><input type="date" name="salut_start_date" value="<?php echo esc_attr( $start_date ); ?>"></label></p>
    <p><label><strong>Lịch học</strong><br><input type="text" name="salut_time" value="<?php echo esc_attr( $time ); ?>" placeholder="VD: T2-4-6 · 19h-21h" style="width:100%"></label></p>
    <p><label><strong>Cấp độ</strong><br><input type="text" name="salut_level" value="<?php echo esc_attr( $level ); ?>" placeholder="VD: DELF B1" style="width:100%"></label></p>
    <p><label><strong>Giảng viên</strong><br><input type="text" name="salut_teacher" value="<?php echo esc_attr( $teacher ); ?>" placeholder="VD: Cô Hà Anh" style="width:100%"></label></p>
    <p><label><strong>Còn trống (slot)</strong><br><input type="number" name="salut_slots" value="<?php echo esc_attr( $slots ); ?>" placeholder="VD: 5" style="width:100px"></label></p>
    <?php
}

function salut_testimonial_meta_cb( $post ) {
    wp_nonce_field( 'salut_testimonial_meta', 'salut_testimonial_nonce' );
    $role  = get_post_meta( $post->ID, '_salut_role', true );
    $score = get_post_meta( $post->ID, '_salut_score', true );
    ?>
    <p><label><strong>Chú thích (nghề nghiệp, trường...)</strong><br><input type="text" name="salut_role" value="<?php echo esc_attr( $role ); ?>" placeholder="VD: Du học sinh Canada" style="width:100%"></label></p>
    <p><label><strong>Thành tích</strong><br><input type="text" name="salut_score" value="<?php echo esc_attr( $score ); ?>" placeholder="VD: TCF 450 điểm" style="width:100%"></label></p>
    <?php
}

function salut_save_meta( $post_id ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    $map = array(
        'salut_course_nonce' => array(
            'action' => 'salut_course_meta',
            'fields' => array( 'salut_price', 'salut_duration', 'salut_sessions', 'salut_goal', 'salut_icon' ),
        ),
        'salut_schedule_nonce' => array(
            'action' => 'salut_schedule_meta',
            'fields' => array( 'salut_start_date', 'salut_time', 'salut_level', 'salut_teacher', 'salut_slots' ),
        ),
        'salut_testimonial_nonce' => array(
            'action' => 'salut_testimonial_meta',
            'fields' => array( 'salut_role', 'salut_score' ),
        ),
    );

    foreach ( $map as $nonce_key => $conf ) {
        if ( empty( $_POST[ $nonce_key ] ) || ! wp_verify_nonce( $_POST[ $nonce_key ], $conf['action'] ) ) continue;
        foreach ( $conf['fields'] as $field ) {
            if ( isset( $_POST[ $field ] ) ) {
                update_post_meta( $post_id, '_' . $field, sanitize_text_field( wp_unslash( $_POST[ $field ] ) ) );
            }
        }
    }
}
add_action( 'save_post', 'salut_save_meta' );
