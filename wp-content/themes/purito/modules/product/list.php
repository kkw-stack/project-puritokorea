<?php
if ( is_tax('product-categories') ) {
	$taxonomy_type = "product-categories";
} elseif ( is_tax('product-skin') ) {
	$taxonomy_type = "product-skin";
} elseif ( is_tax('product-ingredient') ) {
	$taxonomy_type = "product-ingredient";
} else {
	$taxonomy_type = "product-labels";
}

$terms = get_terms(
	array(
		'taxonomy'   => $taxonomy_type,
		'hide_empty' => false,
		'include'    => 'product-labels' === $taxonomy_type ? array( '13', '14', '37', '38' ) : array(),
	)
);

$current_term = get_queried_object();
$current_term_id = $current_term->term_id;
if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
    if ( ! is_tax('product-categories') && ! is_tax('product-skin') && ! is_tax('product-ingredient') && ! is_tax('product-labels') ) {
	    $current_term_id = $terms[0]->term_id;
    }

	if ( ! empty( $_GET['category'] ) ) {
		$current_term_id = (int) $_GET['category'];
	}
}

$current_url = preg_replace( '/\/ko\/(ko\/)+/', '/ko/', home_url( $_SERVER['REQUEST_URI'] ) );

$option = get_field('common_settings_product', 'option');
$banner_option = $option['banner'];
$background = $option['background'];
?>

<?php if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) : ?>
	<div class="jt-category-nav-wrap jt-motion--rise jt-motion--rise-large">
		<div class="jt-category-nav">
			<ul>
				<?php if ( ! is_tax() || is_tax('product-labels') ) : ?>
				<li class="<?php echo ( ! is_tax() ? 'jt-category--active' : '' ); ?>">
					<a href="<?php echo home_url('/product/'); ?>">
						<span><?php echo jt_is_lang('en') ? _e( 'All Products', 'jt' ) : _e( '전 제품 보기', 'jt' ); ?></span>
					</a>
				</li>
				<?php endif; ?>

				<?php foreach ( $terms as $idx => $term ) : ?>
                    <?php
					$term_link = get_term_link($term);

					if ( 'best' === $term->slug ) {
						$term_link = add_query_arg('sort', 'popularity', $term_link);
						$category_name = jt_is_lang('en') ? 'Best Sellers' : '베스트셀러';
					} elseif ( 'new' === $term->slug ) {
						$category_name = jt_is_lang('en') ? 'New Arrivals' : '신상품';
					} else {
						$category_name = $term->name;
					}

                    ?>
					<li class="<?php echo ( $current_term_id == $term->term_id && is_tax() ? 'jt-category--active' : '' ); ?>">
						<a href="<?php echo $term_link; ?>">
							<span><?php echo $category_name; ?></span>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		</div><!-- .jt-category-nav -->
	</div><!-- .jt-category-nav-wrap -->
<?php endif; ?>

