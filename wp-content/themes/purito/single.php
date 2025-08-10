<?php get_header(); ?>

<?php if(have_posts()) : ?>
	<?php while( have_posts()) : the_post(); ?>

		<div class="article">
			<div class="article__header">
				<div class="wrap">
					<h1 class="article__title jt-typo--01"><?php echo get_the_title(); ?></h1>
				</div><!-- .wrap -->
			</div><!-- .article__header -->

			<div class="article__body">
				<div class="wrap">
					<?php the_content(); ?>
				</div><!-- .wrap -->
			</div><!-- .article__body -->
		</div><!-- .article -->

	<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>
