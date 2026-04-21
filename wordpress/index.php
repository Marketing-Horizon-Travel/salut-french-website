<?php
/**
 * Blog index / fallback template.
 */
get_header(); ?>

<section class="page-header">
    <div class="container">
        <p class="page-kicker">Blog Salut</p>
        <h1 class="page-title handwritten">Cẩm nang tiếng Pháp</h1>
        <p class="page-lede">Tips học, mẹo luyện thi, văn hoá Pháp và chuyện du học — cập nhật hàng tuần.</p>
    </div>
</section>

<section class="blog-archive">
    <div class="container grid-2">
        <div class="blog-main">
            <?php if ( have_posts() ) : ?>
                <div class="post-grid">
                    <?php while ( have_posts() ) : the_post(); ?>
                        <article <?php post_class('post-card'); ?>>
                            <?php if ( has_post_thumbnail() ) : ?>
                                <a href="<?php the_permalink(); ?>" class="post-thumb">
                                    <?php the_post_thumbnail('salut-card'); ?>
                                </a>
                            <?php endif; ?>
                            <div class="post-body">
                                <div class="post-meta">
                                    <span><?php echo get_the_date(); ?></span>
                                    <?php $cats = get_the_category(); if ( $cats ) : ?>
                                        <span>· <?php echo esc_html( $cats[0]->name ); ?></span>
                                    <?php endif; ?>
                                </div>
                                <h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                <p class="post-excerpt"><?php echo esc_html( get_the_excerpt() ); ?></p>
                                <a href="<?php the_permalink(); ?>" class="link-more">Đọc tiếp →</a>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>
                <div class="pagination">
                    <?php the_posts_pagination( array( 'prev_text' => '←', 'next_text' => '→' ) ); ?>
                </div>
            <?php else : ?>
                <p>Chưa có bài viết nào. Quay lại sau nhé!</p>
            <?php endif; ?>
        </div>

        <aside class="blog-sidebar">
            <?php if ( is_active_sidebar( 'sidebar-blog' ) ) dynamic_sidebar( 'sidebar-blog' ); ?>

            <div class="widget widget-signup">
                <h3 class="widget-title">Muốn học cùng Salut?</h3>
                <p>Để lại SĐT, nhận tư vấn lộ trình miễn phí.</p>
                <a href="#dang-ky" class="btn btn-primary btn-block">Đăng ký tư vấn</a>
            </div>
        </aside>
    </div>
</section>

<?php get_template_part('template-parts/contact-form'); ?>

<?php get_footer();
