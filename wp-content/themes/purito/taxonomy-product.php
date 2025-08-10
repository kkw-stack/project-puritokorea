<?php get_header(); ?>

<?php
$current_term = get_queried_object();

$pc_title     = 'PRODUCT';
$mobile_title = get_current_menu_name() ?: $current_term->name;

if ( is_tax( 'product-categories' ) ) {
	$pc_title = jt_is_lang('en') ? 'Product Type' : '유형별';
} elseif ( is_tax( 'product-skin' ) ) {
	$pc_title = jt_is_lang('en') ? 'Skin Concern' : '피부 고민 별';
} elseif ( is_tax( 'product-ingredient' ) ) {
	$pc_title = jt_is_lang('en') ? 'Ingredient Line' : '원료 별';
} elseif ( is_tax( 'product-labels' ) ) {
	if ( 'best' === $current_term->slug ) {
		$pc_title = jt_is_lang('en') ? 'Product' : '제품';
	} elseif ( 'new' === $current_term->slug ) {
		$pc_title = jt_is_lang('en') ? 'Product' : '제품';
	}
}
?>

<div class="article article--product">
	<div class="article__header">
		<div class="wrap">
			<h1 class="article__title jt-typo--02 jt-motion--appear jt-motion--appear-large">
				<span class="pc-only"><?php echo $pc_title; ?></span> <?php // pc에서는 2depth명 노출 (~1024) ?>
				<span class="mo-only"><?php echo $mobile_title; ?></span> <?php // mobile에서는 3depth명 노출 (1023~) ?>
			</h1>
		</div><!-- .wrap -->
	</div><!-- .article__header -->

	<div class="article__body">
		<div class="wrap">
			<?php echo do_shortcode( '[product num=12]' ); ?>
		</div><!-- .wrap -->
	</div><!-- .article__body -->
</div><!-- .article -->

<?php get_footer(); ?>
