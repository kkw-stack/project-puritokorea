<?php
/*
 * Name       : CONTACT FROM 7 HELPER
 * File       : /functions/cf7.php
 * Author     : STUDIO-JT (KMS,NICO)
 * Guideline  : JTstyle.1.1
 * Guideline  : https://codex.studio-jt.co.kr/dev/?p=2109
 *
 * SUMMARY:
 * 1) Allow shortcodes in Contact Form 7
 * 2) Privacy url shortcode
 */



/* ************************************** *
 * Allow shortcodes in Contact Form 7
 * ************************************** */
function shortcodes_in_cf7( $content ) {
    $content = do_shortcode( $content );
    return $content;
}
add_filter( 'wpcf7_form_elements', 'shortcodes_in_cf7' );



/* ************************************** *
 * Privacy url shortcode
 * ************************************** */
/*
function jt_privacy_url_shortcode( $content ) {

    return get_bloginfo('template_directory').'/sub/academy-popup.html';

}
add_shortcode( 'jt_privacy_url', 'jt_privacy_url_shortcode' );
*/



/* ************************************** *
 * Email in the shortcode
 * https://contactform7.com/getting-default-values-from-shortcode-attributes/
 * ************************************** */
/*
function jt_shortcode_atts_wpcf7_filter( $out, $pairs, $atts ) {

	$my_attributes = array('destination-email', 'category-title');

    foreach ($my_attributes as $value) {
        if ( isset( $atts[$value] ) ) {
            $out[$value] = $atts[$value];
        }
    }

	return $out;
}
add_filter( 'shortcode_atts_wpcf7', 'jt_shortcode_atts_wpcf7_filter', 10, 3 );
*/
