<?php
/* **************************************** */
/* Not expose user data on the rest api */
/* **************************************** */
function jt_rest_user_endpoints( $endpoints ){

    if(!current_user_can( 'edit_users' )){
      if ( isset( $endpoints['/wp/v2/users'] ) ) {
          unset( $endpoints['/wp/v2/users'] );
      }
      if ( isset( $endpoints['/wp/v2/users/(?P<id>[\d]+)'] ) ) {
          unset( $endpoints['/wp/v2/users/(?P<id>[\d]+)'] );
      }
    }
    return $endpoints;

}
add_filter( 'rest_endpoints', 'jt_rest_user_endpoints');



/* **************************************** */
/* 2019-04-18 JJW - XMLRPG DDOS Attack, Brute Force Attack > xmlrpc.php Enabled  */
/* **************************************** */
add_filter( 'xmlrpc_enabled', '__return_false' );



/* **************************************** */
/* Disable enable post email config */
/* **************************************** */
add_filter( 'enable_post_by_email_configuration', '__return_false' );



/* **************************************** */
/* Disable auto update majore core */
/* **************************************** */
add_filter( 'allow_major_auto_core_updates', '__return_false' );



/* **************************************** */
/* Disable application password */
/* **************************************** */
add_filter( 'wp_is_application_passwords_available', '__return_false' );
