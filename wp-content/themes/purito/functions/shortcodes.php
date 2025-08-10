<?php

/* ************************************** *
 * EMAIL SPACE
 * USAGE : [email]support@studio-jt.co.kr[/email]
 * ************************************** */
function jt_shortcode_email( $atts , $content = null ) {
    if ( ! is_email( $content ) ) {
        return;
    }
    return '<a href="mailto:' . esc_attr( antispambot( $content ) ) . '">' . esc_html( antispambot( $content ) ) . '</a>';
}
add_shortcode( 'email', 'jt_shortcode_email' );



/* ************************************** *
 * SHORTCODE BR MOBILE 
 * USAGE : [smbr]
 * ************************************** */
function jt_shortcode_smbr(){

	return '<br class="smbr">';

}
add_shortcode('smbr','jt_shortcode_smbr');



/* ************************************** *
 * SHORTCODE EM
 * USAGE : [em]content[/em]
 * ************************************** */
function jt_shortcode_em( $atts , $content = null ) {
    return '<em>' . $content . '</em>';
}
add_shortcode('em','jt_shortcode_em');



/* ************************************** *
 * SHORTCODE SMALL
 * USAGE : [small]content[/small]
 * ************************************** */
function jt_shortcode_small( $atts , $content = null ) {
    return '<small>' . $content . '</small>';
}
add_shortcode('small','jt_shortcode_small');