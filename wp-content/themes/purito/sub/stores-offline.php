<?php
  /**
    * Template Name: Stores Offline
  */
?>

<?php get_header(); ?>

<?php if(have_posts()) : ?>
	<?php while( have_posts()) : the_post(); ?>
		<div class="article">
			<div class="article__header">
				<div class="wrap">
					<h1 class="article__title jt-typo--02 jt-motion--appear" lang="en"><?php _e( 'Stores', 'jt' ); ?></h1>
					<p class="article__desc jt-typo--13 jt-motion--appear"><?php _e( 'Purito Seoul products can be purchased anywhere across <br />the world through any of our international partners.', 'jt' ); ?></p>
				</div><!-- .wrap -->
			</div><!-- .article__header -->

			<div class="article__body">
				<div class="wrap" id="offline_search">
					<ul class="stores-tabs jt-motion--rise">
						<li><a class="jt-typo--14" lang="en" href="<?php bloginfo('url'); ?>/help/stores/online/"><?php _e( 'Online', 'jt' ); ?></a></li>
						<li class="stores-tabs--active"><a class="jt-typo--14" lang="en" href="<?php bloginfo('url'); ?>/help/stores/offline/"><?php _e( 'Offline', 'jt' ); ?></a></li>
					</ul><!-- .stores-tabs -->

					<div class="stores-offline jt-motion--rise">
						<div class="stores-offline-map">
							<div id="jt-map" data-lat="37.3818594284068" data-lng="126.662694187386" data-zoom="16"></div>
						</div><!-- .stores-offline-map -->

						<div class="stores-offline-search">
							<?php echo do_shortcode('[offline]'); ?>
						</div><!-- .stores-offline-search -->
					</div><!-- .stores-offline -->
				</div><!-- .wrap -->
			</div><!-- .article__body -->
		</div><!-- .article -->
	<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>