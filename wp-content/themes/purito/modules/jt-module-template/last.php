<?php if ( $loop->have_posts() ) : ?>
	<div class="jt-last-post jt-last-post--<?php echo $type; ?>">
		<div class="jt-newspress-list swiper">
			<div class="swiper-wrapper">
				<?php
				while ( $loop->have_posts() ) :
					$loop->the_post();

					if ( $this->_support_cat ) {
						$terms = wp_get_post_terms( get_the_ID(), $this->_namespace . '_categories' );
					}

					$newspress_data = get_field( 'newspress' );
					$thumbnail = jt_get_image_src( $newspress_data['thumbnail'], 'jt_thumbnail_443x443' );
					?>
					<div class="jt-newspress-list__item swiper-slide">
						<a class="jt-newspress-list__link" href="<?php echo ( $newspress_data['use_outlink'] ) ? $newspress_data['outlink'] : get_permalink(); ?>">
							<figure class="jt-newspress-list__thumb jt-lazyload">
								<span class="jt-lazyload__color-preview"></span>
								<img width="443" height="443" data-unveil="<?php echo $thumbnail; ?>" src="<?php bloginfo( 'template_directory' ); ?>/images/layout/blank.gif" alt="" />
								<noscript><img src="<?php echo $thumbnail; ?>" alt="<?php the_title(); ?>" /></noscript>
							</figure><!-- .jt-newspress-list__thumb -->

							<div class="jt-newspress-list__content">
								<?php if ( ! empty( $terms ) ) :?>
								<span class="jt-newspress-list__cat jt-typo--14" lang="en"><?php echo $terms[0]->name; ?></span>
								<?php endif; ?>
								<h2 class="jt-newspress-list__title jt-typo--13"><span><?php echo strip_tags( get_the_title() ); ?></span></h2>
								<time class="jt-newspress-list__date jt-typo--15" datetime="<?php echo get_the_time( 'Y-m-d' ); ?>" lang="en"><?php echo jt_is_lang( 'en' ) ? get_the_time( 'F d, Y' ) : get_the_time( 'Y.m.d' ); ?></time>
							</div><!-- .jt-newspress-list__content -->
						</a><!-- .jt-newspress-list__link -->
					</div><!-- .jt-newspress-list__item -->
					<?php
					endwhile;
					wp_reset_postdata();
				?>
			</div><!-- .swiper-wrapper -->
			
			<div class="swiper-pagination"></div>
		</div><!-- .jt-newspress-list -->
	</div><!-- .jt-last-post -->
<?php else : ?>
	<div class="jt-list-nothing">
		<b class="jt-typo--04"><?php _e( '컨텐츠 준비중 입니다.', 'jt' ); ?></b>
		<p class="jt-typo--10"><?php _e( '현재 컨텐츠를 준비하고 있으니 조금만 기다려 주세요. <br />더욱 나은 모습으로 찾아뵙겠습니다.', 'jt' ); ?></p>
	</div><!-- .jt-list-nothing -->
<?php endif; ?>
