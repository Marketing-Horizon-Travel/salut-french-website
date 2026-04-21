<?php
/**
 * Course archive (listing of all courses).
 */
get_header(); ?>

<section class="page-header">
    <div class="container">
        <p class="page-kicker">Các khoá học</p>
        <h1 class="page-title"><span class="handwritten">Chọn khoá</span> phù hợp với bạn</h1>
        <p class="page-lede">Từ A1 đến C1 — Salut có khoá phù hợp cho mọi mục tiêu, mọi trình độ.</p>
    </div>
</section>

<section class="courses-section">
    <div class="container">
        <?php if ( have_posts() ) : ?>
            <div class="course-grid">
                <?php while ( have_posts() ) : the_post();
                    $icon     = get_post_meta( get_the_ID(), '_salut_icon', true );
                    $price    = get_post_meta( get_the_ID(), '_salut_price', true );
                    $duration = get_post_meta( get_the_ID(), '_salut_duration', true );
                    $goal     = get_post_meta( get_the_ID(), '_salut_goal', true );
                ?>
                    <article class="course-card">
                        <div class="course-icon"><?php echo esc_html( $icon ?: '📚' ); ?></div>
                        <h2 class="course-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <p class="course-excerpt"><?php echo esc_html( get_the_excerpt() ); ?></p>
                        <ul class="course-meta">
                            <?php if ( $duration ) : ?><li>⏱ <?php echo esc_html( $duration ); ?></li><?php endif; ?>
                            <?php if ( $goal ) : ?><li>🎯 <?php echo esc_html( $goal ); ?></li><?php endif; ?>
                        </ul>
                        <div class="course-footer">
                            <?php if ( $price ) : ?><span class="course-price"><?php echo esc_html( $price ); ?></span><?php endif; ?>
                            <a href="<?php the_permalink(); ?>" class="link-more">Chi tiết →</a>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>

            <div class="pagination">
                <?php the_posts_pagination( array( 'prev_text' => '←', 'next_text' => '→' ) ); ?>
            </div>
        <?php else : ?>
            <p>Chưa có khoá học nào. Vui lòng quay lại sau.</p>
        <?php endif; ?>
    </div>
</section>

<?php get_template_part('template-parts/contact-form'); ?>

<?php get_footer();
