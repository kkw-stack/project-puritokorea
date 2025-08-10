<ul>
    <li class="<?php echo ( empty( $cate ) ? 'jt-category--active' : '' ); ?>">
        <a class="jt-typo--10" href="<?php echo $current_url; ?>" lang="en"><span><?php _e( 'All Articles', 'jt' ); ?></span></a>
    </li>

    <?php foreach ( $terms as $term ) : ?>
        <li class="<?php echo ( urldecode( $cate ) == urldecode( $term->slug ) ? 'jt-category--active' : '' ); ?>">
            <a class="jt-typo--10" href="<?php echo add_query_arg( 'cate', $term->slug, $current_url ); ?>" lang="en">
                <span><?php echo $term->name; ?></span>
            </a>
        </li>
    <?php endforeach; ?>
</ul>