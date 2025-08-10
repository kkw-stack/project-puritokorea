<?php
/**
 * Template Name: Stores Online
 */
?>

<?php get_header(); ?>

<?php if ( have_posts() ) : ?>
	<?php
	while ( have_posts() ) :
		the_post();

		$online_store_data = get_field( 'online_store', 'options' );
		?>
		<div class="article stores">
			<div class="article__header">
				<div class="wrap">
					<h1 class="article__title jt-typo--02 jt-motion--appear" lang="en"><?php _e( 'Stores', 'jt' ); ?></h1>
					<p class="article__desc jt-typo--13 jt-motion--appear"><?php _e( 'Purito Seoul products can be purchased anywhere across <br />the world through any of our international partners.', 'jt' ); ?></p>
				</div><!-- .wrap -->
			</div><!-- .article__header -->

			<div class="article__body">
				<div class="wrap">
                    <ul class="stores-tabs jt-motion--rise">
						<li class="stores-tabs--active"><a class="jt-typo--14" lang="en" href="<?php bloginfo('url'); ?>/help/stores/online/"><?php _e( 'Online', 'jt' ); ?></a></li>
						<li><a class="jt-typo--14" lang="en" href="<?php bloginfo('url'); ?>/help/stores/offline/"><?php _e( 'Offline', 'jt' ); ?></a></li>
					</ul><!-- .stores-tabs -->

					<div class="stores-online jt-motion--rise jt-motion--rise-small">
						<?php foreach ( $online_store_data as $key => $items ) : ?>
							<?php if ( ! empty( $items ) && is_array( $items ) ) : ?>
								<div class="stores-online-continent jt-motion--rise jt-motion--rise-large">
									<h2 class="stores-online-continent__title jt-typo--05" lang="en"><?php echo ucwords( str_replace( '_', ' ', $key ) ); ?></h2>

									<ul class="stores-online-continent__list">
										<?php foreach ( $items as $item ) : ?>
											<li class="stores-online-continent__item">
												<h3 class="stores-online-nation__title jt-typo--13" lang="en">
													<?php if ( ! empty( $item['link'] ) ) : ?>
														<a class="stores-online__link" href="<?php echo $item['link']; ?>" target="_blank" rel="noopener noreferrer">
															<span><?php echo $item['nation']; ?></span>
															<i class="jt-icon"><?php jt_icon( 'jt-arrow-up-right' ); ?></i>
														</a><!-- .stores-online__link -->
													<?php else : ?>
														<span><?php echo $item['nation']; ?></span>
													<?php endif; ?>
												</h3>
												<?php if ( ! empty( $item['store'] ) && is_array( $item['store'] ) ) : ?>
													<ul class="stores-online-nation__list">
														<?php foreach ( $item['store'] as $store ) : ?>
															<li class="stores-online-nation__item">
																<?php if ( ! empty( $store['link'] ) ) : ?>
																	<a class="stores-online__link" href="<?php echo $store['link']; ?>" target="_blank" rel="noopener noreferrer">
																		<span class="jt-typo--14" lang="en"><?php echo $store['store']; ?></span>
																		<i class="jt-icon"><?php jt_icon( 'jt-arrow-up-right' ); ?></i>
																	</a><!-- .stores-online__link -->
																<?php else : ?>
																	<span><?php echo $store['store']; ?></span>
																<?php endif; ?>
															</li><!-- .stores-online-nation__item -->
														<?php endforeach; ?>
													</ul><!-- .stores-online-nation__list -->
												<?php endif; ?>
											</li><!-- .stores-online-continent__item -->
										<?php endforeach; ?>
									</ul><!-- .stores-online-continent__list -->
								</div><!-- .stores-online-continent -->
							<?php endif; ?>
						<?php endforeach; ?>
					</div><!-- .stores-online -->
				</div><!-- .wrap -->
			</div><!-- .article__body -->
		</div><!-- .article -->
	<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>
