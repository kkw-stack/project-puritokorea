<?php
  /**
    * Template Name: FAQ
  */
?>

<?php get_header(); ?>

<?php if(have_posts()) : ?>
	<?php while( have_posts()) : the_post(); ?>

		<div class="article faq">
			<div class="article__header">
				<div class="wrap">
                    <h1 class="article__title jt-typo--02 jt-motion--appear jt-motion--appear-large" lang="en"><?php _e( 'Frequently Asked <br />Questions', 'jt' ); ?></h1>
				</div><!-- .wrap -->
			</div><!-- .article__header -->

			<div class="article__body">
				<div class="wrap-small">
					<?php echo do_shortcode('[faq]'); ?>
				</div><!-- .wrap -->
			</div><!-- .article__body -->
		</div><!-- .article -->
	<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>