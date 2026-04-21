<?php
/**
 * Single course detail.
 */
get_header(); ?>

<article class="single-course">
    <?php while ( have_posts() ) : the_post();
        $icon     = get_post_meta( get_the_ID(), '_salut_icon', true );
        $price    = get_post_meta( get_the_ID(), '_salut_price', true );
        $duration = get_post_meta( get_the_ID(), '_salut_duration', true );
        $sessions = get_post_meta( get_the_ID(), '_salut_sessions', true );
        $goal     = get_post_meta( get_the_ID(), '_salut_goal', true );
    ?>
        <header class="course-hero">
            <div class="container grid-2">
                <div class="course-hero-text">
                    <p class="page-kicker">Khoá học</p>
                    <h1 class="page-title"><?php echo esc_html( $icon ?: '📚' ); ?> <?php the_title(); ?></h1>
                    <?php if ( has_excerpt() ) : ?>
                        <p class="page-lede"><?php echo esc_html( get_the_excerpt() ); ?></p>
                    <?php endif; ?>

                    <ul class="course-stats">
                        <?php if ( $duration ) : ?><li><strong><?php echo esc_html( $duration ); ?></strong><span>Thời lượng</span></li><?php endif; ?>
                        <?php if ( $sessions ) : ?><li><strong><?php echo esc_html( $sessions ); ?></strong><span>Số buổi</span></li><?php endif; ?>
                        <?php if ( $goal ) : ?><li><strong><?php echo esc_html( $goal ); ?></strong><span>Đầu ra</span></li><?php endif; ?>
                        <?php if ( $price ) : ?><li><strong><?php echo esc_html( $price ); ?></strong><span>Học phí</span></li><?php endif; ?>
                    </ul>

                    <div class="hero-ctas">
                        <a href="#dang-ky" class="btn btn-primary btn-lg">Đăng ký ngay</a>
                        <a href="<?php echo esc_url( home_url('/khoa-hoc/') ); ?>" class="btn btn-outline">← Tất cả khoá học</a>
                    </div>
                </div>

                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="course-hero-image"><?php the_post_thumbnail('salut-course'); ?></div>
                <?php endif; ?>
            </div>
        </header>

        <div class="container single-content">
            <?php the_content(); ?>
        </div>
    <?php endwhile; ?>
</article>

<?php get_template_part('template-parts/schedule'); ?>
<?php get_template_part('template-parts/contact-form'); ?>

<?php get_footer();
