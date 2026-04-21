<?php
/**
 * Schedule section — upcoming class openings.
 */

$schedules = get_posts( array(
    'post_type'      => 'schedule',
    'posts_per_page' => 6,
    'meta_key'       => '_salut_start_date',
    'orderby'        => 'meta_value',
    'order'          => 'ASC',
    'meta_query'     => array(
        array(
            'key'     => '_salut_start_date',
            'value'   => current_time('Y-m-d'),
            'compare' => '>=',
            'type'    => 'DATE',
        ),
    ),
) );

$fallback = array(
    array( 'level' => 'DELF B1', 'date' => '15/05/2026', 'time' => 'T2-4-6 · 19h00-21h00', 'teacher' => 'Cô Hà Anh', 'slots' => 4 ),
    array( 'level' => 'TCF Canada', 'date' => '20/05/2026', 'time' => 'T3-5-7 · 18h30-20h30', 'teacher' => 'Thầy Minh', 'slots' => 3 ),
    array( 'level' => 'A1 - Sơ cấp', 'date' => '22/05/2026', 'time' => 'T2-4 · 19h30-21h30', 'teacher' => 'Cô Linh', 'slots' => 8 ),
    array( 'level' => 'DELF A2', 'date' => '27/05/2026', 'time' => 'T3-5 · 19h00-21h00', 'teacher' => 'Cô Ngọc', 'slots' => 5 ),
    array( 'level' => 'Giao tiếp B1+', 'date' => '01/06/2026', 'time' => 'T7-CN · 14h-16h', 'teacher' => 'Thầy Pierre (bản ngữ)', 'slots' => 2 ),
    array( 'level' => 'Ngữ pháp nền', 'date' => '03/06/2026', 'time' => 'T2-4-6 · 18h-20h', 'teacher' => 'Cô Hà Anh', 'slots' => 6 ),
);
?>
<section class="schedule-section" id="lich-khai-giang">
    <div class="container">
        <div class="section-head">
            <p class="section-kicker">Lịch khai giảng</p>
            <h2 class="section-title"><span class="handwritten">Sắp khai giảng</span> các lớp mới</h2>
            <p class="section-lede">Cập nhật lịch học mới nhất. Số lượng mỗi lớp có hạn — đăng ký sớm để giữ slot nhé!</p>
        </div>

        <div class="schedule-table-wrap">
            <table class="schedule-table">
                <thead>
                    <tr>
                        <th>Lớp</th>
                        <th>Khai giảng</th>
                        <th>Lịch học</th>
                        <th>Giảng viên</th>
                        <th>Còn trống</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ( ! empty( $schedules ) ) : ?>
                        <?php foreach ( $schedules as $s ) :
                            $start   = get_post_meta( $s->ID, '_salut_start_date', true );
                            $time    = get_post_meta( $s->ID, '_salut_time', true );
                            $level   = get_post_meta( $s->ID, '_salut_level', true );
                            $teacher = get_post_meta( $s->ID, '_salut_teacher', true );
                            $slots   = (int) get_post_meta( $s->ID, '_salut_slots', true );
                        ?>
                            <tr>
                                <td><strong><?php echo esc_html( $level ?: get_the_title( $s ) ); ?></strong></td>
                                <td><?php echo esc_html( $start ? date_i18n('d/m/Y', strtotime($start)) : '—' ); ?></td>
                                <td><?php echo esc_html( $time ); ?></td>
                                <td><?php echo esc_html( $teacher ); ?></td>
                                <td><span class="slot-badge <?php echo $slots <= 3 ? 'slot-low' : ''; ?>"><?php echo $slots > 0 ? $slots . ' chỗ' : 'Đã đầy'; ?></span></td>
                                <td><a href="#dang-ky" class="btn btn-sm btn-primary">Đăng ký</a></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <?php foreach ( $fallback as $s ) : ?>
                            <tr>
                                <td><strong><?php echo esc_html( $s['level'] ); ?></strong></td>
                                <td><?php echo esc_html( $s['date'] ); ?></td>
                                <td><?php echo esc_html( $s['time'] ); ?></td>
                                <td><?php echo esc_html( $s['teacher'] ); ?></td>
                                <td><span class="slot-badge <?php echo $s['slots'] <= 3 ? 'slot-low' : ''; ?>"><?php echo esc_html( $s['slots'] ); ?> chỗ</span></td>
                                <td><a href="#dang-ky" class="btn btn-sm btn-primary">Đăng ký</a></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <p class="schedule-note">* Lớp học mở lớp tối thiểu 4 học viên. Nếu lớp phù hợp chưa có, để lại SĐT bên dưới — Salut sẽ báo ngay khi mở lớp mới.</p>
    </div>
</section>
