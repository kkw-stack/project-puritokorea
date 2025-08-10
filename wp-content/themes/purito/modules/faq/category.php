<div class="jt-category-nav-wrap jt-motion--rise">
    <div class="jt-category-nav">
        <ul>
            <li class="<?php echo ( empty( $cate ) ? 'jt-category--active' : '' ); ?>">
                <a class="jt-typo--14" href="<?php echo $current_url; ?>"><span><?php _e( 'All', 'jt' ); ?></span></a>
            </li>

            <?php foreach ( $terms as $term ) : ?>
                <li class="<?php echo ( urldecode( $cate ) == urldecode( $term->slug ) ? 'jt-category--active' : '' ); ?>">
                    <a class="jt-typo--14" href="<?php echo add_query_arg( 'cate', $term->slug, $current_url ); ?>">
                        <span><?php echo $term->name; ?></span>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>


