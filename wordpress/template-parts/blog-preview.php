<?php
/**
 * Latest blog posts preview.
 */

$posts = get_posts( array(
    'posts_per_page' => 3,
    'post_status'    => 'publish',
) );

$fallback = array(
    array(
        'title'   => '10 câu chào cơ bản tiếng Pháp ngoài "Bonjour"',
        'excerpt' => 'Không phải lúc nào bạn cũng dùng "Bonjour". Đây là 10 cách chào khác tuỳ ngữ cảnh giúp bạn nói tiếng Pháp tự nhiên hơn…',
        'cat'     => 'Giao tiếp',
        'date'    => '15/04/2026',
    ),
    array(
        'title'   => 'Bí quyết đạt TCF Canada 450+ trong 3 tháng',
        'excerpt' => 'Lộ trình chi tiết từ A2 lên B2, các tài liệu cần có, mẹo làm từng phần thi. Chia sẻ từ học viên đạt 475/699 của Salut…',
        'cat'     => 'Luyện thi',
        'date'    => '10/04/2026',
    ),
    array(
        'title'   => 'Văn hoá bàn ăn Pháp: Những điều đừng dại mà làm',
        'excerpt' => 'Ăn tối tại Paris không giống ăn tối tại Sài Gòn. Đây là 8 "điều cấm kỵ" tại bàn ăn mà người Pháp cực khó chịu…',
        'cat'     => 'Văn hoá',
        'date'    => '05/04/2026',
    ),
);
?>
<section class="blog-preview-section">
    <div class="container">
        <div class="section-head">
            <p class="section-kicker">Blog Salut</p>
            <h2 class="section-title"><span class="handwritten">Cẩm nang</span> học tiếng Pháp</h2>
            <p class="section-lede">Tips học, mẹo luyện thi, văn hoá Pháp — chia sẻ từ đội ngũ Salut.</p>
        </div>

        <div class="post-grid">
            <?php if ( ! empty( $posts ) ) : ?>
                <?php foreach ( $posts as $p ) : ?>
                    <article class="post-card">
                        <?php if ( has_post_thumbnail( $p ) ) : ?>
                            <a href="<?php echo esc_url( get_permalink( $p ) ); ?>" class="post-thumb"><?php echo get_the_post_thumbnail( $p, 'salut-card' ); ?></a>
                        <?php else : ?>
                            <a href="<?php echo esc_url( get_permalink( $p ) ); ?>" class="post-thumb post-thumb-placeholder">
                                <span>🥐</span>
                            </a>
                        <?php endif; ?>
                        <div class="post-body">
                            <div class="post-meta">
                                <span><?php echo esc_html( get_the_date( '', $p ) ); ?></span>
                            </div>
                            <h3 class="post-title"><a href="<?php echo esc_url( get_permalink( $p ) ); ?>"><?php echo esc_html( get_the_title( $p ) ); ?></a></h3>
                            <p class="post-excerpt"><?php echo esc_html( get_the_excerpt( $p ) ); ?></p>
                            <a href="<?php echo esc_url( get_permalink( $p ) ); ?>" class="link-more">Đọc tiếp →</a>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php else : ?>
                <?php foreach ( $fallback as $p ) : ?>
                    <article class="post-card">
                        <a href="<?php echo esc_url( home_url('/blog/') ); ?>" class="post-thumb post-thumb-placeholder">
                            <span>🥐</span>
                        </a>
                        <div class="post-body">
                            <div class="post-meta">
                                <span><?php echo esc_html( $p['date'] ); ?></span>
                                <span>· <?php echo esc_html( $p['cat'] ); ?></span>
                            </div>
                            <h3 class="post-title"><a href="<?php echo esc_url( home_url('/blog/') ); ?>"><?php echo esc_html( $p['title'] ); ?></a></h3>
                            <p class="post-excerpt"><?php echo esc_html( $p['excerpt'] ); ?></p>
                            <a href="<?php echo esc_url( home_url('/blog/') ); ?>" class="link-more">Đọc tiếp →</a>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <div class="section-footer">
            <a href="<?php echo esc_url( home_url('/blog/') ); ?>" class="btn btn-outline">Xem tất cả bài viết</a>
        </div>
    </div>
</section>
