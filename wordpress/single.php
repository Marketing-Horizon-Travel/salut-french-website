<?php
/**
 * Single blog post.
 */
get_header(); ?>

<article class="single-post">
    <?php while ( have_posts() ) : the_post(); ?>
        <header class="single-header">
            <div class="container">
                <div class="post-meta">
                    <?php $cats = get_the_category(); if ( $cats ) : ?>
                        <span><?php echo esc_html( $cats[0]->name ); ?></span> ·
                    <?php endif; ?>
                    <span><?php echo get_the_date(); ?></span>
                </div>
                <h1 class="single-title"><?php the_title(); ?></h1>
                <?php if ( has_excerpt() ) : ?>
                    <p class="single-lede"><?php echo esc_html( get_the_excerpt() ); ?></p>
                <?php endif; ?>
            </div>
        </header>

        <?php if ( has_post_thumbnail() ) : ?>
            <div class="single-thumb container"><?php the_post_thumbnail('salut-hero'); ?></div>
        <?php endif; ?>

        <div class="single-content container">
            <?php the_content(); ?>
            <?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Trang:', 'salut' ), 'after' => '</div>' ) ); ?>
        </div>
    <?php endwhile; ?>
</article>

<?php get_template_part('template-parts/contact-form'); ?>

<?php get_footer();