<div class="product-list-container">
	<div class="product-list__count">
		<p class="jt-typo--14"><?php echo $loop->found_posts; ?> <?php echo ( jt_is_lang('en') ) ? 'Products' : '개 제품' ?></p>
	</div><!-- .product-list__count -->
	
	<?php if ( 'best' !== $current_term->slug && 'new' !== $current_term->slug ) : ?>
		<div class="product-list__sorting">
			<div class="jt-choices__wrap">
				<select class="jt-choices" name="sort">
					<option value="<?php echo remove_query_arg( 'sort', $current_url ); ?>"><?php _e( 'Latest', 'jt' ); ?></option>
					<option value="<?php echo add_query_arg( 'sort', 'popularity', $current_url ); ?>" <?php selected( $_GET['sort'] ?? '', 'popularity' ); ?>><?php _e( 'Popularity', 'jt' ); ?></option>
				</select><!-- .jt-choices -->
			</div><!-- .jt-choices__wrap -->
		</div><!-- .product-list__sorting -->
	<?php endif; ?>
	
	<?php if ( $loop->have_posts() ) : ?>
		<ul class="global-product-list global-product-list--grid jt-motion--stagger">
			<?php
			while ( $loop->have_posts() ) :
				$loop->the_post();

				$product_data = get_field( 'product_data_basic' );
				$thumbnail    = jt_get_image_src( $product_data['thumbnail']['list'], 'jt_thumbnail_1192x1192' );
				?>
				<li class="global-product-list__item jt-motion--stagger-item" style="background: <?php echo $background; ?>;">
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
						<a class="global-product-list__link" href="<?php the_permalink(); ?><?php echo ( $current_term->slug ? '?sort=' . $current_term->slug : '?sort=product' ); ?>">
							<div class="global-product-list__bg" data-unveil="<?php echo jt_get_image_src( $product_data['thumbnail']['hover'], 'jt_thumbnail_596x840' ); ?>"></div>

							<div class="global-product-list__img-wrap">
								<img loading="lazy" width="596" height="596" src="<?php echo $thumbnail; ?>" alt="" />
							</div>

							<div class="global-product-list__content">
								<h2 class="global-product-list__title jt-typo--13"><?php echo $product_data['title']; ?></h2>
								<span class="global-product-list__detail jt-typo--16"><?php echo $product_data['options'][0]['price']; ?></span>
							</div>

							<?php if ( ! empty ( $product_data['category']['label'] ) ) : ?>
								<div class="global-product-list__label">
									<?php foreach ( $product_data['category']['label'] as $idx => $item ) : ?>
										<?php
										$label_data = get_field( 'product_label_data', 'term_' . $item->term_id );
										?>
										<span class="global-product-list__label--<?php echo $item->slug; ?> jt-typo--14" lang="en" style="color: <?php echo $label_data['color']; ?>;background: <?php echo $label_data['background']; ?>;"><?php _e( $item->name, 'jt' ); ?></span>
									<?php endforeach; ?>
								</div><!-- .global-product-list__label -->
							<?php endif; ?>
						</a>
					<?php endif; ?>
				</li>
			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>
		</ul>

		<?php if ( $loop->max_num_pages > $paged ) : ?>
			<div id="jt-loadmore" class="jt-loadmore">
				<a class="jt-loadmore__btn" href="<?php echo get_pagenum_link( $paged + 1 ); ?>" data-loadmore-list=".global-product-list">
					<span><?php _e( 'More Products', 'jt' ); ?><span class="jt-loadmore__count"><?php echo $loop->found_posts - ( $num * ( $paged ) ); ?></span></span>
					<div class="jt-loadmore__spinner">
						<div class="jt-loadmore__spinner_ball_01"></div>
						<div class="jt-loadmore__spinner_ball_02"></div>
						<div class="jt-loadmore__spinner_ball_03"></div>
					</div>
				</a>
			</div><!-- .jt-loadmore -->
		<?php endif; ?>
	<?php endif; ?>
</div><!-- .product-list-container -->

<div class="product-list-banner jt-motion--rise">
	<div class="product-list-banner__bg" data-unveil="<?php echo jt_get_image_src($banner_option['image']['pc'], 'jt_thumbnail_1820x600' ); ?>"></div>
		<div class="product-list-banner__content jt-motion--stagger">
			<p class="product-list-banner__title jt-typo--04 jt-motion--stgger-item"><?php echo $banner_option['text']; ?></p>
			<a class="jt-btn__basic jt-btn--type-03 jt-btn--small jt-motion--stagger-item" href="<?php echo $banner_option['link']; ?>">
				<span><?php _e( 'View more', 'jt' ); ?></span>
				<i class="jt-icon"><?php jt_icon( 'jt-chevron-right-mini-2px-square' ); ?></i>
			</a>
		</div><!-- .product-list-banner__content -->
	</div><!-- .product-list-banner -->
</div><!-- .product-list-banner -->
