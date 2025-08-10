<?php
/**
* Template Name: Create me
*/
?>
<?php get_header(); ?>

<?php if ( have_posts() ) : ?>
	<?php
	while ( have_posts() ) :
		the_post();

        $createme_data = get_field( 'createme', 'option' );
		?>
		<div class="article article--createme">
			<div class="article__header article__header--visual">
				<div class="article__visual jt-full-h">
					<div class="article__visual-bg article__visual-bg--large" style="background-image:url('<?php echo jt_get_image_src( $createme_data['background']['pc'], 'jt_thumbnail_1903x954' ); ?>')"></div>
					<div class="article__visual-bg article__visual-bg--small" style="background-image:url('<?php echo jt_get_image_src( $createme_data['background']['mobile'], 'jt_thumbnail_780x1294' ); ?>')"></div>
					
					<div class="article__visual-content">
						<div class="wrap">
							<h1 class="article__visual-title jt-typo--02" lang="en"><?php _e( 'Purito Seoul’s <br class="smbr" />Create Me', 'jt' ); ?></h1>
							<p class="article__visual-desc jt-typo--13"><?php _e( 'Create Me is a project that embodies our commitment <br /> to actively listen to our community. <br /> This project provides a unique opportunity for our cherished <br />Purito Seoul community to participate and play a key role in shaping <br />our latest skincare creations. By reflecting their diverse voices, <br />we collaborate to introduce products that are finely tailored <br />to meet your community needs.', 'jt' ); ?></p>
						</div><!-- .wrap -->
					</div><!-- .article__visual-content -->

					<a class="scroll-down" href="#scroll-down-target">
						<i class="jt-icon">
							<?php jt_svg( '/images/layout/scroll-down-arrow-small.svg' ); ?>
						</i>
					</a>
				</div><!-- .article__visual -->
			</div><!-- .article__header -->

			<div class="article__body">
				<div class="wrap">

					<div class="createme-section createme-how">
						<h2 class="createme-section__title jt-typo--04 jt-motion--appear"><?php _e( 'How Do <br /> We Create Together?', 'jt' ); ?></h2>
						
						<div class="createme-how__list-container">
							<div class="createme-how__list-slider swiper">
								<div class="createme-how__list swiper-wrapper">
									<div class="createme-how__list-item swiper-slide">
										<div class="createme-how__list-thumb">
											<div class="jt-background-video">
												<div class="jt-background-video__vod" data-jt-lazy="<?php echo get_stylesheet_directory_uri(); ?>/video/createme-how-vid-01.mp4"></div>
												<div class="jt-background-video__poster" style="background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/sub/createme/createme-how-thumb-01.jpg)"></div>
											</div><!-- .jt-background-video -->
										</div>
										<div class="createme-how__list-content">
											<span class="createme-how__list-num jt-typo--08">1</span>
											<p class="createme-how__list-title jt-typo--06"><?php _e( 'Brainstorm', 'jt' ); ?></p>
										</div><!-- .createme-how__list-content -->
									</div><!-- .createme-how__list-item -->

									<div class="createme-how__list-item swiper-slide">
										<div class="createme-how__list-thumb">
											<div class="jt-background-video">
                                                <div class="jt-background-video__vod" data-jt-lazy="<?php echo get_stylesheet_directory_uri(); ?>/video/createme-how-vid-02.mp4"></div>
												<div class="jt-background-video__poster" style="background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/sub/createme/createme-how-thumb-02.jpg)"></div>
											</div><!-- .jt-background-video -->
										</div>
										<div class="createme-how__list-content">
											<span class="createme-how__list-num jt-typo--08">2</span>
											<p class="createme-how__list-title jt-typo--06"><?php _e( 'Community <br />Surveys', 'jt' ); ?></p>
										</div><!-- .createme-how__list-content -->
									</div><!-- .createme-how__list-item -->

									<div class="createme-how__list-item swiper-slide">
										<div class="createme-how__list-thumb">
											<div class="jt-background-video">
												<div class="jt-background-video__vod" data-jt-lazy="<?php echo get_stylesheet_directory_uri(); ?>/video/createme-how-vid-03.mp4"></div>
												<div class="jt-background-video__poster" style="background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/sub/createme/createme-how-thumb-03.jpg)"></div>
											</div><!-- .jt-background-video -->
										</div>
										<div class="createme-how__list-content">
											<span class="createme-how__list-num jt-typo--08">3</span>
											<p class="createme-how__list-title jt-typo--06"><?php _e( 'Name &amp; <br />Packaging Voting', 'jt' ); ?></p>
										</div><!-- .createme-how__list-content -->
									</div><!-- .createme-how__list-item -->

									<div class="createme-how__list-item swiper-slide">
										<div class="createme-how__list-thumb">
											<div class="jt-background-video">
                                                <div class="jt-background-video__vod" data-jt-lazy="<?php echo get_stylesheet_directory_uri(); ?>/video/createme-how-vid-04.mp4"></div>
												<div class="jt-background-video__poster" style="background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/sub/createme/createme-how-thumb-04.jpg)"></div>
											</div><!-- .jt-background-video -->
										</div>
										<div class="createme-how__list-content">
											<span class="createme-how__list-num jt-typo--08">4</span>
											<p class="createme-how__list-title jt-typo--06"><?php _e( 'Sample <br />Creation', 'jt' ); ?></p>
										</div><!-- .createme-how__list-content -->
									</div><!-- .createme-how__list-item -->

									<div class="createme-how__list-item swiper-slide">
										<div class="createme-how__list-thumb">
											<div class="jt-background-video">
												<div class="jt-background-video__vod" data-jt-lazy="<?php echo get_stylesheet_directory_uri(); ?>/video/createme-how-vid-05.mp4"></div>
												<div class="jt-background-video__poster" style="background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/sub/createme/createme-how-thumb-05.jpg)"></div>
											</div><!-- .jt-background-video -->
										</div>
										<div class="createme-how__list-content">
											<span class="createme-how__list-num jt-typo--08">5</span>
											<p class="createme-how__list-title jt-typo--06"><?php _e( 'Community <br />Sampling', 'jt' ); ?></p>
										</div><!-- .createme-how__list-content -->
									</div><!-- .createme-how__list-item -->

									<div class="createme-how__list-item swiper-slide">
										<div class="createme-how__list-thumb">
											<div class="jt-background-video">
                                                <div class="jt-background-video__vod" data-jt-lazy="<?php echo get_stylesheet_directory_uri(); ?>/video/createme-how-vid-06.mp4"></div>
												<div class="jt-background-video__poster" style="background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/sub/createme/createme-how-thumb-06.jpg)"></div>
											</div><!-- .jt-background-video -->
										</div>
										<div class="createme-how__list-content">
											<span class="createme-how__list-num jt-typo--08">6</span>
											<p class="createme-how__list-title jt-typo--06"><?php _e( 'Evaluation &amp; <br />Refining', 'jt' ); ?></p>
										</div><!-- .createme-how__list-content -->
									</div><!-- .createme-how__list-item -->

									<div class="createme-how__list-item swiper-slide">
										<div class="createme-how__list-thumb">
											<div class="jt-background-video">
												<div class="jt-background-video__vod" data-jt-lazy="<?php echo get_stylesheet_directory_uri(); ?>/video/createme-how-vid-07.mp4"></div>
												<div class="jt-background-video__poster" style="background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/sub/createme/createme-how-thumb-07.jpg)"></div>
											</div><!-- .jt-background-video -->
										</div>
										<div class="createme-how__list-content">
											<span class="createme-how__list-num jt-typo--08">7</span>
											<p class="createme-how__list-title jt-typo--06"><?php _e( 'Manufacturing', 'jt' ); ?></p>
										</div><!-- .createme-how__list-content -->
									</div><!-- .createme-how__list-item -->

									<div class="createme-how__list-item swiper-slide">
										<div class="createme-how__list-thumb">
											<div class="jt-background-video">
												<div class="jt-background-video__vod" data-jt-lazy="<?php echo get_stylesheet_directory_uri(); ?>/video/createme-how-vid-08.mp4"></div>
												<div class="jt-background-video__poster" style="background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/sub/createme/createme-how-thumb-08.jpg)"></div>
											</div><!-- .jt-background-video -->
										</div>
										<div class="createme-how__list-content">
											<span class="createme-how__list-num jt-typo--08">8</span>
											<p class="createme-how__list-title jt-typo--06"><?php _e( 'Product <br />Launch', 'jt' ); ?></p>
										</div><!-- .createme-how__list-content -->
									</div><!-- .createme-how__list-item -->
								</div><!-- .createme-how__list -->

								<div class="swiper-navigation">
									<div class="swiper-button swiper-button-prev">
										<div class="jt-icon"><?php jt_icon( 'jt-chevron-left-smaller-2px-square' ); ?></div>
										<span class="sr-only"><?php _e( 'PREV', 'jt' ); ?></span>
									</div><!-- .swiper-button-prev -->
									
									<div class="swiper-button swiper-button-next">
										<div class="jt-icon"><?php jt_icon( 'jt-chevron-right-smaller-2px-square' ); ?></div>
										<span class="sr-only"><?php _e( 'NEXT', 'jt' ); ?></span>
									</div><!-- .swiper-button-next -->
								</div><!-- .swiper_navigation -->
							</div><!-- .createme-how__list-slider -->
						</div><!-- .createme-how__list-container -->

						<div class="createme-how__amount">
							<b class="createme-how__amount-num jt-scramble-txt"><?php echo $createme_data['participants']['number']; ?>+</b>
							<p class="createme-how__amount-txt <?php echo jt_is_lang( 'en' ) ? 'jt-typo--06' : 'jt-typo--07' ?>"><?php echo do_shortcode( $createme_data['participants']['description'] ); ?></p>
						</div><!-- .createme-how__amount -->
					</div><!-- .createme-section -->

					<div class="createme-section createme-why">
						<h2 class="createme-section__title jt-typo--04 jt-motion--appear"><?php _e( 'Why Do We Do It?', 'jt' ); ?></h2>
						<p class="createme-section__desc jt-typo--13 jt-motion--appear"><?php _e( 'In the Purito Seoul community, <br class="smbr" />our shared values guide our joint <br class="smbr" />exploration <br />towards glowing beauty. <br class="smbr" />With a customer-first philosophy, <br class="smbr" />we create products <br />that truly <br class="smbr" />resonate with your desires <br class="smbr" />and needs. By joining forces <br class="smbr" />with our <br />community, we create <br class="smbr" />with the power of YOUR voice!', 'jt' ); ?></p>
						<figure class="createme-why__img jt-lazyload jt-motion--rise">
							<span class="jt-lazyload__color-preview"></span>
							<img width="1820" height="980" data-unveil="<?php echo get_stylesheet_directory_uri(); ?>/images/sub/createme/createme-why-01.jpg" src="<?php echo get_stylesheet_directory_uri(); ?>/images/layout/blank.gif" alt="" />
							<noscript><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/sub/createme/createme-why-01.jpg" alt="" /></noscript>
						</figure>
					</div><!-- .createme-section -->

					<div class="createme-section createme-past">
						<h2 class="createme-section__title jt-typo--04 jt-motion--appear"><?php _e( 'Our Past <br /> Create Me Products', 'jt' ); ?></h2>

						<div class="createme-past__series">
							<?php echo do_shortcode( '[series num="5"]' ); ?>
						</div>
					</div><!-- .createme-section -->

					<div class="createme-join jt-motion--rise">
						<h2 class="createme-section__title jt-typo--04"><?php _e( 'Join the Purito Seoul Community', 'jt' ); ?></h2>
						<p class="createme-section__desc jt-typo--13"><?php _e( 'Follow us on social media for news about our future projects.', 'jt' ); ?></p>
                        <div class="createme-join__btn-wrap">
                            <a class="createme-join__btn" href="https://www.instagram.com/purito_official/" target="_blank" rel="noopener">
                                <i class="jt-icon"><?php jt_icon( 'jt-instagram' ); ?></i>
                                <span class="jt-typo--08" lang="en">purito_official</span>
                            </a>
                            <a class="createme-join__btn" href="https://www.tiktok.com/@purito_official" target="_blank" rel="noopener">
                                <i class="jt-icon"><?php jt_icon( 'jt-tiktok' ); ?></i>
                                <span class="jt-typo--08" lang="en">purito_official</span>
                            </a>
                        </div><!-- .createme-join__btn-wrap -->
					</div><!-- .createme-join -->

				</div><!-- .wrap -->
			</div><!-- .article__body -->
		</div><!-- .article -->

	<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>
