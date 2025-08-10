<?php get_header(); ?>

<?php if ( have_posts() ) : ?>
	<?php
	while ( have_posts() ) :
		the_post();

		$product_data = get_field( 'product_data' );
		$basic        = $product_data['basic'] ?? array();
		$new_detail   = $product_data['new_detail'] ?? array();

		$option_idx = (int) ( $_GET['option_idx'] ?? 0 );
		$color_idx  = (int) ( $_GET['color_idx'] ?? 0 );

		if ( empty( $basic['options'][ $option_idx ] ) ) {
			$option_idx = 0;

			if ( empty( $basic['options'][ $option_idx ]['color']['data'][ $color_idx ] ) ) {
				$color_idx = 0;
			}
		}

		$options = array_column( $basic['options'], 'name' );
		$price   = $basic['options'][ $option_idx ]['price'];
		$gallery = $basic['options'][ $option_idx ]['gallery'];
		$link    = $basic['options'][ $option_idx ]['link'];

		if ( $basic['options'][ $option_idx ]['color']['use'] ) {
			$gallery = $basic['options'][ $option_idx ]['color']['data'][ $color_idx ]['gallery'];
			$link    = $basic['options'][ $option_idx ]['color']['data'][ $color_idx ]['link'];
		}

		$json_data = array_map(
			function ( $item ) {
				$item['gallery'] = array_map(
					function ( $id ) {
						return jt_get_image_src( $id, 'jt_thumbnail_1804x1804' );
					},
					$item['gallery']
				);

				if ( $item['color']['use'] ) {
					$item['color']['data'] = array_map(
						function ( $data ) {
							$data['gallery'] = array_map(
								function ( $id ) {
									return jt_get_image_src( $id, 'jt_thumbnail_1804x1804' );
								},
								$data['gallery']
							);

							return $data;
						},
						$item['color']['data']
					);
				}

				return $item;
			},
			$basic['options']
		);

		$option     = get_field( 'common_settings_product', 'option' );
		$background = $option['background'];

		$video_option = array(
			'quality'	 => '1080p',
			'muted'		 => 1,
			'autoplay'	 => 1,
			'autopause'	 => 0,
			'loop'		 => 1,
			'background' => 1,
		);

		$language = get_bloginfo('language');
		?>
		
		<script>var product_option_data = <?php echo json_encode( $json_data, JSON_PRETTY_PRINT ); ?>;</script>

		<div class="product-single">
			<div class="wrap">
				<div class="product-single__detail">
					<div class="product-single__picture">
						<div class="product-single__picture-inner">
							<div class="product-single__slider swiper">
								<div class="swiper-wrapper">
									<?php foreach ( $gallery as $item ) : ?>
										<div class="product-single__slider-item swiper-slide">
											<div class="product-single__slider-image swiper-lazy" data-background="<?php echo jt_get_image_src( $item, 'jt_thumbnail_1804x1804' ); ?>"></div>
										</div><!-- .product-single__slider-item -->
									<?php endforeach; ?>
								</div><!-- .swiper-wrapper -->

								<div class="product-single__slider-control">
									<div class="product-single__slider-pagination"></div>
								</div><!-- .product-single__slider-control -->
							</div><!-- .product-single__slider -->
						</div><!-- .product-single__picture-inner -->
					</div><!-- .product-single__picture -->

					<div class="product-single__information">
						<div class="product-single__dafault">
							<?php if ( ! empty( $basic['category']['label'] ) ) : ?>
								<div class="product-single__label">
									<?php foreach ( $basic['category']['label'] as $idx => $item ) : ?>
										<?php
										$label_data = get_field( 'product_label_data', 'term_' . $item->term_id );
										?>
										<span
											class="jt-typo--14 product-single__label--<?php echo $item->slug; ?>" lang="en"
											style="color: <?php echo $label_data['color']; ?>;background: <?php echo $label_data['background']; ?>;"
										>
											<?php echo $item->name; ?>
										</span>
									<?php endforeach; ?>
								</div><!-- .product-single__label -->
							<?php endif; ?>

							<div class="product-single__basic">
								<span class="jt-typo--14"><?php echo $basic['sub_title']; ?></span>
								<h1 class="jt-typo--05"><?php echo $basic['title']; ?></h1>

								<div class="product-single__price">
									<p class="jt-typo--14" lang="en"><?php echo $price; ?></p>
									
									<?php if ( 1 === count( $basic['options'] ) ) : ?>
										<span class="product-single__option jt-typo--15">
											<?php echo $basic['options'][0]['name']; ?>
										</span>
									<?php else : ?>
										<div class="jt-choices__wrap">
											<select class="jt-choices">
												<?php foreach ( $basic['options'] as $idx => $item ) : ?>
													<option value="<?php echo $idx; ?>" <?php selected( $idx, $option_idx ); ?>><?php echo $item['name']; ?></option>
												<?php endforeach; ?>
											</select><!-- .jt-choices -->
										</div><!-- .jt-choices__wrap -->
									<?php endif; ?>
								</div><!-- .product-single__price -->
							</div><!-- .product-single__basic -->

							<ul class="product-single__effect">
								<?php foreach ( $basic['spec'] as $item ) : ?>
									<li class="jt-typo--14"><?php echo $item['item']; ?></li>
								<?php endforeach; ?>
							</ul><!-- .product-single__effect -->
							
							<?php if ( $basic['options'][ $option_idx ]['color']['use'] ) : ?>
								<div class="product-single__chip">
									<ul class="product-single__chip-list">
										<?php foreach ( $basic['options'][ $option_idx ]['color']['data'] as $idx => $item ) : ?>
											<li class="<?php echo ( $color_idx == $idx ? 'product-single__chip--current' : '' ); ?>" data-idx=<?php echo $idx; ?>>
												<i style="background-color: <?php echo $item['code']; ?>;"></i>
												<span class="sr-only"><?php echo $item['title']; ?></span>
											</li>
										<?php endforeach; ?>
									</ul><!-- .product-single__chip-list -->

									<p class="product-single__chip-select jt-typo--15" lang="en">
										<?php _e( 'Select Color :', 'jt' ); ?>
										<span><?php echo $basic['options'][ $option_idx ]['color']['data'][ $color_idx ]['title']; ?></span>
									</p><!-- .product-single__chip-select -->
								</div><!-- .product-single__chip -->
							<?php endif; ?>

							<div class="product-single__buy">
								<a class="product-single__buy-btn" href="#">
									<span class="jt-typo--14" lang="en"><?php _e( 'Shop Now', 'jt' ); ?></span>
									<i class="jt-icon"><?php jt_icon( 'jt-arrow-up-right-secondary' ); ?></i>
								</a><!-- .product-single__buy -->
							</div><!-- .product-single__buy -->
						</div><!-- .product-single__dafault -->

						<div class="product-single__extend">
							<ul class="jt-accordion jt-accordion--secondary" data-open="false">
								<li class="jt-accordion__item">
									<div class="jt-accordion__head">
										<h2 class="jt-accordion__title jt-typo--07" lang="en"><?php _e( 'Ingredients', 'jt' ); ?></h2>
										<div class="jt-accordion__control"><span class="sr-only"><?php _e( 'Toggle accordion', 'jt' ); ?></span><i class="jt-icon"><?php jt_icon( 'jt-chevron-bottom-smaller-2px-square' ); ?></i></div>
									</div><!-- .jt-accordion__head -->

									<div class="jt-accordion__content">
										<div class="jt-accordion__content-inner">
											<ul class="product-single__extend-list">
												<?php foreach ( $basic['ingredients'] as $item ) : ?>
													<li class="product-single__extend-item--ingredient">
														<h3 class="jt-typo--14"><?php echo $item['title']; ?></h3>
														<p class="jt-typo--15"><?php echo $item['content']; ?></p>
													</li>
												<?php endforeach; ?>
											</ul><!-- .product-single__extend-list -->
										</div><!-- .jt-accordion__content_inner -->
									</div><!-- .jt-accordion__content -->
								</li><!-- .jt-accordion__item -->
								
								<?php if ( ! empty( $basic['howto'] ) ) : ?>
									<li class="jt-accordion__item">
										<div class="jt-accordion__head">
											<h2 class="jt-accordion__title jt-typo--07" lang="en"><?php _e( 'How To Use', 'jt' ); ?></h2>
											<div class="jt-accordion__control"><span class="sr-only"><?php _e( 'Toggle accordion', 'jt' ); ?></span><i class="jt-icon"><?php jt_icon( 'jt-chevron-bottom-smaller-2px-square' ); ?></i></div>
										</div><!-- .jt-accordion__head -->

										<div class="jt-accordion__content">
											<div class="jt-accordion__content-inner">
												<ul class="product-single__extend-list">
													<?php foreach ( $basic['howto'] as $item ) : ?>
														<li>
															<h3 class="jt-typo--14"><?php echo $item['title']; ?></h3>
															<p class="jt-typo--15"><?php echo $item['content']; ?></p>
														</li>
													<?php endforeach; ?>
												</ul><!-- .product-single__extend-list -->
											</div><!-- .jt-accordion__content_inner -->
										</div><!-- .jt-accordion__content -->
									</li><!-- .jt-accordion__item -->
								<?php endif; ?>
								
								<?php if ( ! empty( $basic['faq'] ) ) : ?>
									<li class="jt-accordion__item">
										<div class="jt-accordion__head">
											<h2 class="jt-accordion__title jt-typo--07" lang="en"><?php _e( 'FAQ', 'jt' ); ?></h2>
											<div class="jt-accordion__control"><span class="sr-only"><?php _e( 'Toggle accordion', 'jt' ); ?></span><i class="jt-icon"><?php jt_icon( 'jt-chevron-bottom-smaller-2px-square' ); ?></i></div>
										</div><!-- .jt-accordion__head -->

										<div class="jt-accordion__content">
											<div class="jt-accordion__content-inner">
												<ul class="product-single__extend-list">
													<?php foreach ( $basic['faq'] as $item ) : ?>
														<li>
															<h3 class="jt-typo--14"><?php echo $item['title']; ?></h3>
															<p class="jt-typo--15"><?php echo $item['content']; ?></p>
														</li>
													<?php endforeach; ?>
												</ul><!-- .product-single__extend-list -->
											</div><!-- .jt-accordion__content_inner -->
										</div><!-- .jt-accordion__content -->
									</li><!-- .jt-accordion__item -->
								<?php endif; ?>
							</ul><!-- .jt-accordion -->

							<ul class="product-single__extend-icons">
								<?php foreach ( $basic['icon'] as $item ) : ?>
									<?php
									$icon_data = get_field( 'product_icon_data', 'term_' . $item->term_id );
									?>
									<li>
										<div class="product-single__extend-icons-image">
											<figure class="jt-lazyload">
												<img width="120" height="120" src="<?php echo jt_get_image_src( $icon_data['icon'], 'jt_thumbnail_120x120' ); ?>" alt="">
												<noscript><img src="<?php echo jt_get_image_src( $icon_data['icon'], 'jt_thumbnail_120x120' ); ?>" alt="" /></noscript>
											</figure><!-- .jt-lazyload -->
										</div><!-- .product-single__extend-icons-image -->

										<p class="jt-typo--15" lang="en"><?php echo $item->name; ?></p>
									</li>
								<?php endforeach; ?>
							</ul><!-- .product-single__extend-icons -->
						</div><!-- .product-single__extend -->
					</div><!-- .product-single__information -->
				</div><!-- .product-single__detail -->
			</div><!-- .wrap -->

			<div class="wrap">
				<?php  if ( ! empty( $new_detail ) ) : ?>
					<div class="product-single__component">
						<?php foreach ( $new_detail as $data ) : ?>
							<?php
							$acf_fc_layout = $data['acf_fc_layout'];
							?>
							<?php if ( 'marquee' === $acf_fc_layout ) : ?>
							<?php // 마퀴 ?>
								<?php if ( $data['use'] ) : ?>
									<div class="product-single__slogan">
										<div class="jt-marquee-wrap">
											<div class="jt-marquee jt-typo--01" lang="en" data-label="<?php _e( 'Korean Green Miracle &nbsp; Korean Green Miracle &nbsp; ', 'jt' ); ?>">
												<?php _e( 'Korean Green Miracle &nbsp; Korean Green Miracle &nbsp; ', 'jt' ); ?>
											</div><!-- .jt-marquee -->
										</div><!-- .jt-marquee-wrap -->
									</div><!-- .product-single__slogan -->
								<?php endif; ?>
							<?php elseif ( 'photo' === $acf_fc_layout ) : ?>
							<?php // 이미지/영상(단일) ?>
								<?php if ( $data['use'] ) : ?>
									<?php
									$photo_pc_image			= jt_get_image_src( $data['image']['pc'], 'jt_thumbnail_1820' );
									$pc_image_data			= wp_get_attachment_metadata( $data['image']['pc'] );
									$pc_image_top_size		= ( $pc_image_data['height'] / $pc_image_data['width'] ) * 100;

									$photo_mobile_image		= jt_get_image_src( $data['image']['mobile'], 'jt_thumbnail_716' );
									$mobile_image_data		= wp_get_attachment_metadata( $data['image']['mobile'] );
									$mobile_image_top_size	= ( $mobile_image_data['height'] / $mobile_image_data['width'] ) * 100;

									$photo_pc_video     	= $data['video']['pc'];
									$photo_mobile_video		= $data['video']['mobile'];
									?>

									<div class="product-single__media">
										<?php if ( ! empty( $data['title'] ) ) : ?>
											<div class="product-single__component-title jt-motion--appear">
												<div class="wrap-middle">
													<i><?php jt_svg( '/images/sub/product/product-title-symbol.svg' ); ?></i>
													<h2 class="jt-typo--03" <?php echo ( ! empty( $data['us_title'] ) ) ? 'lang="en"' : ''; ?>><?php echo do_shortcode( $data['title'] ); ?></h2>

													<?php if ( 'on' === $data['sub_title_use'] ) : ?>
														<p class="jt-typo--13"><?php echo do_shortcode( $data['sub_title'] ); ?></p>
													<?php endif; ?>
												</div><!-- .wrap-middle -->
											</div><!-- .product-single__component-title -->
										<?php endif;?>
									
										<?php if ( ! empty( $photo_pc_video ) && ! empty( $photo_mobile_video ) ) : ?>
											<div class="product-single__video jt-motion--rise">
												<?php
												$photo_pc_video_link = add_query_arg( $video_option, $photo_pc_video );	
												$photo_mobile_video_link = add_query_arg( $video_option, $photo_mobile_video );
												?>
												<div class="product-single__video--large">
													<div class="jt-fullvid-container jt-autoplay-inview" style="padding-top: <?php echo $pc_image_top_size; ?>%;">
														<iframe class="jt-fullvid" src="https://player.vimeo.com/video/<?php echo $photo_pc_video_link; ?>" data-test="<?php echo $pc_image_data['width']; ?>" width="<?php echo $pc_image_data['width']; ?>" height="<?php echo $pc_image_data['height']; ?>" allowfullscreen></iframe>
														<span class="jt-fullvid__poster">
															<span class="jt-fullvid__poster-bg" data-unveil="<?php echo $photo_pc_image; ?>"></span>
														</span><!-- .jt-fullvid__poster -->
													</div><!-- .jt-fullvid-container -->
												</div><!-- .product-single__video--large -->

												<div class="product-single__video--small">
													<div class="jt-fullvid-container jt-autoplay-inview" style="padding-top: <?php echo $mobile_image_top_size; ?>%;">
														<iframe class="jt-fullvid" src="https://player.vimeo.com/video/<?php echo $photo_mobile_video_link; ?>" data-test="<?php echo $pc_image_data['width']; ?>" width="<?php echo $mobile_image_data['width']; ?>" height="<?php echo $mobile_image_data['height']; ?>" allowfullscreen></iframe>
														<span class="jt-fullvid__poster">
															<span class="jt-fullvid__poster-bg" data-unveil="<?php echo $photo_mobile_image; ?>"></span>
														</span><!-- .jt-fullvid__poster -->
													</div><!-- .jt-fullvid-container -->
												</div><!-- .product-single__video--small -->
											</div><!-- .product-single__video -->
										<?php endif; ?>
										
										<?php if ( empty( $photo_pc_video ) && empty( $photo_mobile_video ) ) : ?>
											<div class="product-single__photo jt-motion--rise">
												<div class="product-single__photo--large">
													<figure class="jt-lazyload" style="padding-top: <?php echo $pc_image_top_size; ?>%;">
														<span class="jt-lazyload__color-preview"></span>
														<img width="<?php echo $pc_image_data['width']; ?>" height="<?php echo $pc_image_data['height']; ?>" data-unveil="<?php echo $photo_pc_image; ?>" src="<?php echo get_stylesheet_directory_uri(); ?>/images/layout/blank.gif" alt="" />
														<noscript><img src="<?php echo $photo_pc_image; ?>" alt="" /></noscript>
													</figure><!-- .jt-lazyload -->
												</div><!-- .product-single__photo--large -->
												<div class="product-single__photo--small">
													<figure class="jt-lazyload" style="padding-top: <?php echo $mobile_image_top_size; ?>%;">
														<span class="jt-lazyload__color-preview"></span>
														<img width="<?php echo $mobile_image_data['width']; ?>" height="<?php echo $mobile_image_data['height']; ?>" data-unveil="<?php echo $photo_mobile_image; ?>" src="<?php echo get_stylesheet_directory_uri(); ?>/images/layout/blank.gif" alt="" />
														<noscript><img src="<?php echo $photo_mobile_image; ?>" alt="" /></noscript>
													</figure><!-- .jt-lazyload -->
												</div><!-- .product-single__photo--small -->
											</div><!-- .product-single__photo -->
										<?php endif; ?>
									</div><!-- .product-single__media -->
								<?php endif; ?>
							<?php elseif ( 'photo_box' === $acf_fc_layout ) : ?>
							<?php // 박스형(이미지) ?>
								<?php if ( $data['use'] ) : ?>
									<?php
									$box_pc_image			= jt_get_image_src( $data['image']['pc'], 'jt_thumbnail_2416' );
									$pc_image_data			= wp_get_attachment_metadata( $data['image']['pc'] );
									$pc_image_top_size		= ( $pc_image_data['height'] / $pc_image_data['width'] ) * 100;

									$box_mobile_image		= jt_get_image_src( $data['image']['mobile'], 'jt_thumbnail_716' );
									$mobile_image_data		= wp_get_attachment_metadata( $data['image']['mobile'] );
									$mobile_image_top_size	= ( $mobile_image_data['height'] / $mobile_image_data['width'] ) * 100;

									$box_pc_video			= $data['video']['pc'];
									$box_mobile_video		= $data['video']['mobile'];
									?>

									<div class="product-single__box jt-motion--rise">
										<div class="wrap-small">
											<?php if ( ! empty( $data['title'] ) ) : ?>
												<div class="product-single__component-title">
													<div class="wrap-middle">
														<i><?php jt_svg( '/images/sub/product/product-title-symbol.svg' ); ?></i>
														<h2 class="jt-typo--03" <?php echo ( ! empty( $data['us_title'] ) ) ? 'lang="en"' : ''; ?>><?php echo do_shortcode( $data['title'] ); ?></h2>

														<?php if ( 'on' === $data['sub_title_use'] ) : ?>
															<p class="jt-typo--13"><?php echo do_shortcode( $data['sub_title'] ); ?></p>
														<?php endif; ?>
													</div><!-- .wrap-middle -->
												</div><!-- .product-single__component-title -->
											<?php endif; ?>

											<?php if ( ! empty( $box_pc_video ) && ! empty( $box_mobile_video ) ) : ?>
												<div class="product-single__box-video">
													<?php
													$box_pc_video_link = add_query_arg( $video_option, $box_pc_video );
													$box_mobile_video_link = add_query_arg( $video_option, $box_mobile_video );
													?>
													<div class="product-single__box-video--large">
														<div class="jt-fullvid-container jt-autoplay-inview" style="padding-top: <?php echo $pc_image_top_size; ?>%;">
															<iframe class="jt-fullvid" src="https://player.vimeo.com/video/<?php echo $box_pc_video_link; ?>" width="<?php echo $pc_image_data['width']; ?>" height="<?php echo $pc_image_data['height']; ?>" allowfullscreen></iframe>
															<span class="jt-fullvid__poster">
																<span class="jt-fullvid__poster-bg" data-unveil="<?php echo $box_pc_image; ?>"></span>
															</span><!-- .jt-fullvid__poster -->
														</div><!-- .jt-fullvid-container -->
													</div><!-- .product-single__box-video--large -->

													<div class="product-single__box-video--small">
														<div class="jt-fullvid-container jt-autoplay-inview" style="padding-top: <?php echo $mobile_image_top_size; ?>%;">
															<iframe class="jt-fullvid" src="https://player.vimeo.com/video/<?php echo $box_mobile_video_link; ?>" width="<?php echo $mobile_image_data['width']; ?>" height="<?php echo $mobile_image_data['height']; ?>" allowfullscreen></iframe>
															<span class="jt-fullvid__poster">
																<span class="jt-fullvid__poster-bg" data-unveil="<?php echo $box_mobile_image; ?>"></span>
															</span><!-- .jt-fullvid__poster -->
														</div><!-- .jt-fullvid-container -->
													</div><!-- .product-single__box-video--small -->
												</div><!-- .product-single__box-video -->
											<?php endif; ?>

											<?php if ( empty( $box_pc_video ) && empty( $box_mobile_video ) ) : ?>
												<div class="product-single__box-img">
													<div class="product-single__box-img--large">
														<figure class="jt-lazyload" style="padding-top: <?php echo $pc_image_top_size; ?>%;">
															<span class="jt-lazyload__color-preview"></span>
															<img width="<?php echo $pc_image_data['width']; ?>" height="<?php echo $pc_image_data['height']; ?>" data-unveil="<?php echo $box_pc_image; ?>" src="<?php echo get_stylesheet_directory_uri(); ?>/images/layout/blank.gif" alt="" />
															<noscript><img src="<?php echo $box_pc_image; ?>" alt="" /></noscript>
														</figure><!-- .jt-lazyload -->
													</div><!-- .product-single__box-img--large -->

													<div class="product-single__box-img--small">
														<figure class="jt-lazyload" style="padding-top: <?php echo $mobile_image_top_size; ?>%;">
															<span class="jt-lazyload__color-preview"></span>
															<img width="<?php echo $mobile_image_data['width']; ?>" height="<?php echo $mobile_image_data['height']; ?>" data-unveil="<?php echo $box_mobile_image; ?>" src="<?php echo get_stylesheet_directory_uri(); ?>/images/layout/blank.gif" alt="" />
															<noscript><img src="<?php echo $box_mobile_image; ?>" alt="" /></noscript>
														</figure><!-- .jt-lazyload -->
													</div><!-- .product-single__box-img--small -->
												</div><!-- .product-single__box -->
											<?php endif; ?>
										</div><!-- .wrap-small -->
									</div><!-- .product-single__box -->
								<?php endif ?>
							<?php elseif ( 'photo_frame' === $acf_fc_layout ) : ?>
							<?php // 이미지/영상(프레임) ?>
								<?php if ( $data['use'] ) : ?>
									<div class="product-single__frame">
										<?php if ( ! empty( $data['title'] ) ) : ?>
											<div class="product-single__component-title jt-motion--appear">
												<div class="wrap-middle">
													<i><?php jt_svg( '/images/sub/product/product-title-symbol.svg' ); ?></i>
													<h2 class="jt-typo--03" <?php echo ( ! empty( $data['us_title'] ) ) ? 'lang="en"' : ''; ?>><?php echo do_shortcode( $data['title'] ); ?></h2>

													<?php if ( 'on' === $data['sub_title_use'] ) : ?>
														<p class="jt-typo--13"><?php echo do_shortcode( $data['sub_title'] ); ?></p>
													<?php endif; ?>
												</div><!-- .wrap-middle -->
											</div><!-- .product-single__component-title -->
										<?php endif; ?>

										<div class="product-single__frame-content jt-motion--rise">
											<?php foreach ( $data['image'] as $item ) : ?>
												<?php
												$fream_pc_image     	= jt_get_image_src( $item['image']['pc'], 'jt_thumbnail_1740' );
												$pc_image_data			= wp_get_attachment_metadata( $item['image']['pc'] );
												$pc_image_top_size		= ( $pc_image_data['height'] / $pc_image_data['width'] ) * 100;

												$fream_mobile_image		= jt_get_image_src( $item['image']['mobile'], 'jt_thumbnail_716' );
												$mobile_image_data		= wp_get_attachment_metadata( $item['image']['mobile'] );
												$mobile_image_top_size	= ( $mobile_image_data['height'] / $mobile_image_data['width'] ) * 100;

												$fream_pc_video			= $item['video']['pc'];
												$fream_mobile_video		= $item['video']['mobile'];
												?>
												<?php if ( ! empty( $fream_pc_video ) && ! empty( $fream_mobile_video ) ) : ?>
													<div class="product-single__video">
														<?php
														$fream_pc_video_link = add_query_arg( $video_option, $fream_pc_video );
														$fream_mobile_video_link = add_query_arg( $video_option, $fream_mobile_video );
														?>
														<div class="product-single__video--large">
															<div class="jt-fullvid-container jt-autoplay-inview" style="padding-top: <?php echo $pc_image_top_size; ?>%;">
																<iframe class="jt-fullvid" src="https://player.vimeo.com/video/<?php echo $fream_pc_video_link; ?>" width="1920" height="1080" allowfullscreen></iframe>
																<span class="jt-fullvid__poster">
																	<span class="jt-fullvid__poster-bg" data-unveil="<?php echo $fream_pc_image; ?>"></span>
																</span><!-- .jt-fullvid__poster -->
															</div><!-- .jt-fullvid-container -->
														</div><!-- .product-single__video--large -->
													
														<div class="product-single__video--small">
															<div class="jt-fullvid-container jt-autoplay-inview" style="padding-top: <?php echo $mobile_image_top_size; ?>%;">
																<iframe class="jt-fullvid" src="https://player.vimeo.com/video/<?php echo $fream_mobile_video_link; ?>" width="1920" height="1080" allowfullscreen></iframe>
																<span class="jt-fullvid__poster">
																	<span class="jt-fullvid__poster-bg" data-unveil="<?php echo $fream_mobile_image; ?>"></span>
																</span><!-- .jt-fullvid__poster -->
															</div><!-- .jt-fullvid-container -->
														</div><!-- .product-single__video--small -->
													</div><!-- .product-single__video -->
												<?php endif; ?>
												
												<?php if ( empty( $fream_pc_video ) && empty( $fream_mobile_video ) ) : ?>
													<div class="product-single__photo">
														<div class="product-single__photo--large">
															<figure class="jt-lazyload" style="padding-top: <?php echo $pc_image_top_size; ?>%;">
																<span class="jt-lazyload__color-preview"></span>
																<img width="<?php echo $pc_image_data['width']; ?>" height="<?php echo $pc_image_data['height']; ?>" data-unveil="<?php echo $fream_pc_image; ?>" src="<?php echo get_stylesheet_directory_uri(); ?>/images/layout/blank.gif" alt="" />
																<noscript><img src="<?php echo $fream_pc_image; ?>" alt="" /></noscript>
															</figure><!-- .jt-lazyload -->
														</div><!-- .product-single__photo--large -->
														<div class="product-single__photo--small">
														<figure class="jt-lazyload" style="padding-top: <?php echo $mobile_image_top_size; ?>%;">
																<span class="jt-lazyload__color-preview"></span>
																<img width="<?php echo $mobile_image_data['width']; ?>" height="<?php echo $mobile_image_data['height']; ?>" data-unveil="<?php echo $fream_mobile_image; ?>" src="<?php echo get_stylesheet_directory_uri(); ?>/images/layout/blank.gif" alt="" />
																<noscript><img src="<?php echo $fream_mobile_image; ?>" alt="" /></noscript>
															</figure><!-- .jt-lazyload -->
														</div><!-- .product-single__photo--small -->
													</div><!-- .product-single__photo -->
												<?php endif?>
											<?php endforeach; ?>
										</div>
									</div><!-- .product-single__frame -->
								<?php endif; ?>
							<?php elseif ( 'photo_explanation' === $acf_fc_layout ) : ?>
							<?php // 이미지/영상/설명(1~5개) - product-single__horiz ?>
								<?php if ( $data['use'] ) : ?>
									<div class="product-single__horiz">
										<?php if ( ! empty( $data['title'] ) ) : ?>
											<div class="product-single__component-title jt-motion--appear">
												<div class="wrap-middle">
													<i><?php jt_svg( '/images/sub/product/product-title-symbol.svg' ); ?></i>
													<h2 class="jt-typo--03" <?php echo ( ! empty( $data['us_title'] ) ) ? 'lang="en"' : ''; ?>><?php echo do_shortcode( $data['title'] ); ?></h2>

													<?php if ( 'on' === $data['sub_title_use'] ) : ?>
														<p class="jt-typo--13"><?php echo do_shortcode( $data['sub_title'] ); ?></p>
													<?php endif; ?>
												</div><!-- .wrap-middle -->
											</div><!-- .product-single__component-title -->
										<?php endif; ?>

										<div class="product-single__tabs">
											<?php if ( count( $data['contents'] ) > 1 ) : ?>
												<div class="jt-category-nav-wrap jt-category-nav-wrap--wide jt-motion--rise">
													<div class="jt-category-nav">
														<ul>
															<?php foreach ( $data['contents'] as $key => $item ) : ?>
																<li class="
																<?php
																if ( $key == 0 ) :
																	?>
																	jt-category--active<?php endif; ?>">
																	<a class="jt-typo--14" href="#horiz-colgroup-0<?php echo $key + 1; ?>"><span><?php echo do_shortcode( $item['tab_name'] ); ?></span></a>
																</li>
															<?php endforeach; ?>
														</ul>
													</div><!-- .jt-category-nav -->
												</div><!-- .jt-category-nav-wrap -->
											<?php endif; ?>
										
											<div class="product-single__tabs-panels">
												<?php foreach ( $data['contents'] as $key => $item ) : ?>
													<?php
													$explanation_pc_image		= jt_get_image_src( $item['image']['pc'], 'jt_thumbnail_1208x700' );
													$explanation_mobile_image	= jt_get_image_src( $item['image']['mobile'], 'jt_thumbnail_716x828' );

													$explanation_pc_video		= $item['video']['pc'];
													$explanation_mobile_video	= $item['video']['mobile'];
													?>

													<div class="product-single__horiz-colgroup jt-motion--stagger jt-motion--stagger-large jt-motion--rise jt-motion--rise-small" id="horiz-colgroup-0<?php echo $key + 1; ?>">
														<div class="product-single__horiz-bg-wrap jt-motion--stagger-item">

															<?php if ( ! empty( $explanation_pc_video ) && ! empty( $explanation_mobile_video ) ) : ?>
																<?php
																$explanation_pc_video_link = add_query_arg( $video_option, $explanation_pc_video );
																$explanation_mobile_video_link = add_query_arg( $video_option, $explanation_mobile_video );
																?>
																<div class="product-single__horiz-bg product-single__horiz-bg--video product-single__horiz-bg--large">
																	<div class="jt-fullvid-container jt-autoplay-inview">
																		<iframe class="jt-fullvid" src="https://player.vimeo.com/video/<?php echo $explanation_pc_video_link; ?>" width="1208" height="700" allowfullscreen></iframe>
																		
																		<span class="jt-fullvid__poster">
																			<span class="jt-fullvid__poster-bg" style="background-image: url(<?php echo $explanation_pc_image; ?>);"></span>
																		</span><!-- .jt-fullvid__poster -->
																	</div><!-- .jt-fullvid-container -->
																</div><!-- .product-single__horiz-bg -->
															
																<div class="product-single__horiz-bg product-single__horiz-bg--video product-single__horiz-bg--small">
																	<div class="jt-fullvid-container jt-autoplay-inview">
																		<iframe class="jt-fullvid" src="https://player.vimeo.com/video/<?php echo $explanation_mobile_video_link; ?>" width="716" height="828" allowfullscreen></iframe>
																		
																		<span class="jt-fullvid__poster">
																			<span class="jt-fullvid__poster-bg" style="background-image: url(<?php echo $explanation_mobile_image; ?>);"></span>
																		</span><!-- .jt-fullvid__poster -->
																	</div><!-- .jt-fullvid-container -->
																</div><!-- .product-single__horiz-bg -->
															<?php endif; ?>

															<?php if ( empty( $explanation_pc_video ) && empty( $explanation_mobile_video ) ) : ?>
																<div class="product-single__horiz-bg main-skincare__bg--large" data-unveil="<?php echo $explanation_pc_image; ?>"></div>
																<div class="product-single__horiz-bg main-skincare__bg--small" data-unveil="<?php echo $explanation_mobile_image; ?>"></div>
															<?php endif; ?>
															
														</div><!-- .product-single__horiz-bg-wrap -->
												
														<div class="product-single__horiz-content jt-motion--stagger-item">
															<p class="product-single__horiz-desc jt-typo--11"><?php echo do_shortcode( $item['detail'] ); ?></p>
															<span class="product-single__horiz-caption jt-typo--15"><?php echo do_shortcode( $item['description'] ); ?></span>
														</div><!-- .product-single__horiz-content -->
													</div><!-- .product-single__horiz-colgroup -->
												<?php endforeach; ?>
											
											</div><!-- .product-single__tabs-panels -->
										</div>
									</div><!-- .product-single__horiz -->
								<?php endif; ?>
							<?php elseif ( 'before_after_product' === $acf_fc_layout ) : ?>
							<?php // 비포/애프터(제품) ?>
								<?php if ( $data['use'] ) : ?>
									<div class="product-single__renewal">
										<?php if ( ! empty( $data['title'] ) ) : ?>
											<div class="product-single__component-title jt-motion--appear">
												<div class="wrap-middle">
													<i><?php jt_svg( '/images/sub/product/product-title-symbol.svg' ); ?></i>
													<h2 class="jt-typo--03" <?php echo ( ! empty( $data['us_title'] ) ) ? 'lang="en"' : ''; ?>><?php echo do_shortcode( $data['title'] ); ?></h2>

													<?php if ( 'on' === $data['sub_title_use'] ) : ?>
														<p class="jt-typo--13"><?php echo do_shortcode( $data['sub_title'] ); ?></p>
													<?php endif; ?>
												</div><!-- .wrap-middle -->
											</div><!-- .product-single__component-title -->
										<?php endif; ?>

										<div class="product-single__renewal-compare jt-motion--rise">
											<div class="product-single__renewal-before">
												<div class="product-single__renewal-thumb">
													<figure class="jt-lazyload">
														<img width="660" height="660" data-unveil="<?php echo jt_get_image_src( $data['before_image'], 'jt_thumbnail_1320x1320' ); ?>" src="<?php echo get_stylesheet_directory_uri(); ?>/images/layout/blank.gif" alt="" />
														<noscript><img src="<?php echo jt_get_image_src( $data['before_image'], 'jt_thumbnail_1320x1320' ); ?>" alt="" /></noscript>
													</figure><!-- .jt-lazyload -->
												</div><!-- .product-single__renewal-thumb -->

												<div class="product-single__renewal-txt">
													<span class="jt-typo--13" lang="en"><?php _e( 'Before', 'jt' ); ?></span>
													<p class="jt-typo--06"><?php echo do_shortcode( $data['before_title'] ); ?></p>
												</div><!-- .product-single__renewal-txt -->
											</div><!-- .product-single__renewal-before -->

											<div class="product-single__renewal-after">
												<i class="product-single__renewal-label jt-typo--13" lang="en"><?php _e( 'Renewal', 'jt' ); ?></i>

												<div class="product-single__renewal-thumb">
													<figure class="jt-lazyload">
														<img width="660" height="660" data-unveil="<?php echo jt_get_image_src( $data['after_image'], 'jt_thumbnail_1320x1320' ); ?>" src="<?php echo get_stylesheet_directory_uri(); ?>/images/layout/blank.gif" alt="" />
														<noscript><img src="<?php echo jt_get_image_src( $data['after_image'], 'jt_thumbnail_1320x1320' ); ?>" alt="" /></noscript>
													</figure><!-- .jt-lazyload -->
												</div><!-- .product-single__renewal-thumb -->

												<div class="product-single__renewal-txt">
													<span class="jt-typo--13" lang="en"><?php _e( 'After', 'jt' ); ?></span>
													<p class="jt-typo--06"><?php echo do_shortcode( $data['after_title'] ); ?></p>
												</div><!-- .product-single__renewal-txt -->
											</div><!-- .product-single__renewal-after -->
										</div><!-- .product-single__renewal-compare -->
									</div><!-- .product-single__renewal -->
								<?php endif; ?>
							<?php elseif ( 'before_after_skin' === $acf_fc_layout ) : ?>
							<?php // 비포/애프터(스킨) ?>
								<?php if ( $data['use'] ) : ?>
									<?php
										$before_pc_image			= jt_get_image_src( $data['before_image'], 'jt_thumbnail_592' );
										$before_pc_image_data		= wp_get_attachment_metadata( $data['before_image'] );
										$before_pc_image_top_size	= ( $before_pc_image_data['height'] / $before_pc_image_data['width'] ) * 100;

										$after_pc_image				= jt_get_image_src( $data['after_image'], 'jt_thumbnail_592' );
										$after_pc_image_data		= wp_get_attachment_metadata( $data['after_image'] );
										$after_pc_image_top_size	= ( $after_pc_image_data['height'] / $after_pc_image_data['width'] ) * 100;

										if ( ! empty( $data['before_after_mobile_image'] ) ) {
											$before_after_mobile_image	= jt_get_image_src( $data['before_after_mobile_image'], 'jt_thumbnail_716' );
											$mobile_image_data			= wp_get_attachment_metadata( $data['before_after_mobile_image'] );
											$mobile_image_top_size		= ( $mobile_image_data['height'] / $mobile_image_data['width'] ) * 100;
										}
									?>
									<div class="product-single__improve <?php echo ( empty( $data['description'] ) ) ? 'product-single__improve--no-desc' : ''; ?> jt-motion--rise">
										<div class="wrap-small">
											<?php if ( ! empty( $data['title'] ) ) : ?>
												<div class="product-single__component-title">
													<div class="wrap-middle">
														<i><?php jt_svg( '/images/sub/product/product-title-symbol.svg' ); ?></i>
														<h2 class="jt-typo--03" <?php echo ( ! empty( $data['us_title'] ) ) ? 'lang="en"' : ''; ?>><?php echo do_shortcode( $data['title'] ); ?></h2>

														<?php if ( 'on' === $data['sub_title_use'] ) : ?>
															<p class="jt-typo--13"><?php echo do_shortcode( $data['sub_title'] ); ?></p>
														<?php endif; ?>
													</div><!-- .wrap-middle -->
												</div><!-- .product-single__component-title -->
											<?php endif; ?>

											<ul class="product-single__improve-compare">
												<li class="product-single__improve-before">
													<?php /*<i class="product-single__improve-label jt-typo--13" lang="en"><?php _e( 'Before', 'jt' ); ?></i>*/ ?>
										
													<div class="product-single__improve-thumb">
														<figure class="jt-lazyload" style="padding-top: <?php echo $before_pc_image_top_size; ?>%"> <?php // 계산필요 (h/w * 100) ?>
															<span class="jt-lazyload__color-preview"></span>
															<img width="592" height="800" data-unveil="<?php echo $before_pc_image; ?>" src="<?php echo get_stylesheet_directory_uri(); ?>/images/layout/blank.gif" alt="" />
															<noscript><img src="<?php echo $before_pc_image; ?>" alt="" /></noscript>
														</figure><!-- .jt-lazyload -->
													</div><!-- .product-single__improve-thumb -->
												</li><!-- .product-single__improve-before -->
										
												<li class="product-single__improve-after">
													<?php /* <i class="product-single__improve-label jt-typo--13" lang="en"><?php _e( 'After', 'jt' ); ?></i> */ ?>
										
													<div class="product-single__improve-thumb">
														<figure class="jt-lazyload" style="padding-top: <?php echo $after_pc_image_top_size; ?>%"> <?php // 계산필요 (h/w * 100) ?>
															<span class="jt-lazyload__color-preview"></span>
															<img width="592" height="800" data-unveil="<?php echo $after_pc_image; ?>" src="<?php echo get_stylesheet_directory_uri(); ?>/images/layout/blank.gif" alt="" />
															<noscript><img src="<?php echo $after_pc_image; ?>" alt="" /></noscript>
														</figure><!-- .jt-lazyload -->
													</div><!-- .product-single__improve-thumb -->
												</li><!-- .product-single__improve-after -->
											</ul><!-- .product-single__improve-compare -->
											
											<?php if ( ! empty( $data['before_after_mobile_image'] ) ) : ?>
												<div class="product-single__improve-small">
													<figure class="jt-lazyload" style="padding-top: <?php echo $mobile_image_top_size; ?>%"> <?php // 계산필요 (h/w * 100) ?>
														<span class="jt-lazyload__color-preview"></span>
														<img width="592" height="800" data-unveil="<?php echo $before_after_mobile_image; ?>" src="<?php echo get_stylesheet_directory_uri(); ?>/images/layout/blank.gif" alt="" />
														<noscript><img src="<?php echo $before_after_mobile_image; ?>" alt="" /></noscript>
													</figure><!-- .jt-lazyload -->
												</div><!-- .product-single__improve-thumb -->
											<?php endif; ?>
                                    
											<?php if ( ! empty( $data['description'] ) ) : ?>
												<p class="product-single__improve-caption jt-typo--15"><?php echo $data['description']; ?></p>
											<?php endif; ?>
										</div><!-- .wrap-small -->
									</div><!-- .product-single__improve-compare -->
								<?php endif; ?>
							<?php elseif ( 'benefit' === $acf_fc_layout ) : ?>
							<?php // 특징(1~3개) ?>
								<?php if ( $data['use'] ) : ?>
									<div class="product-single__features">
										<?php if ( ! empty( $data['title'] ) ) : ?>
											<div class="product-single__component-title jt-motion--appear">
												<div class="wrap-middle">
													<i><?php jt_svg( '/images/sub/product/product-title-symbol.svg' ); ?></i>
													<h2 class="jt-typo--03" <?php echo ( ! empty( $data['us_title'] ) ) ? 'lang="en"' : ''; ?>><?php echo do_shortcode( $data['title'] ); ?></h2>

													<?php if ( 'on' === $data['sub_title_use'] ) : ?>
														<p class="jt-typo--13"><?php echo do_shortcode( $data['sub_title'] ); ?></p>
													<?php endif; ?>
												</div><!-- .wrap-middle -->
											</div><!-- .product-single__component-title -->
										<?php endif; ?>

										<div class="wrap-small">
											<div class="product-single__features-screen jt-motion--rise jt-motion--rise-small">
												<div class="product-single__features-image">
													<figure class="jt-lazyload">
														<img width="700" height="700" data-unveil="<?php echo jt_get_image_src( $data['image'], 'jt_thumbnail_1400x1400' ); ?>" src="<?php echo get_stylesheet_directory_uri(); ?>/images/layout/blank.gif" alt="" />
														<noscript><img src="<?php echo jt_get_image_src( $data['image'], 'jt_thumbnail_1400x1400' ); ?>" alt="" /></noscript>
													</figure><!-- .jt-lazyload -->
												</div><!-- .product-single__features-image -->

												<ul class="product-single__features-txt">
													<?php foreach ( $data['data'] as $item ) : ?>
														<li>
															<h3 class="jt-typo--06"><?php echo do_shortcode( $item['title'] ); ?></h3>
															<p class="jt-typo--14"><?php echo do_shortcode( $item['content'] ); ?></p>
														</li>
													<?php endforeach; ?>
												</ul><!-- .product-single__features-txt -->
											</div><!-- .product-single__features-screen -->
										</div><!-- .wrap-small -->
									</div><!-- .product-single__features -->
								<?php endif; ?>
							<?php elseif ( 'marketing' === $acf_fc_layout ) : ?>
							<?php // 다이어그램(2~5개) ?>
								<?php if ( $data['use'] ) : ?>
									<div class="product-single__diagram jt-motion--rise <?php echo ( empty( $data['additional_explanation'] ) ) ? 'product-single__diagram--no-explanation' : '' ?>">
										<?php if ( ! empty( $data['title'] ) ) : ?>
											<div class="product-single__component-title">
												<div class="wrap-middle">
													<i><?php jt_svg( '/images/sub/product/product-title-symbol.svg' ); ?></i>
													<h2 class="jt-typo--03" <?php echo ( ! empty( $data['us_title'] ) ) ? 'lang="en"' : ''; ?>><?php echo do_shortcode( $data['title'] ); ?></h2>
													<p class="jt-typo--13"><?php echo do_shortcode( $data['sub_title'] ); ?></p>
												</div><!-- .wrap-middle -->
											</div><!-- .product-single__component-title -->
										<?php endif; ?>

										<div class="wrap-middle">
											<ul class="product-single__diagram-point <?php echo ( count( $data['data'] ) <= 3 ) ? '' : 'product-single__diagram-point-small'; ?>">
												<?php foreach ( $data['data'] as $item ) : ?>
													<li>
														<div class="product-single__diagram-circle">
															<div class="product-single__diagram-circle-inner <?php echo ( empty( $item['content'] ) ) ? 'product-single__diagram-circle-inner-no-desc' : ''; ?>">
																<b class="<?php echo ( count( $data['data'] ) <= 3 ) ? 'jt-typo--06' : 'jt-typo--07' ;?>"><?php echo do_shortcode( $item['title'] ); ?></b>
																<?php if ( ! empty( $item['content'] ) ) : ?>
																	<p class="jt-typo--14"><?php echo do_shortcode( $item['content'] ); ?></p>
																<?php endif; ?>
															</div><!-- .product-single__diagram-circle-inner -->
														</div><!-- .product-single__diagram-circle -->

														<?php if ( ! empty( $item['content'] ) ) : ?>
															<p class="jt-typo--14"><?php echo do_shortcode( $item['content'] ); ?></p>
														<?php endif; ?>
													</li>
												<?php endforeach; ?>
											</ul><!-- .product-single__diagram-circle -->
										</div><!-- .wrap-middle -->

										<div class="wrap-small">
											<?php if ( ! empty( $data['additional_explanation'] ) ) : ?>
												<ul class="product-single__diagram-check-list">
													<?php foreach ( $data['additional_explanation'] as $item ) : ?>
													<li>
														<i class="jt-icon"><?php jt_icon( 'jt-check' ); ?></i>
														<h3 class="jt-typo--13"><?php echo do_shortcode( $item['content'] ); ?></h3>
														<p class="jt-typo--14"><?php echo do_shortcode( $item['explanation']['first'] ); ?></p>
														<p class="jt-typo--14"><?php echo do_shortcode( $item['explanation']['second'] ); ?></p>
													</li>
													<?php endforeach; ?>
												</ul>
											<?php endif; ?>
				
											<p class="product-single__diagram-caption jt-typo--15"><?php echo do_shortcode( $data['description'] ); ?></p>
										</div><!-- .wrap-small -->

									</div><!-- .product-single__diagram -->
								<?php endif; ?>
							<?php elseif ( 'ingredients' === $acf_fc_layout ) : ?>
							<?php // 2단 : 항목별 이미지 ?>
								<?php if ( $data['use'] ) : ?>
									<div class="product-single__itemize-images">
										<?php if ( ! empty( $data['title'] ) ) : ?>
											<div class="product-single__component-title jt-motion--appear">
												<div class="wrap-middle">
													<i><?php jt_svg( '/images/sub/product/product-title-symbol.svg' ); ?></i>
													<h2 class="jt-typo--03" <?php echo ( ! empty( $data['us_title'] ) ) ? 'lang="en"' : ''; ?>><?php echo do_shortcode( $data['title'] ); ?></h2>

													<?php if ( 'on' === $data['sub_title_use'] ) : ?>
														<p class="jt-typo--13"><?php echo do_shortcode( $data['sub_title'] ); ?></p>
													<?php endif; ?>
												</div><!-- .wrap-middle -->
											</div><!-- .product-single__component-title -->
										<?php endif; ?>

										<div class="product-single__component-column jt-motion--stagger jt-motion--stagger-large jt-motion--rise jt-motion--rise-small">
											<div class="product-single__itemize-images-data jt-motion--stagger-item">
												<div class="product-single__itemize-images-slider swiper">
													<div class="swiper-wrapper">
														<?php foreach ( $data['data'] as $item ) : ?>
															<div class="swiper-slide">
																<div class="product-single__itemize-images-bg swiper-lazy" data-background="<?php echo jt_get_image_src( $item['image'], 'jt_thumbnail_902x902' ); ?>"></div>

																<?php if ( ! empty( $item['attributes'] ) || ! empty( $item['description'] ) ) : ?>
																	<div class="product-single__itemize-images-value">
																		<div class="product-single__itemize-images-value-inner">
																			<?php if ( ! empty( $item['attributes'] ) ) : ?>
																				<ul>
																					<?php foreach ( $item['attributes'] as $child ) : ?>
																						<li class="jt-typo--11"><?php echo do_shortcode( $child['item'] ); ?></li>
																					<?php endforeach; ?>
																				</ul>
																			<?php endif; ?>

																			<?php if ( ! empty( $item['description'] ) ) : ?>
																				<p class="jt-typo--15"><?php echo do_shortcode( $item['description'] ); ?></p>
																			<?php endif; ?>
																		</div><!-- .product-single__itemize-images-value-inner -->
																	</div><!-- .product-single__itemize-images-value -->
																<?php endif; ?>
															</div><!-- .swiper-slide -->
														<?php endforeach; ?>
													</div><!-- .swiper-wrapper -->
												</div><!-- .product-single__itemize-images-slider -->
											</div><!-- .product-single__itemize-images-data -->

											<div class="product-single__itemize-images-key jt-motion--stagger-item">
												<div class="product-single__itemize-images-bg" data-unveil="<?php echo jt_get_image_src( $data['image'], 'jt_thumbnail_902x902' ); ?>"></div>

												<ul class="product-single__itemize-images-key-list">
													<?php foreach ( $data['data'] as $idx => $item ) : ?>
														<li class="jt-typo--04 <?php echo ( 0 == $idx ? 'product-single__itemize-images-key--active' : '' ); ?>">
															<span><?php echo do_shortcode( $item['name'] ); ?></span>
														</li>
													<?php endforeach; ?>
												</ul><!-- .product-single__itemize-images-key-list -->
											</div><!-- .product-single__itemize-images-key -->
										</div><!-- .product-single__component-column -->
									</div><!-- .product-single__itemize-images -->
								<?php endif; ?>
							<?php elseif ( 'experience' === $acf_fc_layout ) : ?>
							<?php // 2단 : 설명 + 항목 ?>
								<?php if ( $data['use'] ) : ?>
									<div class="product-single__half-data">
										<?php if ( ! empty( $data['title'] ) ) : ?>
											<div class="product-single__component-title jt-motion--appear">
												<div class="wrap-middle">
													<i><?php jt_svg( '/images/sub/product/product-title-symbol.svg' ); ?></i>
													<h2 class="jt-typo--03" <?php echo ( ! empty( $data['us_title'] ) ) ? 'lang="en"' : ''; ?>><?php echo do_shortcode( $data['title'] ); ?></h2>

													<?php if ( 'on' === $data['sub_title_use'] ) : ?>
														<p class="jt-typo--13"><?php echo do_shortcode( $data['sub_title'] ); ?></p>
													<?php endif; ?>
												</div><!-- .wrap-middle -->
											</div><!-- .product-single__component-title -->
										<?php endif; ?>

										<div class="product-single__component-column jt-motion--stagger jt-motion--stagger-large jt-motion--rise jt-motion--rise-small">
											<div class="product-single__half-data-picture jt-motion--stagger-item">
												<div class="product-single__half-data-image" data-unveil="<?php echo jt_get_image_src( $data['image'], 'jt_thumbnail_902x902' ); ?>"></div>
											</div><!-- .product-single__half-data-picture -->

											<div class="product-single__half-data-content jt-motion--stagger-item">
												<?php if ( ! empty( $data['description'] ) ) : ?>
												<p class="jt-typo--13"><?php echo do_shortcode( $data['description'] ); ?></p>
												<?php endif; ?>

												<ul class="product-single__half-data-type">
													<?php foreach ( $data['data'] as $item ) : ?>
														<li>
															<b class="jt-typo--11"><?php echo do_shortcode( $item['name'] ); ?></b>
															<p class="jt-typo--12"><?php echo do_shortcode( $item['content'] ); ?></p>
														</li>
													<?php endforeach; ?>
												</ul><!-- .product-single__half-data-type -->
											</div><!-- .product-single__half-data-content -->
										</div><!-- .product-single__component-column -->
									</div><!-- .product-single__half-data -->
								<?php endif; ?>
							<?php elseif ( 'infused' === $acf_fc_layout ) : ?>
							<?php // 2단 : 설명만 ?>
								<?php if ( $data['use'] ) : ?>
									<?php
									$infused_image = jt_get_image_src( $data['image'], 'jt_thumbnail_902x902' );
									?>
									<div class="product-single__half-basic">
										<?php if ( ! empty( $data['title'] ) ) : ?>
											<div class="product-single__component-title jt-motion--appear">
												<div class="wrap-middle">
													<i><?php jt_svg( '/images/sub/product/product-title-symbol.svg' ); ?></i>
													<h2 class="jt-typo--03" <?php echo ( ! empty( $data['us_title'] ) ) ? 'lang="en"' : ''; ?>><?php echo do_shortcode( $data['title'] ); ?></h2>

													<?php if ( 'on' === $data['sub_title_use'] ) : ?>
														<p class="jt-typo--13"><?php echo do_shortcode( $data['sub_title'] ); ?></p>
													<?php endif; ?>
												</div><!-- .wrap-middle -->
											</div><!-- .product-single__component-title -->
										<?php endif; ?>

										<div class="product-single__component-column jt-motion--stagger jt-motion--stagger-large jt-motion--rise jt-motion--rise-smallr">
											<div class="product-single__half-basic-picture jt-motion--stagger-item">
												<div class="product-single__half-basic-image" data-unveil="<?php echo $infused_image; ?>"></div>
											</div><!-- .product-single__half-basic-picture -->

											<div class="product-single__half-basic-content jt-motion--stagger-item">
												<p class="jt-typo--11"><?php echo do_shortcode( $data['description'] ); ?></p>
											</div><!-- .product-single__half-basic-content -->
										</div><!-- .product-single__component-column -->
									</div><!-- .product-single__half-basic -->
								<?php endif; ?>
							<?php elseif ( 'howto' === $acf_fc_layout ) : ?>
							<?php // 2단 : 스텝 + 영상 ?>
								<?php if ( $data['use'] ) : ?>
									<div class="product-single__howto">
										<?php if ( ! empty( $data['title'] ) ) : ?>
											<div class="product-single__component-title jt-motion--appear">
												<div class="wrap-middle">
													<i><?php jt_svg( '/images/sub/product/product-title-symbol.svg' ); ?></i>
													<h2 class="jt-typo--03" <?php echo ( ! empty( $data['us_title'] ) ) ? 'lang="en"' : ''; ?>><?php echo do_shortcode( $data['title'] ); ?></h2>

													<?php if ( 'on' === $data['sub_title_use'] ) : ?>
														<p class="jt-typo--13"><?php echo do_shortcode( $data['sub_title'] ); ?></p>
													<?php endif; ?>
												</div><!-- .wrap-middle -->
											</div><!-- .product-single__component-title -->
										<?php endif; ?>

										<div class="product-single__component-column jt-motion--rise">
											<div class="product-single__howto-step swiper">
												<ul class="swiper-wrapper">
													<?php foreach ( $data['data'] as $idx => $item ) : ?>
													<li class="swiper-slide" data-hash="slide<?php echo $idx + 1; ?>">
														<b class="jt-typo--14" lang="en"><?php _e( 'Step', 'jt' ); ?> <?php echo $idx + 1; ?></b>
														<p class="jt-typo--07"><?php echo do_shortcode( $item['content'] ); ?></p>
													</li>
													<?php endforeach; ?>
												</ul>

												<div class="swiper-pagination"></div>
											</div><!-- .product-single__howto-step -->

											<div class="product-single__howto-picture">
												<?php if ( ! empty( $data['image']['video'] ) ) : ?>
													<?php
													$howto_video_link = add_query_arg( $video_option, $data['image']['video'] ); ?>
													<div class="product-single__howto-movie">
														<div class="jt-fullvid-container jt-autoplay-inview">
															<iframe class="jt-fullvid" src="https://player.vimeo.com/video/<?php echo $howto_video_link; ?>" width="902" height="902" allowfullscreen></iframe>
															<span class="jt-fullvid__poster">
																<span class="jt-fullvid__poster-bg" data-unveil="<?php echo jt_get_image_src( $data['image']['image'], 'jt_thumbnail_902x902' ); ?>"></span>
															</span><!-- .jt-fullvid__poster -->
														</div><!-- .jt-fullvid-container -->
													</div><!-- .product-single__howto-movie -->
												<?php else : ?>
													<div class="product-single__howto-image" data-unveil="<?php echo jt_get_image_src( $data['image']['image'], 'jt_thumbnail_902x902' ); ?>"></div>
												<?php endif; ?>
											</div><!-- .product-single__howto-picture -->
										</div><!-- .product-single__component-column -->
									</div><!-- .product-single__howto -->
								<?php endif; ?>
							<?php elseif ( 'proven' === $acf_fc_layout ) : ?>
							<?php // 임상시험 그룹 ?>
								<?php if ( $data['use'] ) : ?>
									<div class="product-single__proven">
										<?php if ( ! empty( $data['title'] ) ) : ?>
											<div class="product-single__component-title jt-motion--appear">
												<div class="wrap-middle">
													<i><?php jt_svg( '/images/sub/product/product-title-symbol.svg' ); ?></i>
													<h2 class="jt-typo--03" <?php echo ( ! empty( $data['us_title'] ) ) ? 'lang="en"' : ''; ?>><?php echo do_shortcode( $data['title'] ); ?></h2>

													<?php if ( 'on' === $data['sub_title_use'] ) : ?>
														<p class="jt-typo--13"><?php echo do_shortcode( $data['sub_title'] ); ?></p>
													<?php endif; ?>
												</div><!-- .wrap-middle -->
											</div><!-- .product-single__component-title -->
										<?php endif; ?>

										<div class="product-single__proven-item-wrap">
											<?php foreach ( $data['data'] as $idx => $item ) : ?>

												<?php // 임상시험 1번타입 ?>
												<?php if ( 'type_1' === $item['acf_fc_layout'] ) : ?>
													<div class="product-single__proven-item product-single__proven-item--primary jt-motion--rise">
														<?php if ( ! empty( $item['number'] ) ) : ?>
															<span class="product-single__proven-count jt-typo--07" <?php echo ( ( $language === 'en-US' ) ) ? 'lang="en"' : ''; ?>><?php echo $item['number']; ?></span>
														<?php endif; ?>
														
														<div class="wrap-small">
															<div class="product-single__proven-horizontal">
																<h2 class="product-single__proven-title jt-typo--03"><?php echo do_shortcode( $item['title'] ); ?></h2>
																<?php
																$pc_image_url		= $item['image']['pc'];
																$mobile_image_url	= $item['image']['mobile'];
																?>
																<?php if ( ! empty( $pc_image_url ) || ! empty( $mobile_image_url ) ) : ?>
																<div class="product-single__proven-image">
																	<?php if ( ! empty( $pc_image_url ) ) : ?>
																	<?php
																	$pc_image_data			= wp_get_attachment_metadata( $pc_image_url );
																	$pc_image_height_size	= ( $pc_image_data['height'] / $pc_image_data['width'] ) * 100;
																	?>
																	<div class="product-single__proven-image--large">
																		<figure class="jt-lazyload" style="padding-top: <?php echo $pc_image_height_size; ?>%;">
																			<img width="<?php echo $pc_image_data['width']; ?>" height="<?php echo $pc_image_data['height']; ?>" data-unveil="<?php echo jt_get_image_src( $pc_image_url, 'jt_thumbnail_2416' ); ?>" src="<?php echo get_stylesheet_directory_uri(); ?>/images/layout/blank.gif" alt="" />
																			<noscript><img src="<?php echo jt_get_image_src( $pc_image_url, 'jt_thumbnail_2416' ); ?>" alt="" /></noscript>
																		</figure><!-- .jt-lazyload -->
																	</div><!-- .product-single__proven-image--large -->
																	<?php endif; ?>
																	
																	<?php if ( ! empty( $mobile_image_url ) ) : ?>
																	<?php
																	$mobile_image_data			= wp_get_attachment_metadata( $mobile_image_url );
																	$mobile_image_height_size	= ( $mobile_image_data['height'] / $mobile_image_data['width'] ) * 100;
																	?>
																	<div class="product-single__proven-image--small">
																		<figure class="jt-lazyload" style="padding-top: <?php echo $mobile_image_height_size; ?>%;">
																			<img width="<?php echo $mobile_image_data['width']; ?>" height="<?php echo $mobile_image_data['height']; ?>" data-unveil="<?php echo jt_get_image_src( $mobile_image_url, 'jt_thumbnail_716' ); ?>" src="<?php echo get_stylesheet_directory_uri(); ?>/images/layout/blank.gif" alt="" />
																			<noscript><img src="<?php echo jt_get_image_src( $mobile_image_url, 'jt_thumbnail_716' ); ?>" alt="" /></noscript>
																		</figure><!-- .jt-lazyload -->
																	</div><!-- .product-single__proven-image--small -->
																	<?php endif; ?>
																</div><!-- .product-single__proven-image -->
																<?php endif; ?>
																
																<?php if ( ! empty( $item['data'] ) ) : ?>
																	<ul class="product-single__proven-value-list">
																		<?php foreach ( $item['data'] as $child ) : ?>
																			<li>
																				<p class="jt-typo--11"><span><?php echo do_shortcode( $child['content'] ); ?></span></p>
																				<strong><b class="jt-typo--10" lang="en"><?php echo $child['percent']; ?></b><span class="jt-typo--14">%</span></strong>
																			</li>
																		<?php endforeach; ?>
																	</ul><!-- .product-single__proven-value-list -->
																<?php endif; ?>
																
																<?php if ( ! empty( $item['description'] ) ) : ?>
																	<p class="product-single__proven-caption jt-typo--15"><?php echo do_shortcode( $item['description'] ); ?></p><!-- .product-single__proven-caption -->
																<?php endif; ?>
															</div><!-- .product-single__proven-horizontal -->
														</div><!-- .wrap-small -->
													</div><!-- .product-single__proven-item -->

												<?php // 임상시험 1번 타입(좌우비교 + 버튼) 신규 마크업 ?>
												<?php elseif ( 'type_1_comparison_button' === $item['acf_fc_layout'] ) : ?>					
													
													<div class="product-single__proven-item product-single__proven-item--tertiary jt-motion--rise">
														<?php if ( ! empty( $item['number'] ) ) : ?>
															<span class="product-single__proven-count jt-typo--07" <?php echo ( ( $language === 'en-US' ) ) ? 'lang="en"' : ''; ?>><?php echo $item['number']; ?></span>
														<?php endif; ?>

														<div class="wrap-small">
															<div class="product-single__proven-horizontal">
																<div class="product-single__proven-title-group">
																	<h3 class="jt-typo--04"><?php echo do_shortcode( $item['title'] ); ?></h3>
																	<?php if ( ! empty( $item['sub_title'] ) ) : ?>
																		<span class="jt-typo--07"><?php echo do_shortcode( $item['sub_title'] ); ?></span>
																	<?php endif; ?>
																</div><!-- .product-single__proven-title-group -->

																<?php foreach ( $item['group'] as $child ) : ?>
																	<?php
																	$left_image_url		= $child['left_image']['pc'];
																	$left_image_data	= wp_get_attachment_metadata( $left_image_url );
																	
																	$right_image_url	= $child['right_image']['pc'];
																	$right_image_data	= wp_get_attachment_metadata( $right_image_url );
																	?>
																	<div class="product-single__proven-group">
																		<h3 class="product-single__proven-group-title jt-typo--11"><?php echo do_shortcode( $child['name'] ); ?></h3>
																		
																		<div class="product-single__proven-columns">
																			<div class="product-single__proven-column">
																				<figure class="jt-lazyload">
																					<span class="jt-lazyload__color-preview"></span>
																					<img width="<?php echo $left_image_data['width']; ?>" height="<?php echo $left_image_data['height']; ?>" data-unveil="<?php echo jt_get_image_src( $left_image_url, 'jt_thumbnail_592x836' ); ?>" src="<?php echo get_stylesheet_directory_uri(); ?>/images/layout/blank.gif" alt="" />
																					<noscript><img src="<?php echo jt_get_image_src( $left_image_url, 'jt_thumbnail_592x836' ); ?>" alt="" /></noscript>
																				</figure><!-- .jt-lazyload -->

																				<?php if ( ! empty( $child['left_data'] ) ) : ?>
																					<ul class="product-single__proven-column-content">
																						<?php foreach ( $child['left_data'] as $left_child ) : ?>
																							<li class="jt-typo--14"><?php echo do_shortcode( $left_child['item'] ); ?></li>
																						<?php endforeach; ?>
																					</ul>
																				<?php endif; ?>
																			</div><!-- .product-single__proven-column -->

																			<div class="product-single__proven-column">
																				<figure class="jt-lazyload">
																					<span class="jt-lazyload__color-preview"></span>
																					<img width="<?php echo $right_image_data['width']; ?>" height="<?php echo $right_image_data['height']; ?>" data-unveil="<?php echo jt_get_image_src( $right_image_url, 'jt_thumbnail_592x836' ); ?>" src="<?php echo get_stylesheet_directory_uri(); ?>/images/layout/blank.gif" alt="" />
																					<noscript><img src="<?php echo jt_get_image_src( $right_image_url, 'jt_thumbnail_592x836' ); ?>" alt="" /></noscript>
																				</figure><!-- .jt-lazyload -->
																				
																				<?php if ( ! empty( $child['right_data'] ) ) : ?>
																					<ul class="product-single__proven-column-content">
																						<?php foreach ( $child['right_data'] as $right_child ) : ?>
																							<li class="jt-typo--14"><?php echo $right_child['item']; ?></li>
																						<?php endforeach; ?>
																					</ul>
																				<?php endif; ?>
																			</div><!-- .product-single__proven-column -->
																		</div><!-- .product-single__proven-columns -->
																	</div><!-- .product-single__proven-group -->
																<?php endforeach; ?>
																
																<?php if ( ! empty( $item['data'] ) ) : ?>
																	<?php
																	$array_reduce_data = array_reduce( $item['data'], function( $carry, $child ) {
																		return $carry || ! empty($child['content']) || ! empty( $child['explanation']['first'] ) || ! empty( $child['explanation']['second'] );
																	}, false );
																	?>
																	<?php if ( $array_reduce_data ) : ?>
																		<ul class="product-single__proven-check-list">
																			<?php foreach ( $item['data'] as $child ) : ?>
																				<?php if ( ! empty( $child['content'] ) || ! empty( $child['explanation']['first'] ) || ! empty( $child['explanation']['second'] ) ) : ?>
																				<li>
																					<i class="jt-icon"><?php jt_icon( 'jt-check' ); ?></i>
																					<h3 class="jt-typo--13"><?php echo do_shortcode( $child['content'] ); ?></h3>
																					<p class="jt-typo--14"><?php echo do_shortcode( $child['explanation']['first'] ); ?></p>
																					<p class="jt-typo--14"><?php echo do_shortcode( $child['explanation']['second'] ); ?></p>
																				</li>
																				<?php endif; ?>
																			<?php endforeach; ?>
																		</ul><!-- .product-single__proven-check-list -->
																	<?php endif; ?>
																<?php endif; ?>

																<p class="product-single__proven-caption jt-typo--15"><?php echo do_shortcode( $item['description'] ); ?></p>
																
																<?php
																if ( 'url' === $item['report_use'] ) {
																	$report_type = $item['report_link']; 
																} else {
																	$report_type = wp_get_attachment_url( $item['report_file'] );
																}
																?>
																<?php if ( ! empty( $report_type ) ) : ?>
																	<a class="product-single__component-btn" href="<?php echo $report_type; ?>" target="_blank" rel="noopener">
																		<span class="jt-typo--13" lang="en"><?php _e( 'View Full Report', 'jt' ); ?></span>
																		<i class="jt-icon"><?php jt_icon( 'jt-arrow-up-right-secondary' ); ?></i>
																	</a><!-- .product-single__buy -->
																<?php endif; ?>
															</div><!-- .product-single__proven-horizontal -->
														</div><!-- .wrap-small -->
													</div><!-- .product-single__proven-item -->

												<?php // 임상시험 2번타입 ?>
												<?php elseif ( 'type_2' === $item['acf_fc_layout'] ) : ?>
													<?php // 1개일때 ?>
													<?php if ( count( $item['type_2_data'] ) <= 1 ) : ?>
														<?
														$type_data = $item['type_2_data'][0];	
														?>
														<div class="product-single__proven-item product-single__proven-item--secondary jt-motion--stagger">
															<div class="product-single__proven-vertical">
																<div class="product-single__proven-vertical-content jt-motion--stagger-item">
																	<?php if ( ! empty( $item['number'] ) ) : ?>
																		<span class="product-single__proven-count jt-typo--07" <?php echo ( ( $language === 'en-US' ) ) ? 'lang="en"' : ''; ?>><?php echo $item['number']; ?></span>
																	<?php endif; ?>

																	<div class="product-single__proven-vertical-content-inner">
																		<div class="product-single__proven-title-group">
																			<h2 class="product-single__proven-title jt-typo--04"><?php echo do_shortcode( $type_data['title'] ); ?></h2>
																			<?php if ( ! empty( $type_data['sub_title'] ) ) : ?>
																				<span class="product-single__proven-subtitle jt-typo--10"><?php echo do_shortcode( $type_data['sub_title'] ); ?></span>
																			<?php endif; ?>
																		</div><!-- .product-single__proven-title-group -->

																		<div class="product-single__proven-image--small">
																			<figure class="jt-lazyload" style="padding-top: 100%;">
																				<img width="902" height="902" data-unveil="<?php echo jt_get_image_src( $type_data['image']['pc'], 'jt_thumbnail_902' ); ?>" src="<?php echo get_stylesheet_directory_uri(); ?>/images/layout/blank.gif" alt="" />
																				<noscript><img src="<?php echo jt_get_image_src( $type_data['image']['pc'], 'jt_thumbnail_902' ); ?>" alt="" /></noscript>
																			</figure><!-- .jt-lazyload -->
																		</div><!-- .product-single__proven-image--small -->

																		<ul class="product-single__proven-check-list">
																			<?php foreach ( $type_data['data'] as $info ) : ?>
																			<li>
																				<i class="jt-icon"><?php jt_icon( 'jt-check' ); ?></i>
																				<h3 class="jt-typo--13"><?php echo do_shortcode( $info['content'] ); ?></h3>
																				
																				<?php if ( ! empty( $info['data']['first'] ) ) : ?>
																					<p class="jt-typo--14"><?php echo do_shortcode( $info['data']['first'] ); ?></p>
																				<?php endif; ?>
																				<?php if ( ! empty( $info['data']['second'] ) ) : ?>
																					<p class="jt-typo--14"><?php echo do_shortcode( $info['data']['second'] ); ?></p>
																				<?php endif; ?>
																				<?php if ( ! empty( $info['data']['thirdly'] ) ) : ?>
																					<p class="jt-typo--14"><?php echo do_shortcode( $info['data']['thirdly'] ); ?></p>
																				<?php endif; ?>
																				<?php if ( ! empty( $info['data']['fourth'] ) ) : ?>
																					<p class="jt-typo--14"><?php echo do_shortcode( $info['data']['fourth'] ); ?></p>
																				<?php endif; ?>
																				<?php if ( ! empty( $info['data']['fifth'] ) ) : ?>
																					<p class="jt-typo--14"><?php echo do_shortcode( $info['data']['fifth'] ); ?></p>
																				<?php endif; ?>
																			</li>
																			<?php endforeach; ?>
																		</ul><!-- .product-single__proven-check-list -->

																		<?php if ( ! empty( $type_data['description'] ) ) : ?>
																			<p class="product-single__proven-caption jt-typo--15"><?php echo do_shortcode( $type_data['description'] ); ?></p>
																		<?php endif; ?>
																	</div><!-- .product-single__proven-vertical-content-inner -->
																</div><!-- .product-single__proven-vertical-content -->

																<div class="product-single__proven-vertical-img jt-motion--stagger-item">
																	<div class="product-single__proven-image">
																		<figure class="jt-lazyload" style="padding-top: 100%;">
																			<img width="902" height="902" data-unveil="<?php echo jt_get_image_src( $type_data['image']['pc'], 'jt_thumbnail_902' ); ?>" src="<?php echo get_stylesheet_directory_uri(); ?>/images/layout/blank.gif" alt="" />
																			<noscript><img src="<?php echo jt_get_image_src( $type_data['image']['pc'], 'jt_thumbnail_902' ); ?>" alt="" /></noscript>
																		</figure><!-- .jt-lazyload -->
																	</div><!-- .product-single__proven-image -->
																</div><!-- .product-single__proven-vertical-img -->
															</div><!-- .product-single__proven-vertical -->
														</div><!-- .product-single__proven-item -->
													<?php else : ?>
													<?php // 2개일때 ?>
														<div class="product-single__proven-item product-single__proven-item--secondary jt-motion--rise">
															<div class="product-single__proven-vertical">
																<div class="product-single__proven-vertical-content">
																	<?php if ( ! empty( $item['number'] ) ) : ?>
																		<span class="product-single__proven-count jt-typo--07" <?php echo ( ( $language === 'en-US' ) ) ? 'lang="en"' : ''; ?>><?php echo $item['number']; ?></span>
																	<?php endif; ?>

																	<div class="product-single__proven-vertical-slider swiper">
																		<div class="swiper-wrapper">
																			<?php foreach ( $item['type_2_data'] as $child ) : ?>
																				<div class="product-single__proven-vertical-content-inner swiper-slide">
																					<div class="product-single__proven-title-group">
																						<h2 class="product-single__proven-title jt-typo--04"><?php echo do_shortcode( $child['title'] ); ?></h2>
																						
																						<?php if ( ! empty( $child['sub_title'] ) ) : ?>
																							<span class="product-single__proven-subtitle jt-typo--10"><?php echo do_shortcode( $child['sub_title'] ); ?></span>
																						<?php endif; ?>
																					</div><!-- .product-single__proven-title-group -->
												
																					<div class="product-single__proven-image--small-wrap">
																						<div class="product-single__proven-image--small">
																							<figure class="jt-lazyload" style="padding-top: 100%;">
																								<img width="902" height="902" data-unveil="<?php echo jt_get_image_src( $child['image']['pc'], 'jt_thumbnail_902' ); ?>" src="<?php echo get_stylesheet_directory_uri(); ?>/images/layout/blank.gif" alt="" />
																								<noscript><img src="<?php echo jt_get_image_src( $child['image']['pc'], 'jt_thumbnail_902' ); ?>" alt="" /></noscript>
																							</figure><!-- .jt-lazyload -->
																						</div><!-- .product-single__proven-image--small -->
																						
																						<div class="swiper-navigation">
																							<div class="swiper-button swiper-button-prev">
																								<div class="jt-icon"><?php jt_icon( 'jt-chevron-left-tiny-2px-square' ); ?></div>
																								<span class="sr-only">PREV</span>
																							</div><!-- .swiper-button-prev -->
																		
																							<div class="swiper-button swiper-button-next">
																								<div class="jt-icon"><?php jt_icon( 'jt-chevron-right-tiny-2px-square' ); ?></div>
																								<span class="sr-only">NEXT</span>
																							</div><!-- .swiper-button-next -->
																						</div><!-- .swiper_navigation -->
																					</div><!-- .product-single__proven-image--small-wrap -->
												
																					<ul class="product-single__proven-check-list">
																						<?php foreach ( $child['data'] as $info ) : ?>
																						<li>
																							<i class="jt-icon"><?php jt_icon( 'jt-check' ); ?></i>
																							<h3 class="jt-typo--13"><?php echo do_shortcode( $info['content'] ); ?></h3>
																							
																							<?php if ( ! empty( $info['data']['first'] ) ) : ?>
																								<p class="jt-typo--14"><?php echo do_shortcode( $info['data']['first'] ); ?></p>
																							<?php endif; ?>
																							<?php if ( ! empty( $info['data']['second'] ) ) : ?>
																								<p class="jt-typo--14"><?php echo do_shortcode( $info['data']['second'] ); ?></p>
																							<?php endif; ?>
																							<?php if ( ! empty( $info['data']['thirdly'] ) ) : ?>
																								<p class="jt-typo--14"><?php echo do_shortcode( $info['data']['thirdly'] ); ?></p>
																							<?php endif; ?>
																							<?php if ( ! empty( $info['data']['fourth'] ) ) : ?>
																								<p class="jt-typo--14"><?php echo do_shortcode( $info['data']['fourth'] ); ?></p>
																							<?php endif; ?>
																							<?php if ( ! empty( $info['data']['fifth'] ) ) : ?>
																								<p class="jt-typo--14"><?php echo do_shortcode( $info['data']['fifth'] ); ?></p>
																							<?php endif; ?>
																						</li>
																						<?php endforeach; ?>
																					</ul><!-- .product-single__proven-check-list -->

																					<?php if ( ! empty( $child['description'] ) ) : ?>
																						<p class="product-single__proven-caption jt-typo--15"><?php echo do_shortcode( $child['description'] ); ?></p>
																					<?php endif; ?>
																				</div><!-- .product-single__proven-vertical-content-inner -->
																			<?php endforeach; ?>
																		</div><!-- .swiper-wrapper -->
																	</div><!-- .product-single__proven-vertical-slider -->

																	<div class="swiper-control">
																		<div class="swiper-pagination"></div>
										
																		<div class="swiper-navigation">
																			<div class="swiper-button swiper-button-prev">
																				<div class="jt-icon"><?php jt_icon( 'jt-chevron-left-tiny-2px-square' ); ?></div>
																				<span class="sr-only">PREV</span>
																			</div><!-- .swiper-button-prev -->
														
																			<div class="swiper-button swiper-button-next">
																				<div class="jt-icon"><?php jt_icon( 'jt-chevron-right-tiny-2px-square' ); ?></div>
																				<span class="sr-only">NEXT</span>
																			</div><!-- .swiper-button-next -->
																		</div><!-- .swiper_navigation -->
																	</div><!-- .swiper-control -->
																</div><!-- .product-single__proven-vertical-content -->

																<div class="product-single__proven-vertical-img">
																	<div class="product-single__proven-vertical-img-slider swiper">
																		<div class="swiper-wrapper">
																			<?php foreach ( $item['type_2_data'] as $child ) : ?>
																				<div class="product-single__proven-image swiper-slide">
																					<figure class="jt-lazyload" style="padding-top: 100%;">
																						<img width="902" height="902" data-unveil="<?php echo jt_get_image_src( $child['image']['pc'], 'jt_thumbnail_902' ); ?>" src="<?php echo get_stylesheet_directory_uri(); ?>/images/layout/blank.gif" alt="" />
																						<noscript><img src="<?php echo jt_get_image_src( $child['image']['pc'], 'jt_thumbnail_902' ); ?>" alt="" /></noscript>
																					</figure><!-- .jt-lazyload -->
																				</div><!-- .product-single__proven-image -->
																			<?php endforeach; ?>
																		</div><!-- .swiper-wrapper -->
																	</div><!-- .product-single__proven-vertical-img-slider.swiper -->
																</div><!-- .product-single__proven-vertical-img -->
															</div><!-- .product-single__proven-vertical -->
														</div><!-- .product-single__proven-item -->
													<?php endif; ?>
												<?php endif; ?>
											<?php endforeach; ?>
										</div><!-- .product-single__proven-item-wrap -->
									</div><!-- .product-single__proven -->
								<?php endif; ?>
							<?php elseif ( 'banner_text' === $acf_fc_layout ) : ?>
							<?php // 배너(텍스트) ?>
								<?php if ( $data['use'] ) : ?>
									<div class="product-single__txt-banner jt-motion--rise">
										<div class="wrap-middle">
											<i><?php jt_svg( '/images/sub/product/product-title-symbol.svg' ); ?></i>
											<h2 class="jt-typo--04" <?php echo ( ! empty( $data['us_title'] ) ) ? 'lang="en"' : ''; ?>><?php echo do_shortcode( $data['title'] ); ?></h2>
											<?php if ( 'on' === $data['sub_title_use'] ) : ?>
												<p class="jt-typo--13"><?php echo do_shortcode( $data['sub_title'] ); ?></p>
											<?php endif; ?>
										</div><!-- .wrap-middle -->
									</div><!-- .product-single__txt-banner -->
								<?php endif; ?>
							<?php elseif ( 'recycle' === $acf_fc_layout ) : ?>
							<?php // 배너(아이콘) ?>
								<?php if ( $data['use'] ) : ?>
									<div class="product-single__icon-banner jt-motion--rise">
										<figure class="jt-lazyload">
											<img width="72" height="72" data-unveil="<?php echo jt_get_image_src( $data['image'], 'jt_thumbnail_72x72' ); ?>" src="<?php echo get_stylesheet_directory_uri(); ?>/images/layout/blank.gif" alt="" />
											<noscript><img src="<?php echo jt_get_image_src( $data['image'], 'jt_thumbnail_72x72' ); ?>" alt="" /></noscript>
										</figure><!-- .jt-lazyload -->
										<b class="jt-typo--05" <?php echo ( ! empty( $data['us_title'] ) ) ? 'lang="en"' : ''; ?>><?php echo do_shortcode( $data['title'] ); ?></b>
										<?php if ( 'on' === $data['sub_title_use'] ) : ?>
											<p class="jt-typo--15"><?php echo do_shortcode( $data['sub_title'] ); ?></p>
										<?php endif; ?>
									</div><!-- .product-single__icon-banner -->
								<?php endif; ?>
							<?php elseif ( 'banner_image' === $acf_fc_layout ) : ?>
							<?php // 배너(이미지) ?>
								<?php if ( $data['use'] ) : ?>
									<?php
									$banner_pc_image		= jt_get_image_src( $data['image']['pc'], 'jt_thumbnail_580x430' );
									$pc_image_data			= wp_get_attachment_metadata( $data['image']['pc'] );

									$banner_mobile_image	= jt_get_image_src( $data['image']['mobile'], 'jt_thumbnail_716x716' );
									$mobile_image_data		= wp_get_attachment_metadata( $data['image']['mobile'] );
									?>
									<div class="product-single__img-banner jt-motion--rise">
										<div class="product-single__img-banner-content">
											<h2 class="jt-typo--04" <?php echo ( ! empty( $data['us_title'] ) ) ? 'lang="en"' : ''; ?>><?php echo do_shortcode( $data['title'] ); ?></h2>
											<?php if ( 'on' === $data['sub_title_use'] ) : ?>
												<p class="jt-typo--13"><?php echo do_shortcode( $data['sub_title'] ); ?></p>
											<?php endif; ?>
										</div>
										<div class="product-single__img-banner-photo">
											<div class="product-single__img-banner-photo--large">
												<figure class="jt-lazyload">
													<span class="jt-lazyload__color-preview"></span>
													<img width="<?php echo $pc_image_data['width']; ?>" height="<?php echo $pc_image_data['height']; ?>" data-unveil="<?php echo $banner_pc_image; ?>" src="<?php echo get_stylesheet_directory_uri(); ?>/images/layout/blank.gif" alt="" />
													<noscript><img src="<?php echo $banner_pc_image; ?>" alt="" /></noscript>
												</figure><!-- .jt-lazyload -->
											</div><!-- .product-single__img-banner-photo--large -->
											<div class="product-single__img-banner-photo--small">
												<figure class="jt-lazyload">
													<span class="jt-lazyload__color-preview"></span>
													<img width="<?php echo $mobile_image_data['width']; ?>" height="<?php echo $mobile_image_data['height']; ?>" data-unveil="<?php echo $banner_mobile_image; ?>" src="<?php echo get_stylesheet_directory_uri(); ?>/images/layout/blank.gif" alt="" />
													<noscript><img src="<?php echo $banner_mobile_image; ?>" alt="" /></noscript>
												</figure><!-- .jt-lazyload -->
											</div><!-- .product-single__img-banner-photo--small -->
										</div><!-- .product-single__img-banner-photo -->
									</div><!-- .product-single__img-banner -->
								<?php endif; ?>
							<?php elseif ( 'ritual' === $acf_fc_layout ) : ?>
							<?php // 루틴제품 ?>	
								<?php if ( $data['use'] ) : ?>
									<div class="product-single__ritual">
										<?php if ( ! empty( $data['title'] ) ) : ?>
											<div class="product-single__component-title jt-motion--appear">
												<div class="wrap-middle">
													<i><?php jt_svg( '/images/sub/product/product-title-symbol.svg' ); ?></i>
													<h2 class="jt-typo--03" lang="en"><?php echo do_shortcode( $data['title'] ); ?></h2>

													<?php if ( 'on' === $data['sub_title_use'] ) : ?>
														<p class="jt-typo--13"><?php echo do_shortcode( $data['sub_title'] ); ?></p>
													<?php endif; ?>
												</div><!-- .wrap-middle -->
											</div><!-- .product-single__component-title -->
										<?php endif; ?>

										<div class="product-single__ritual-step jt-motion--rise jt-motion--rise-small">
											<ul class="product-single__ritual-list jt-motion--stagger jt-motion--stagger-large">
												<?php foreach ( $data['data'] as $idx => $item ) : ?>
													<li class="product-single__ritual-item jt-motion--stagger-item" style="background: <?php echo $background; ?>;">
														<a class="product-single__ritual-link" href="<?php the_permalink( $item['product'] ); ?>">
															<b class="product-single__ritual-num jt-typo--13" lang="en"><?php _e( 'Step ' . ( $idx + 1 ), 'jt' ); ?></b>

															<div class="product-single__ritual-image">
																<figure class="jt-lazyload">
																	<img width="240" height="240" data-unveil="<?php echo jt_get_image_src( get_field( 'product_data_basic_thumbnail_routin', $item['product'] ), 'jt_thumbnail_480x480' ); ?>" alt="" />
																	<noscript><img src="<?php echo jt_get_image_src( get_field( 'product_data_basic_image_routin', $item['product'] ), 'jt_thumbnail_480x480' ); ?>" alt="" /></noscript>
																</figure><!-- .jt-lazyload -->
															</div><!-- .product-single__ritual-image -->
															<span class="product-single__ritual-cat jt-typo--06"><?php echo $item['category']; ?></span>
															<h3 class="product-single__ritual-name">
																<span class="jt-typo--14"><?php echo do_shortcode( get_field( 'product_data_basic_title', $item['product'] ) ); ?></span>
																<?php /* <i class="jt-icon"><?php jt_icon( 'jt-arrow-up-right-secondary' ); ?></i> */ ?>
															</h3>
														</a><!-- .product-single__ritual-link -->
													</li><!-- .product-single__ritual-item -->
												<?php endforeach; ?>
											</ul><!-- .product-single__ritual-list -->
										</div><!-- .product-single__ritual-step -->
									</div><!-- .product-single__ritual -->
								<?php endif; ?>
							<?php elseif ( 'review' === $acf_fc_layout ) : ?>
							<?php // 리뷰 ?>
								<?php if ( $data['use'] ) : ?>
									<div class="product-single__epilogue">
										<div class="wrap-small">
											<div class="product-single__epilogue-inner">
												<div class="product-single__review">
													<div class="product-single__epilogue-title">
														<h2 class="jt-typo--04" lang="en"><?php _e( 'Review', 'jt' ); ?></h2>
													</div><!-- .product-single__epilogue-title -->

													<ul class="product-single__review-list">
														<?php foreach ( $data['data'] as $item ) : ?>
															<li>
																<span class="product-single__review-rate">
																	<span class="sr-only"><?php echo $item['score']; ?></span>
																	<i style="width: <?php echo ( (float) $item['score'] ) * 20; ?>%;"></i>
																</span><!-- .product-single__review-rate -->
																<b class="product-single__review-content jt-typo--13"><?php echo do_shortcode( $item['content'] ); ?></b>
																<p class="product-single__review-source jt-typo--16"><?php echo do_shortcode( $item['source'] ); ?></p>
															</li>
														<?php endforeach; ?>
													</ul><!-- .product-single__review-list -->
												</div><!-- .product-single__review -->
											</div><!-- .product-single__epilogue-inner -->
										</div><!-- .wrap-small -->
									</div><!-- .product-single__epilogue -->
								<?php endif; ?>
							<?php elseif ( 'info' === $acf_fc_layout ) : ?>
							<?php // 전성분 ?>
								<?php if ( $data['use'] ) : ?>
									<div class="product-single__epilogue">
										<div class="wrap-small">
											<div class="product-single__epilogue-inner">
												<div class="product-single__abstract">
													<div class="product-single__epilogue-title">
														<h2 class="jt-typo--04" lang="en"><?php _e( 'Product Information', 'jt' ); ?></h2>
													</div><!-- .product-single__epilogue-title -->

													<table class="product-single__abstract-data">
														<?php foreach ( $data['data'] as $item ) : ?>
															<tr>
																<th class="jt-typo--14"><?php echo do_shortcode( $item['title'] ); ?></th>
																<td class="jt-typo--14"><?php echo do_shortcode( $item['content'] ); ?></td>
															</tr>
														<?php endforeach; ?>
													</table><!-- .product-single__abstract-data -->
												</div><!-- .product-single__abstract -->
											</div><!-- .product-single__epilogue-inner -->
										</div><!-- .wrap-small -->
									</div><!-- .product-single__epilogue -->
								<?php endif; ?>
							<?php endif; ?>
						<?php endforeach; ?>
					</div><!-- .product-single__component -->
				<?php else : ?>
					
					<?php // 제품상세 없는 페이지 노출 ?>
					<div class="product-single__nothing">
						<p class="jt-typo--10"><?php _e( 'Website is being updated.', 'jt' ); ?></p>
					</div><!-- .product-single__nothing -->

				<?php endif;?>
			</div><!-- .wrap -->
		</div><!-- .product-single -->

		<div class="product-single-dialog">
			<div class="product-single-dialog__container">
				<div class="product-single-dialog__content">
					<h2 class="product-single-dialog__title jt-typo--06" lang="en"><?php _e( 'Shop Now', 'jt' ); ?></h2>

					<div class="product-single-dialog__content-inner">
						<ul class="product-single__shopnow">
							<?php foreach ( $link as $item ) : ?>
								<li class="product-single__shopnow--<?php echo strtolower( str_replace( ' ', '', $item['icon'] ?? 'etc' ) ); ?>">
									<?php if ( $item['use_platform'] ) : ?>
										<a href="<?php echo $item['link']; ?>" class="product-single__shopnow-primary" target="_blank" rel="noopener">
											<span class="jt-typo--13" lang="en"><?php echo $item['platform']; ?></span>
											<i class="jt-icon"><?php jt_icon( 'jt-arrow-up-right-secondary' ); ?></i>
										</a>
									<?php else : ?>
										<div class="product-single__shopnow-primary">
											<span class="jt-typo--13" lang="en"><?php echo $item['platform']; ?></span>
										</div><!-- .product-single__shopnow-primary -->

										<ul class="product-single__shopnow-secondary">
											<?php foreach ( $item['platforms'] as $child ) : ?>
												<li>
													<a href="<?php echo $child['link']; ?>" target="_blank" rel="noopener">
														<span class="jt-typo--14" lang="en"><?php echo $child['name']; ?></span>
														<i class="jt-icon"><?php jt_icon( 'jt-arrow-up-right-secondary' ); ?></i>
													</a>
												</li>
											<?php endforeach; ?>
										</ul><!-- .product-single__shopnow-secondary -->
									<?php endif; ?>
								</li>
							<?php endforeach; ?>
						</ul>
					</div><!-- .product-single-dialog__content-inner -->

					<button class="product-single-dialog__close">
						<i class="jt-icon"><?php jt_icon( 'jt-close-small-2px' ); ?></i>
					</button><!-- .product-single-dialog__close -->
				</div><!-- .product-single-dialog__content -->
			</div><!-- .product-single-dialog__container -->
		</div><!-- .product-single-dialog -->

	<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>
