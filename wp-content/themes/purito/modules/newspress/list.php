<div id="jt-<?php echo $namespace; ?>-list-wrap" class="jt-<?php echo $namespace; ?>-list-wrap">

	<?php if ( $loop->have_posts() ) : ?>

		<div class="jt-category-nav-wrap jt-motion--rise jt-motion--rise-large">
			<div class="jt-category-nav">
				<?php echo $this->category_menu(); ?>
			</div><!-- .jt-category-nav -->
		</div><!-- .jt-category-nav-wrap -->

		<div class="jt-newspress-count">
			<p class="jt-typo--14"><?php echo $loop->found_posts; ?> <?php echo ( jt_is_lang( 'en' ) ) ? 'Articles' : '개'; ?></p>
		</div><!-- .product-list__count -->

		<ul class="jt-newspress-list jt-motion--stagger">
			<?php
			while ( $loop->have_posts() ) :
				$loop->the_post();

				if ( $this->_support_cat ) {
					$terms = wp_get_post_terms( get_the_ID(), $this->_namespace . '_categories' );
				}

                $newspress_data = get_field( 'newspress' );
                $thumbnail = jt_get_image_src( $newspress_data['thumbnail'], 'jt_thumbnail_443x443' );
				?>
				<li class="jt-newspress-list__item jt-motion--stagger-item">
					<?php if ( $newspress_data['use_outlink'] ) : ?>
					<a class="jt-newspress-list__link" href="<?php echo $newspress_data['outlink']; ?>" target="_blank" rel="noopener">
					<?php else : ?>
					<a class="jt-newspress-list__link" href="<?php echo get_permalink(); ?>">
					<?php endif; ?>
						<figure class="jt-newspress-list__thumb jt-lazyload">
							<span class="jt-lazyload__color-preview"></span>
							<img width="443" height="443" data-unveil="<?php echo $thumbnail; ?>" src="<?php bloginfo( 'template_directory' ); ?>/images/layout/blank.gif" alt="" />
							<noscript><img src="<?php echo $thumbnail; ?>" alt="<?php the_title(); ?>" /></noscript>
						</figure><!-- .jt-newspress-list__thumb -->

						<div class="jt-newspress-list__content">
                            <?php if ( ! empty( $terms ) ) : ?>
							<span class="jt-newspress-list__cat jt-typo--14" lang="en"><?php echo $terms[0]->name; ?><?php if ( $newspress_data['use_outlink'] ) { ?><i class="jt-icon"><?php jt_svg('/images/icon/jt-outlink-secondary.svg'); ?></i><?php } ?></span>
                            <?php endif; ?>
							<h2 class="jt-newspress-list__title jt-typo--13"><span><?php echo strip_tags( get_the_title() ); ?></span></h2>
							<time class="jt-newspress-list__date jt-typo--15" datetime="<?php echo get_the_time( 'Y-m-d' ); ?>" lang="en"><?php echo jt_is_lang( 'en' ) ? get_the_time( 'F d, Y' ) : get_the_time( 'Y.m.d' ); ?></time>
						</div><!-- .jt-newspress-list__content -->
					</a><!-- .jt-newspress-list__link -->
				</li><!-- .jt-newspress-list__item -->
			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>
		</ul><!-- .jt-newspress-list -->

		<?php if ( $loop->max_num_pages > $paged ) : ?>
			<div id="jt-loadmore" class="jt-loadmore">
				<a class="jt-loadmore__btn" href="<?php echo get_pagenum_link( $paged + 1 ); ?>" data-loadmore-list=".jt-newspress-list">
					<span><?php _e( 'Load more', 'jt' ); ?><span class="jt-loadmore__count"><?php echo $loop->found_posts - ( $num * ( $paged ) ); ?></span></span>
					<div class="jt-loadmore__spinner">
						<div class="jt-loadmore__spinner_ball_01"></div>
						<div class="jt-loadmore__spinner_ball_02"></div>
						<div class="jt-loadmore__spinner_ball_03"></div>
					</div>
				</a>
			</div><!-- .jt-loadmore -->
		<?php endif; ?>

	<?php else : ?>
		<div class="jt-list-nothing">
			<p class="jt-typo--10"><?php _e( 'Website is being updated.', 'jt' ); ?></p>
		</div><!-- .jt-list-nothing -->
	<?php endif; ?>

	<?php /* <div class="jt-pagination"><?php echo $this->pagination( $loop ); ?></div> */ ?>
</div><!-- #jt-<?php echo $namespace; ?>-list-wrap -->
