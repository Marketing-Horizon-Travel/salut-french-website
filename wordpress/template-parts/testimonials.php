<?php
/**
 * Testimonials section — student feedback carousel.
 */

$testimonials = get_posts( array(
    'post_type'      => 'testimonial',
    'posts_per_page' => 6,
) );

$fallback = array(
    array(
        'name' => 'Minh Châu',
        'role' => 'Du học sinh Canada',
        'score' => 'TCF Canada 450 điểm',
        'quote' => 'Trước khi đến Salut, mình học tiếng Pháp 6 tháng mà vẫn không dám mở miệng. Sau 3 tháng ở đây, mình thi TCF được 450 và đã sang Montréal du học. Thầy cô rất tâm huyết, cảm giác như học cùng anh chị trong nhà vậy.',
    ),
    array(
        'name' => 'Hoàng Long',
        'role' => 'Kỹ sư định cư Québec',
        'score' => 'DELF B2',
        'quote' => 'Lớp ít người, giáo trình bài bản, bài tập luôn được chữa kỹ. Cô Hà Anh cực kỳ tận tâm — nhắn tin hỏi bài 11h đêm vẫn được rep. Recommend 10/10!',
    ),
    array(
        'name' => 'Ngọc Anh',
        'role' => 'Sinh viên năm 2',
        'score' => 'DELF B1',
        'quote' => 'Học ở Salut giống như đi café với bạn hơn là đi học. Mỗi buổi đều vui, có game, có bài hát Pháp. Không ngờ mình yêu tiếng Pháp đến mức này!',
    ),
    array(
        'name' => 'Trần Phong',
        'role' => 'Nhân viên văn phòng',
        'score' => 'Giao tiếp A2+',
        'quote' => 'Mình bận đi làm nên chỉ học buổi tối, các thầy cô vẫn rất nhiệt tình. Sau 4 tháng đã có thể nói chuyện cơ bản với khách hàng người Pháp của công ty.',
    ),
);
?>
<section class="testimonials-section">
    <div class="container">
        <div class="section-head">
            <p class="section-kicker">Học viên nói gì?</p>
            <h2 class="section-title"><span class="handwritten">Câu chuyện</span> từ học viên Salut</h2>
        </div>

        <div class="testimonial-grid">
            <?php if ( ! empty( $testimonials ) ) : ?>
                <?php foreach ( $testimonials as $t ) :
                    $role  = get_post_meta( $t->ID, '_salut_role', true );
                    $score = get_post_meta( $t->ID, '_salut_score', true );
                ?>
                    <figure class="testimonial-card">
                        <blockquote><?php echo wp_kses_post( get_the_content( null, false, $t ) ); ?></blockquote>
                        <figcaption>
                            <div class="tc-avatar">
                                <?php if ( has_post_thumbnail( $t ) ) echo get_the_post_thumbnail( $t, 'thumbnail' );
                                else echo '<span class="avatar-initial">' . esc_html( mb_substr( get_the_title( $t ), 0, 1 ) ) . '</span>'; ?>
                            </div>
                            <div>
                                <strong><?php echo esc_html( get_the_title( $t ) ); ?></strong>
                                <span><?php echo esc_html( $role ); ?></span>
                                <?php if ( $score ) : ?><span class="tc-score">🏆 <?php echo esc_html( $score ); ?></span><?php endif; ?>
                            </div>
                        </figcaption>
                    </figure>
                <?php endforeach; ?>
            <?php else : ?>
                <?php foreach ( $fallback as $i => $t ) : ?>
                    <figure class="testimonial-card">
                        <blockquote>« <?php echo esc_html( $t['quote'] ); ?> »</blockquote>
                        <figcaption>
                            <div class="tc-avatar"><span class="avatar-initial"><?php echo esc_html( mb_substr( $t['name'], 0, 1 ) ); ?></span></div>
                            <div>
                                <strong><?php echo esc_html( $t['name'] ); ?></strong>
                                <span><?php echo esc_html( $t['role'] ); ?></span>
                                <span class="tc-score">🏆 <?php echo esc_html( $t['score'] ); ?></span>
                            </div>
                        </figcaption>
                    </figure>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>
