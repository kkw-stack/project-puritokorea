<?php get_header(); ?>

<div class="error-404">
	<div class="error-404__inner">
		<div class="wrap">
			<div class="error-404__container">
				<h1 class="jt-typo--02" lang="en"><?php _e( '404 Error', 'jt' ); ?></h1>
				<p class="jt-typo--14"><?php _e( 'Sorry, the page could not be found. <br />You have entered an address that does not exist or the address on the requested <br />page has been changed and deleted and cannot be found.', 'jt' ); ?></p>

				<div class="error-404__controller">
					<a class="jt-btn__basic jt-btn--type-01 jt-btn--small" href="<?php echo get_bloginfo('url'); ?>" lang="en">
						<span><?php _e( 'Go home', 'jt' ); ?></span>
						<i class="jt-icon"><?php jt_icon('jt-chevron-right-mini-2px-square'); ?></i>
					</a>
				</div><!-- .error-404__controller -->
			</div><!-- .error-404__container -->
		</div><!-- .wrap -->
	</div><!-- .error-404__inner -->
</div><!-- .error-404 -->

<?php get_footer(); ?>
