<?php

/* ************************************** *
 * CUSTOMIZE HTTP HEADER
 * ************************************** */
function jt_add_header_xua() {

	// Force IE browser to not use Compatibility mode
	header( 'X-UA-Compatible: IE=edge' );

	// Remove php version
	header_remove( 'X-Powered-By');

}
add_action( 'send_headers', 'jt_add_header_xua' );



/* ************************************** *
 * REMOVE HEADER META
 * ************************************** */
remove_action('wp_head', 'rsd_link'); // remove really simple discovery link
remove_action('wp_head', 'wp_generator'); // remove wordpress version
remove_action('wp_head', 'feed_links', 2); // remove rss feed links (make sure you add them in yourself if youre using feedblitz or an rss service)
remove_action('wp_head', 'feed_links_extra', 3); // removes all extra rss feed links
remove_action('wp_head', 'index_rel_link'); // remove link to index page
remove_action('wp_head', 'wlwmanifest_link'); // remove wlwmanifest.xml (needed to support windows live writer)
remove_action('wp_head', 'start_post_rel_link', 10, 0); // remove random post link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // remove parent post link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // remove the next and previous post links
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );



/* ************************************** *
 * DISABLE EMOJI
 * ************************************** */
// Disable the emoji's
function jt_disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'tiny_mce_plugins', 'jt_disable_emojis_tinymce' );
}
add_action( 'init', 'jt_disable_emojis' );

// Filter function used to remove the tinymce emoji plugin.
function jt_disable_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}



/* ************************************** *
 * DISABLE WPPREFECTH
 * ************************************** */
function jt_remove_dns_prefetch( $hints, $relation_type ) {
    if ( 'dns-prefetch' === $relation_type ) {
        $matches = preg_grep('/emoji/', $hints);
		return array_diff( $hints, $matches );
    }

    return $hints;
}
add_filter( 'wp_resource_hints', 'jt_remove_dns_prefetch', 10, 2 );



/* ************************************** *
 * ADD THUMBNAIL SUPPORT
 * ************************************** */
add_theme_support( 'post-thumbnails' );



/* ************************************** *
 * CUSTOM YOUTUBE OEMBED SETTINGS
 * ************************************** */
function jt_custom_youtube_oembed_settings($html) {

	if (strpos($html, 'youtube') !== false) {
		$origin_url = preg_replace('/\/ko\/?/', '', get_bloginfo('url'));

		$yt_param = 'version=3&amp;loop=1&amp;autoplay=0&amp;rel=0&amp;showsearch=0&amp;showinfo=0&enablejsapi=1&origin='.$origin_url;
		$html = str_replace('feature=oembed',$yt_param,$html);

	}

	return $html;
}
add_filter('embed_oembed_html', 'jt_custom_youtube_oembed_settings', 99, 4);



/* ************************************** *
 * OEMBED WRAP FOR RWD
 * Todo : dry me
 * ************************************** */
function jt_embed_oembed_html($iframe_html, $url, $attr, $post_id) {

	$youtube_id = preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $url, $matches);

	// YOUTUBE
	if(!empty($youtube_id)){

	    // Get the thumb
		$youtube_thumb =  'https://img.youtube.com/vi/'.$matches[1].'/maxresdefault.jpg';

		// Add uid
		$uid = uniqid("",false);
		$iframe_html = str_replace('<iframe','<iframe id="youtube_uid_'.$uid.'"',$iframe_html);

		// Wrap
		$html = '<div class="jt-embed-video jt-embed-video--youtube">';
			$html .= '<div class="jt-embed-video__inner">';
				$html .= $iframe_html;
				$html .= '<div class="jt-embed-video__poster">';
					// If thumb exists use it
					if (@getimagesize($youtube_thumb)) {
					    $html .= '<img class="jt-embed-video__img" src="'.$youtube_thumb.'" alt="video poster">';
					}
					$html .= '<span class="jt-embed-video__overlay"><i class="jt-embed-video__overlay-btn"></i></span>';
				$html .= '</div>';
			$html .= '</div>';
		$html .= '</div>';

		$iframe_html = $html;

	// VIMEO
	}else if(strpos($url, 'vimeo') !== false) {

		// Get the thumb
        $vimeo_id = substr(parse_url($url, PHP_URL_PATH), 1);
        $vimeo_data = json_decode( file_get_contents( 'http://vimeo.com/api/oembed.json?url=' . $url ) );
        $vimeo_thumb = $vimeo_data->thumbnail_url;

		$html .= '<div class="jt-embed-video jt-embed-video--vimeo">';
			$html .= '<div class="jt-embed-video__inner">';
				$html .= $iframe_html;
				$html .= '<div class="jt-embed-video__poster">';
                    // If thumb exists use it
					if (@getimagesize($vimeo_thumb)) {
					    $html .= '<img class="jt-embed-video__img" src="'.$vimeo_thumb.'" alt="video poster">';
					}
					$html .= '<span class="jt-embed-video__overlay"><i class="jt-embed-video__overlay-btn"></i></span>';
				$html .= '</div>';
			$html .= '</div>';
		$html .= '</div>';

		$iframe_html = $html;

	}

  return $iframe_html;

}
add_filter('embed_oembed_html', 'jt_embed_oembed_html', 99, 4);



