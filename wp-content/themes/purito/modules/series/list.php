<?php if ( $loop->have_posts() ) : ?>
	<ul class="jt-accordion createme-past__series-accordion jt-motion--rise">
		<?php
		while ( $loop->have_posts() ) :
			$loop->the_post();

			$series_data = get_field( 'series' );
			?>
			<li class="jt-accordion__item <?php echo ( $series_data['comingsoon'] ) ? 'jt-accordion--comingsoon' : ''; ?>">
				<div class="jt-accordion__head">
					<b class="jt-accordion__count jt-typo--08" lang="en">Series <?php echo $count; ?></b>
					<h2 class="jt-accordion__title jt-typo--11"><?php the_title(); ?></h2>
					<div class="jt-accordion__control">
						<?php if ( $series_data['comingsoon'] ) : ?>
							<span class="jt-typo--08" lang="en">Coming<br class="smbr" /> Soon !</span>
						<?php else : ?>
							<span class="sr-only"><?php _e( 'Accordion Toggle', 'jt' ); ?></span>
						<?php endif; ?>
					</div>
				</div><!-- .jt-accordion__head -->

				<div class="jt-accordion__content">
					<div class="jt-accordion__content-inner">
						<p class="jt-typo--14"><?php echo do_shortcode( $series_data['content'] ); ?></p>

						<?php if ( ! empty( $series_data['link'] ) ) : ?>
							<a class="createme-past__series-btn jt-btn__basic jt-btn--type-01 jt-btn--simple" href="<?php echo $series_data['link']; ?>" lang="en" target='_blank'>
								<span><?php _e( 'Shop Now', 'jt' ); ?></span>
								<div class="jt-btn__simple-circle">
									<i class="jt-icon jt-btn__simple--default"><?php jt_icon( 'jt-chevron-right-mini-2px-square' ); ?></i>
								</div>
							</a>
						<?php endif; ?>
						
						<?php if( ! empty( $series_data['image'] ) ) : ?>
						<?php
						$createme_image_data = wp_get_attachment_metadata( $series_data['image'] );	
						?>
						<div class="jt-accordion__img">
							<figure>
								<img width="<?php echo $createme_image_data['width']; ?>" height="<?php echo $createme_image_data['height']; ?>" src="<?php echo jt_get_image_src( $series_data['image'], 'jt_thumbnail_780' ); ?>" alt="" />
							</figure>
						</div><!-- .jt-accordion__img -->
						<?php endif; ?>
					</div><!-- .jt-accordion__content_inner -->
				</div><!-- .jt-accordion__content -->
			</li><!-- .jt-accordion__item -->

			<?php --$count; ?>
		<?php endwhile; ?>
	</ul><!-- .jt-accordion -->

	<?php if ( $loop->max_num_pages > $paged ) : ?>
		<div id="jt-loadmore" class="jt-loadmore">
			<a class="jt-loadmore__btn" href="<?php echo get_pagenum_link( $paged + 1 ); ?>" data-loadmore-list=".jt-accordion">
				<span><?php _e( 'More Products', 'jt' ); ?><span class="jt-loadmore__count"><?php echo $loop->found_posts - ( $num * ( $paged ) ); ?></span></span>
				<div class="jt-loadmore__spinner">
					<div class="jt-loadmore__spinner_ball_01"></div>
					<div class="jt-loadmore__spinner_ball_02"></div>
					<div class="jt-loadmore__spinner_ball_03"></div>
				</div>
			</a>
		</div><!-- .jt-loadmore -->
	<?php endif; ?>
<?php endif; ?>
