<?php
/**
 * Courses section — grid of course cards.
 */

$courses = get_posts( array(
    'post_type'      => 'course',
    'posts_per_page' => 8,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
) );

$fallback = array(
    array( 'icon' => '🎯', 'title' => 'TCF Canada · TEF', 'excerpt' => 'Luyện thi định cư Canada — 4 kỹ năng Nghe/Đọc/Nói/Viết với đề thi cập nhật mới nhất.', 'price' => '4.500.000đ', 'duration' => '3 tháng' ),
    array( 'icon' => '📜', 'title' => 'DELF A2 · B1 · B2', 'excerpt' => 'Chứng chỉ chính thức của Bộ Giáo dục Pháp — giá trị vĩnh viễn, phù hợp du học và xin visa.', 'price' => '3.800.000đ', 'duration' => '3 tháng' ),
    array( 'icon' => '🌏', 'title' => 'TCF TP · TCF IRN', 'excerpt' => 'Luyện thi định cư Quebec và nhập tịch Pháp — chuyên sâu về ngữ pháp và kỹ năng nói.', 'price' => '4.200.000đ', 'duration' => '2.5 tháng' ),
    array( 'icon' => '📖', 'title' => 'Ngữ pháp nền tảng', 'excerpt' => 'Chắc gốc ngữ pháp từ A1 đến B1 — không còn sợ chia động từ, subjonctif, hay thì quá khứ.', 'price' => '2.900.000đ', 'duration' => '2 tháng' ),
    array( 'icon' => '🥐', 'title' => 'Tiếng Pháp từ số 0', 'excerpt' => 'Lớp dành cho người mới bắt đầu — bảng chữ cái, phát âm, câu giao tiếp cơ bản.', 'price' => '2.500.000đ', 'duration' => '2 tháng' ),
    array( 'icon' => '💬', 'title' => 'Giao tiếp phản xạ', 'excerpt' => 'Nói tiếng Pháp tự tin — tình huống thực tế, học cùng giảng viên bản ngữ 2 buổi/tuần.', 'price' => '3.200.000đ', 'duration' => '3 tháng' ),
);
?>
<section class="courses-section" id="khoa-hoc">
    <div class="container">
        <div class="section-head">
            <p class="section-kicker">Các khoá học</p>
            <h2 class="section-title"><span class="handwritten">Chọn khoá</span> phù hợp với bạn</h2>
            <p class="section-lede">Mỗi khoá học tại Salut được thiết kế riêng theo mục tiêu: luyện thi chứng chỉ, du học, định cư, hay đơn giản là vì yêu tiếng Pháp.</p>
        </div>

        <div class="course-grid">
            <?php if ( ! empty( $courses ) ) : ?>
                <?php foreach ( $courses as $c ) :
                    $icon     = get_post_meta( $c->ID, '_salut_icon', true );
                    $price    = get_post_meta( $c->ID, '_salut_price', true );
                    $duration = get_post_meta( $c->ID, '_salut_duration', true );
                    $goal     = get_post_meta( $c->ID, '_salut_goal', true );
                ?>
                    <article class="course-card">
                        <div class="course-icon"><?php echo esc_html( $icon ?: '📚' ); ?></div>
                        <h3 class="course-title"><a href="<?php echo esc_url( get_permalink( $c ) ); ?>"><?php echo esc_html( get_the_title( $c ) ); ?></a></h3>
                        <p class="course-excerpt"><?php echo esc_html( get_the_excerpt( $c ) ); ?></p>
                        <ul class="course-meta">
                            <?php if ( $duration ) : ?><li>⏱ <?php echo esc_html( $duration ); ?></li><?php endif; ?>
                            <?php if ( $goal ) : ?><li>🎯 <?php echo esc_html( $goal ); ?></li><?php endif; ?>
                        </ul>
                        <div class="course-footer">
                            <?php if ( $price ) : ?><span class="course-price"><?php echo esc_html( $price ); ?></span><?php endif; ?>
                            <a href="<?php echo esc_url( get_permalink( $c ) ); ?>" class="link-more">Chi tiết →</a>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php else : ?>
                <?php foreach ( $fallback as $c ) : ?>
                    <article class="course-card">
                        <div class="course-icon"><?php echo esc_html( $c['icon'] ); ?></div>
                        <h3 class="course-title"><a href="#dang-ky"><?php echo esc_html( $c['title'] ); ?></a></h3>
                        <p class="course-excerpt"><?php echo esc_html( $c['excerpt'] ); ?></p>
                        <ul class="course-meta">
                            <li>⏱ <?php echo esc_html( $c['duration'] ); ?></li>
                            <li>🎯 Đạt mục tiêu đầu ra</li>
                        </ul>
                        <div class="course-footer">
                            <span class="course-price"><?php echo esc_html( $c['price'] ); ?></span>
                            <a href="#dang-ky" class="link-more">Đăng ký →</a>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <div class="section-footer">
            <a href="<?php echo esc_url( home_url('/khoa-hoc/') ); ?>" class="btn btn-outline">Xem tất cả khoá học</a>
        </div>
    </div>
</section>
