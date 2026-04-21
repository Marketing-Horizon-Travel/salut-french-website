<?php
/**
 * Generic page template.
 */
get_header(); ?>

<article class="single-page">
    <?php while ( have_posts() ) : the_post(); ?>
        <header class="page-header">
            <div class="container">
                <h1 class="page-title"><?php the_title(); ?></h1>
            </div>
        </header>

        <?php if ( has_post_thumbnail() ) : ?>
            <div class="single-thumb container"><?php the_post_thumbnail('salut-hero'); ?></div>
        <?php endif; ?>

        <div class="single-content container">
            <?php the_content(); ?>
        </div>
    <?php endwhile; ?>
</article>

<?php get_footer();
