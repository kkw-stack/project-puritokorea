<?php
$search_type = esc_attr( $_GET['search_type'] );
$search_text = esc_attr( $_GET['s'] );

$current_url = preg_replace( '/\/ko\/(ko\/)+/', '/ko/', home_url( $_SERVER['REQUEST_URI'] ) );

$option        = get_field( 'common_settings_product', 'option' );
$banner_option = $option['banner'];
$background    = $option['background'];

$num   = (int) ( $wp_query->query_vars['posts_per_page'] ?? get_option( 'posts_per_page' ) );
$paged = max( 1, intVal( get_query_var( 'paged' ) ) );

get_header();
?>

<div class="article">
	<div class="article-body">
		<h1 class="sr-only">검색결과</h1>

		<div class="search-result-form-wrap">
			<div class="wrap-small">
				<form id="search-result-form" class="search-result-form active" action="<?php echo ( function_exists( 'icl_get_home_url' ) ? icl_get_home_url() : home_url( '/' ) ); ?>" autocomplete="off">
					<input name="search_type" type="hidden" value="product" />
					<div class="search-result-form__field-wrap">
						<input name="s" type="text" id="search-result-form__field" class="search-result-form__field" value="<?php echo $search_text; ?>" />
						<button type="button" class="search-result-form__reset" tabindex="-1">
							<span class="sr-only"><?php _e( 'reset' ); ?></span>
							<i class="jt-icon"><?php jt_icon( 'jt-close-mini-2px' ); ?></i>
						</button>
						<button type="submit" class="search-result-form__submit">
							<span class="sr-only"><?php _e( 'search' ); ?></span>
							<i class="jt-icon"><?php jt_icon( 'jt-search-secondary' ); ?></i>
						</button>
					</div><!-- .search-result-form__field-wrap -->
				</form><!-- .search-result__form -->
			</div><!-- .wrap-small -->
		</div><!-- .search-result-form-wrap -->

		<div class="search-result">
			<div class="jt-category-nav-wrap">
				<div class="jt-category-nav">
					<ul>
						<li class="<?php echo ( 'community' !== $search_type ? 'jt-category--active' : '' ); ?>">
							<a href="<?php echo add_query_arg( 'search_type', 'product', $current_url ); ?>" lang="en">
								<span>Product</span>
							</a>
						</li>
						<li class="<?php echo ( 'community' === $search_type ? 'jt-category--active' : '' ); ?>">
							<a href="<?php echo add_query_arg( 'search_type', 'community', $current_url ); ?>" lang="en">
								<span>Community</span>
							</a>
						</li>
					</ul>
				</div><!-- .jt-category-nav -->
			</div><!-- .jt-category-nav-wrap -->
			
			<?php if ( have_posts() ) : ?>
				<div class="wrap">
					<div class="search-result__info">
						<p class="jt-typo--14">
							<span class="search-result__info-txt--pc"><?php printf( __( '<span>%1$s</span> Results found for “%2$s”', 'jt' ), $wp_query->found_posts, $search_text ); ?></span>
							<span class="search-result__info-txt--mo"><?php printf( __( '<span>%1$s</span> Results', 'jt' ), $wp_query->found_posts, $search_text ); ?></span>
						</p>
					</div><!-- .search-result__info -->

					<?php if ( 'community' !== $search_type ) : ?>
					<div class="search-result__sorting">
						<div class="jt-choices__wrap">
							<select class="jt-choices" name="sort">
								<option value="<?php echo remove_query_arg( 'sort', $current_url ); ?>"><?php _e( 'Latest', 'jt' ); ?></option>
								<option value="<?php echo add_query_arg( 'sort', 'popularity', $current_url ); ?>" <?php selected( $_GET['sort'] ?? '', 'popularity' ); ?>><?php _e( 'Popularity', 'jt' ); ?></option>
							</select><!-- .jt-choices -->
						</div><!-- .jt-choices__wrap -->
					</div><!-- .search-result__sorting -->
					<?php endif; ?>

					<div class="search-result__list">
						<ul class="<?php echo ( 'community' === $search_type ) ? 'jt-newspress-list' : 'global-product-list global-product-list--grid'; ?>">
							<?php
							while ( have_posts() ) :
								the_post();
								?>
								<?php if ( 'community' !== $search_type ) : ?>
									<?php
									$product_data = get_field( 'product_data_basic' );
									$thumbnail    = jt_get_image_src( $product_data['thumbnail']['list'], 'jt_thumbnail_1192x1192' );
									?>
									<li class="global-product-list__item" style="background: <?php echo $background; ?>;">
										<?php if ( $product_data['use_outlink'] ) : ?>
											<a class="global-product-list__link" href="<?php echo $product_data['outlink']; ?>" target="_blank" rel="noopener">
												<div class="global-product-list__bg" data-unveil="<?php echo jt_get_image_src( $product_data['thumbnail']['hover'], 'jt_thumbnail_596x840' ); ?>"></div>

												<div class="global-product-list__img-wrap">
													<img loading="lazy" width="596" height="596" src="<?php echo $thumbnail; ?>" alt="" />
												</div>

												<div class="global-product-list__content">
													<h2 class="global-product-list__title jt-typo--13"><?php echo $product_data['title']; ?></h2>
													<span class="global-product-list__detail jt-typo--16"><?php echo $product_data['price']; ?></span>
												</div>
												<i class="global-product-list__outlink-icon"><?php jt_svg( '/images/icon/jt-outlink.svg' ); ?></i>
											</a>
										<?php else : ?>
											<a class="global-product-list__link" href="<?php the_permalink(); ?>">
												<div class="global-product-list__bg" data-unveil="<?php echo jt_get_image_src( $product_data['thumbnail']['hover'], 'jt_thumbnail_596x840' ); ?>"></div>

												<div class="global-product-list__img-wrap">
													<img loading="lazy" width="596" height="596" src="<?php echo $thumbnail; ?>" alt="" />
												</div>

												<div class="global-product-list__content">
													<h2 class="global-product-list__title jt-typo--13"><?php echo $product_data['title']; ?></h2>
													<span class="global-product-list__detail jt-typo--16"><?php echo $product_data['options'][0]['price']; ?></span>
												</div>

												<?php if ( ! empty( $product_data['category']['label'] ) ) : ?>
													<div class="global-product-list__label">
														<?php foreach ( $product_data['category']['label'] as $idx => $item ) : ?>
															<span class="global-product-list__label--<?php echo $item->slug; ?> jt-typo--14" lang="en"><?php _e( $item->name, 'jt' ); ?></span>
														<?php endforeach; ?>
													</div><!-- .global-product-list__label -->
												<?php endif; ?>
											</a>
										<?php endif; ?>
									</li>
								<?php else : ?>
								<?php
								$terms = wp_get_post_terms( get_the_ID(), 'newspress_categories' );
								$newspress_data = get_field( 'newspress' );
								$thumbnail = jt_get_image_src( $newspress_data['thumbnail'], 'jt_thumbnail_443x443' );
								?>
									<li class="jt-newspress-list__item">
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
												<time class="jt-newspress-list__date jt-typo--15" datetime="<?php echo get_the_time( 'Y-m-d' ); ?>" lang="en"><?php echo get_the_time( 'F d, Y' ); ?></time>
											</div><!-- .jt-newspress-list__content -->
										</a><!-- .jt-newspress-list__link -->
									</li><!-- .jt-newspress-list__item -->
								<?php endif; ?>
							<?php endwhile; ?>
							<?php wp_reset_postdata(); ?>
						</ul>
					</div><!-- .search-result__product-list -->

					<?php if ( $wp_query->max_num_pages > $paged ) : ?>
						<div id="jt-loadmore" class="jt-loadmore">
							<a class="jt-loadmore__btn" href="<?php echo get_pagenum_link( $paged + 1 ); ?>" data-loadmore-list="<?php echo ( 'product' === $search_type ? '.global-product-list' : '.jt-newspress-list' ); ?>">
								<span><?php _e( 'Load more', 'jt' ); ?><span class="jt-loadmore__count"><?php echo $wp_query->found_posts - ( $num * ( $paged ) ); ?></span></span>
								<div class="jt-loadmore__spinner">
									<div class="jt-loadmore__spinner_ball_01"></div>
									<div class="jt-loadmore__spinner_ball_02"></div>
									<div class="jt-loadmore__spinner_ball_03"></div>
								</div>
							</a>
						</div><!-- .jt-loadmore -->
					<?php endif; ?>
				</div><!-- .wrap -->
			<?php else : ?>
				<div class="search-result__nothing">
					<div class="wrap">
						<b class="search-result__nothing-title jt-typo--05"><?php printf( __( 'No Results Found for <br/>“<span>%s</span>”', 'jt' ), $search_text ); ?></b>
						<p class="search-result__nothing-desc jt-typo--14"><?php _e( 'Please try again later or enter a new search', 'jt' ); ?></p>
					</div><!-- .wrap -->
				</div><!-- .search-result__nothing -->

				<div class="search-result__recommend">
					<div class="wrap">
						<h2 class="search-result__recommend-title jt-typo--04"><?php _e( 'Recommended Products', 'jt' ); ?></h2>

						<div class="search-result__recommend-list global-product-list-wrap ">
							<div class="global-product-list col-4 swiper jt-motion--stagger">
								<div class="swiper-wrapper">
									<?php foreach ( get_field( 'common_settings_search_product_no_search_exposure', 'option' ) as $item ) : ?>
										<?php
										$no_search_product_data = get_field( 'product_data_basic', $item );
										$product_background     = get_field( 'common_settings_product_background', 'option' );
										?>
										<div class="global-product-list__item swiper-slide jt-motion--stagger-item" style ="<?php echo ( ! empty( $product_background ) ? 'background:' . $product_background : '' ); ?>">
											<a class="global-product-list__link" href="<?php echo ( ! empty( $no_search_product_data['use_outlink'] ) ? $no_search_product_data['outlink'] : get_permalink( $item ) ); ?>">
												<div class="global-product-list__bg" data-unveil="<?php echo jt_get_image_src( $no_search_product_data['thumbnail']['hover'], 'jt_thumbnail_596x840' ); ?>"></div>

												<div class="global-product-list__bg--mo"></div>

												<div class="global-product-list__img-wrap jt-lazyload">
													<img width="1192" height="1192" data-unveil="<?php echo jt_get_image_src( $no_search_product_data['thumbnail']['list'], 'jt_thumbnail_1192x1192' ); ?>" src="<?php echo get_stylesheet_directory_uri(); ?>/images/layout/blank.gif" alt="" />
													<noscript><img src="<?php echo jt_get_image_src( $no_search_product_data['thumbnail']['list'], 'jt_thumbnail_1192x1192' ); ?>>" alt="" /></noscript>
												</div>

												<div class="global-product-list__content">
													<h4 class="global-product-list__title jt-typo--14"><?php echo $no_search_product_data['title']; ?></h4>
													<span class="global-product-list__detail jt-typo--16"><?php echo ( ! empty( $no_search_product_data['use_outlink'] ) ? $no_search_product_data['price'] : $no_search_product_data['options'][0]['price'] ); ?></span>
												</div>
											</a>
										</div><!-- .global-product-list__item -->
									<?php endforeach; ?>
								</div><!-- .swiper-wrapper -->

								<div class="swiper-navigation">
									<div class="swiper-button swiper-button-prev">
										<div class="jt-icon"><?php jt_icon( 'jt-chevron-left-smaller-2px-square' ); ?></div>
										<span class="sr-only">PREV</span>
									</div><!-- .swiper-button-prev -->

									<div class="swiper-button swiper-button-next">
										<div class="jt-icon"><?php jt_icon( 'jt-chevron-right-smaller-2px-square' ); ?></div>
										<span class="sr-only">NEXT</span>
									</div><!-- .swiper-button-next -->
								</div><!-- .swiper_navigation -->
							</div><!-- global-product-list -->

							<div class="swiper-pagination"></div>
						</div><!-- .search-result__recommend-list.global-product-list-wrap -->
					</div><!-- .wrap -->
				</div><!-- .search-result__recommend -->
			<?php endif; ?>
		</div><!-- .search-result -->
	</div><!-- .article-body -->
</div><!-- .article -->

<?php get_footer(); ?>
