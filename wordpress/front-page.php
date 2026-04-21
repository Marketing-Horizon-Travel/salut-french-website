<?php
/**
 * Front page template — homepage with hero, courses, schedule, testimonials.
 */
get_header(); ?>

<?php get_template_part('template-parts/hero'); ?>

<?php get_template_part('template-parts/about'); ?>

<?php get_template_part('template-parts/courses'); ?>

<?php get_template_part('template-parts/schedule'); ?>

<?php get_template_part('template-parts/why'); ?>

<?php get_template_part('template-parts/testimonials'); ?>

<?php get_template_part('template-parts/blog-preview'); ?>

<?php get_template_part('template-parts/contact-form'); ?>

<?php get_footer();
