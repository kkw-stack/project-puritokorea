<?php echo $this->category_menu(); ?>

<?php if ( $loop->have_posts() ) : ?>
    <ul class="jt-accordion jt-motion--rise">
        <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
            <?php
            $faq_data   = get_field('faq');
            $term       = get_field('faq_category');
            $terms      = get_the_terms(get_the_ID(), 'faq_categories');
            ?>
            <li class="jt-accordion__item">
                <div class="jt-accordion__head">
                    <!-- <b class="jt-accordion__cat jt-typo--16"><?php echo implode(', ', array_column($terms, 'name')); ?></b> -->
                    <b class="jt-accordion__cat jt-typo--15"><?php echo $term->name; ?></b>
                    <h2 class="jt-accordion__title jt-typo--13"><?php the_title(); ?></h2>
                    <div class="jt-accordion__control"><span class="sr-only"><?php _e( 'Accordion Toggle', 'jt' ); ?></span></div>
                </div><!-- .jt-accordion__head -->

                <div class="jt-accordion__content">
                    <div class="jt-accordion__content-inner jt-typo--14"><?php echo $faq_data['answer']; ?></div><!-- .jt-accordion__content_inner -->
                </div><!-- .jt-accordion__content -->
            </li><!-- .jt-accordion__item -->
        <?php endwhile; ?>
    </ul><!-- .jt-accordion -->
<?php endif; ?>
