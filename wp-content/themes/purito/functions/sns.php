<?php

/* ************************************** *
 * JT SHARE BUTTON
 * Display html in the Front end
 * ************************************** */
function jt_share(){

    if( is_single() || is_page() ){

		// Encoding 필수 (페이스북 & 트위터)
    	$page_url          = wp_get_shortlink();        
        $page_url_encode   = jt_sns_encodeURIComponent($page_url);

		$site_title        = get_bloginfo('title');
		$site_title_encode = jt_sns_encodeURIComponent($site_title );

	    $page_title        = get_the_title(get_the_ID());
		$page_title_encode = jt_sns_encodeURIComponent($page_title);
		$page_title_encode = $site_title_encode .'-'. $page_title_encode;
		$page_title	       = $site_title .'-'. $page_title;

        $page_desc         = str_replace( array( "\r\n", "\r", "\n", PHP_EOL ), ' ', wp_strip_all_tags( get_the_excerpt(get_the_ID()) ) );

        if ( has_post_thumbnail( get_the_ID() ) ) {

            $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
            $image = $image[ 0 ];

        } else {

            if ( function_exists( 'jtseo_default_thumb' ) ) {

                $image = jtseo_default_thumb();

            } else {

                $image = wp_get_attachment_image_src( 5, 'full' );
                $image = is_array($image) && isset($image[0]) ? $image[0] : '';

            }

        }
?>
		<div class="jt-share">
            <a class="jt-share__item jt-share--facebook" target="_blank" rel="noopener" href="http://www.facebook.com/sharer.php?u=<?php echo $page_url_encode; ?>">
                <span class="sr-only"><?php _e( 'Share on Facebook', 'jt' ); ?></span>
                <div class="jt-icon"><?php jt_icon('jt-facebook'); ?></div>
            </a>
            <a class="jt-share__item jt-share--twitter" target="_blank" rel="noopener" href="https://twitter.com/intent/tweet?url=<?php echo $page_url_encode; ?>&amp;text=<?php echo $page_title_encode; ?>">
                <span class="sr-only"><?php _e( 'Share on X', 'jt' ); ?></span>
                <div class="jt-icon"><?php jt_icon('jt-twitter'); ?></div>
            </a>
            <a class="jt-share__item jt-share--url" target="_blank" rel="noopener" href="<?php echo $page_url; ?>" data-tooltip="<?php _e( 'URL has been copied.', 'jt' ); ?>">
                <span class="sr-only"><?php _e( 'Copy URL', 'jt' ); ?></span>
                <div class="jt-icon"><?php jt_icon('jt-link'); ?></div>
            </a>
		</div><!-- .jt-share -->
<?php
	}

}



/* ************************************** *
 * HELPER js encodeURIComponent php port (src : http://stackoverflow.com/a/1734255)
 * ************************************** */
function jt_sns_encodeURIComponent($str) {
    $revert = array('%21'=>'!', '%2A'=>'*', '%27'=>"'", '%28'=>'(', '%29'=>')');
    return strtr(rawurlencode($str), $revert);
}
