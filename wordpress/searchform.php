<?php
/**
 * Search form.
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url('/') ); ?>">
    <label class="screen-reader-text" for="s"><?php _e( 'Tìm kiếm:', 'salut' ); ?></label>
    <input type="search" id="s" name="s" placeholder="Tìm bài viết, khoá học..." value="<?php echo esc_attr( get_search_query() ); ?>">
    <button type="submit" class="btn btn-primary">Tìm</button>
</form>