/* ************************************** *
 * Display content by post id with acf custom block 
 * (if outside the loop)
 * ************************************** */
function jt_content_with_acf($post_id){
	
	$content = get_the_content( null, null, $post_id );
	$blocks_list = parse_blocks($content);
	$html = '';
	
	foreach($blocks_list as $block){
		$html .= render_block($block);
	}
	echo $html;
	
}



/* ************************************** *
 * content filter
 * ************************************** */
//http://wordpress.stackexchange.com/questions/7090/stop-wordpress-wrapping-images-in-a-p-tag
function filter_ptags_on_images($content){
    // do a regular expression replace...
    // find all p tags that have just
    // <p>maybe some white space<img all stuff up to /> then maybe whitespace </p>
    // replace it with just the image tag...
    return preg_replace('/<p>(\s*)(<img .* \/>)(\s*)<\/p>/iU', '\2', $content);
}
// we want it to be run after the autop stuff... 10 is default.
add_filter('the_content', 'filter_ptags_on_images');



/* Remove empty p (with nbsp) */
function remove_blank_p($content){

    return str_replace('<p>&nbsp;</p>', '', $content);

}
// we want it to be run after the autop stuff... 10 is default.
add_filter('the_content', 'remove_blank_p',999);



/* ************************************** *
 * SVG include helper
 * ************************************** */
function jt_svg($url = NULL , $child = false){

	if(!empty($url)){

	    $path = $child ? get_stylesheet_directory_uri() : get_template_directory();
		echo file_get_contents($path . $url);

	}

}



/* ************************************** *
 * JT SVG icon include helper
 * $id = icon file name without extension
 * eg ) jt_icon('jt-arrow-right-bold');
 * ************************************** */
function jt_icon($id, $child = false){

    $url = '/images/icon/jt-icon/'.$id.'.svg';
	jt_svg($url,$child);

}

function jt_get_icon($name) {

	ob_start();
	jt_icon($name);
	return ob_get_clean();

}



/* ************************************** *
 * Add custom taxonomy terms to body class
 * ************************************** */
function jt_terms_in_body_class( $classes ){

	if( is_singular() ){

		global $post;

		$currrent_taxonomies = get_post_taxonomies();
		if ($currrent_taxonomies) {
			foreach ($currrent_taxonomies as $currrent_taxonomy) {

				$currrent_terms = get_the_terms($post->ID, $currrent_taxonomy);
				if ($currrent_terms) {
					foreach ($currrent_terms as $currrent_term) {
						$classes[] = 'jt_'.$currrent_taxonomy.'_' . $currrent_term->term_taxonomy_id;
					}
				}

			}
		}

	}
	return $classes;

}
add_filter( 'body_class', 'jt_terms_in_body_class' );



/* ************************************** *
 * Remove nav menu item id
 * ************************************** */
function jt_clear_nav_menu_item_id($id, $item, $args) {

    return "";

}
add_filter('nav_menu_item_id', 'jt_clear_nav_menu_item_id', 10, 3);



/* **************************************** *
 * H1 or div for logo
 * **************************************** */
function logo_tag(){

	$tag = is_home() || is_front_page()  ? 'h1' : 'div' ;
	echo $tag;

}
