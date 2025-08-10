<?php echo $this->search_form(); ?>

<div class="stores-offline-search__contents">
    <div class="stores-offline-search__total">
        <p class="jt-typo--15" lang="en"><?php _e( 'Total', 'jt' ); ?> <span><?php echo $loop->post_count; ?></span></p>
    </div><!-- .stores-offline-search__total -->

    <?php if ( $loop->have_posts() ) : ?>
        <ul class="stores-offline-search__list">
            <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
                <?php
                $offline_store_data = get_field( 'offline_store' );
                ?>

                <li class="stores-offline-search__item">
                    <a href="#">
                        <b class="jt-typo--13" lang="en"><?php echo strip_tags( get_the_title() ); ?></b>
                        <p class="jt-typo--14" lang="en"><?php echo $offline_store_data['address']; ?></p>
                    </a>
                </li><!-- .stores-offline-search__item -->
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        </ul><!-- .stores-offline-search__list -->
    <?php else: ?>
        <!-- 검색 결과 없을때 -->
        <div class="stores-offline-search__no-list">
            <span class="jt-typo--13">No Results Found for “<?php echo esc_html( $_GET['search'] ); ?>”</span>
        </div>
    <?php endif; ?>
</div><!-- .stores-offline-search__contents -->
