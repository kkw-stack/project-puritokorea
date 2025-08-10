<?php
  /*
    Template Name: Product
  */
?>

<?php get_header(); ?>

<?php if(have_posts()) : ?>
	<?php while( have_posts()) : the_post(); ?>

		<div class="article article--product">
			<div class="article__header">
				<div class="wrap">
					<h1 class="article__title jt-typo--02 jt-motion--appear jt-motion--appear-large">
                        <span class="pc-only"><?php _e( 'Product', 'jt' ); ?></span> <?php // pc에서는 2depth명 노출 (~1024) ?>
                        <span class="mo-only"><?php _e( 'All Products', 'jt' ); ?></span> <?php // mobile에서는 3depth명 노출 (1023~)?>
                    </h1>
				</div><!-- .wrap -->
			</div><!-- .article__header -->

			<div class="article__body">
				<div class="wrap">
                    <?php echo do_shortcode('[product num=12]'); ?>
				</div><!-- .wrap -->
			</div><!-- .article__body -->
		</div><!-- .article -->

	<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>
