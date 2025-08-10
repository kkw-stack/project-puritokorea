<?php get_header(); ?>

<?php if ( have_posts() ) : ?>

	<?php
	while ( have_posts() ) :
		the_post();

        global $jt_module;

        $newspress_data = get_field( 'newspress' );

		if ( ! empty( $newspress_data ) ) {
			$top_banner = jt_get_image_src( $newspress_data['banner'], 'jt_thumbnail_1903x760' );
		}

        $taxonomy_name = $jt_module->_namespace . '_categories';
        if ( $jt_module->_support_cat ) {
            $terms = get_the_terms( get_the_ID(), $taxonomy_name );
        }
		?>
		<div class="jt-single">
			<div class="jt-single__header <?php echo ( ! empty( $top_banner ) ) ? 'jt-single__header--visual' : ''; ?>">
                <?php if ( ! empty( $top_banner ) ) : ?>
				<div class="jt-single__header-bg" style="background-image: url(<?php echo $top_banner; ?>)"></div>
                <?php endif; ?>

				<div class="jt-single__header-inner wrap-narrow">
					<h1 class="jt-single__title jt-typo--05"><?php echo get_the_title(); ?></h1>
					
					<div class="jt-single__meta">
						<time class="jt-single__date jt-typo--14" datetime="<?php echo get_the_time( 'Y-m-d' ); ?>"><?php echo jt_is_lang( 'en' ) ? get_the_time( 'F d, Y' ) : get_the_time( 'Y.m.d' ); ?></time>
					</div><!-- .jt-single__meta -->

					<div class="jt-single__small-share">
						<?php jt_share(); ?>
					</div><!-- .jt-single__small-share -->
				</div><!-- .wrap -narrow -->
			</div><!-- .jt-single__header -->

			<div class="jt-single__body">
				<div class="jt-single__content">
					<div class="jt-single__share">
						<?php jt_share(); ?>
					</div><!-- .jt-single__share -->
					
					<div class="jt-blocks">
						<?php the_content(); ?>
					</div><!-- .jt-blocks -->

					<script>
						// Cover Header
						var singleVisual = document.getElementsByClassName('jt-single__header--visual');

						if( singleVisual.length ){
							document.getElementById('header').classList.add('header--invert');
							document.querySelector('.main-container').style.paddingTop = 0;
						}
					</script>

					<div class="wrap-narrow">
						<div class="jt-single__control">
							<a class="jt-btn__basic jt-btn--medium" href="<?php the_permalink( $jt_module->_pageid ); ?>">
                                <?php if (jt_is_lang('en')) { ?>
                                    <span>Back to <?php echo ( $jt_module->_name ); ?></span>
                                <?php } else { ?> 
                                    <span>목록으로 가기</span>
                                <?php } ?>
								<i class="jt-icon"><?php jt_icon( 'jt-chevron-right-mini-2px-square' ); ?></i>
							</a>
						</div><!-- .jt-single__control -->
					</div><!-- .wrap-narrow -->
					
				</div><!-- .jt-single__content -->

				<div class="jt-single__related">
					<div class="wrap">
						<div class="jt-single__related-head">
							<h2 class="jt-single__related-title jt-typo--04" lang="en">Explore More</h2>
						</div><!-- .jt-single__related-head -->

						<div class="jt-single__related-content">
							<?php $jt_module->last_posts( 4 ); ?>
						</div><!-- .jt-single__related-content -->
					</div><!-- .wrap -->
				</div><!-- .jt-single__related -->
			</div><!-- .jt-single__body -->
		</div><!-- .jt-single -->
	<?php endwhile; ?>
<?php endif; ?>

<?php
/*
// If comments are open or we have at least one comment, load up the comment template.
if ( comments_open() || get_comments_number() ) :
	comments_template();
endif;
*/
?>

<?php get_footer(); ?>
