<?php
/* ************************************** *
 * REDIRECT
 * ************************************** */
function jt_redirect_meta_box() {
    add_meta_box(
        'jt_redirect_url',               // ID attribute of metabox
        'Redirect Page',                 // Title of metabox visible to user
        'jt_redirect_meta_box_callback', // Function that prints box in wp-admin
        'page',                          // Show box for posts, pages, custom, etc.
        'side',                          // Where on the page to show the box
        'low'                            // Priority of box in display order
    );
}
add_action( 'admin_init', 'jt_redirect_meta_box' );

function jt_redirect_meta_box_callback() {
    global $post;

    $dropdown_args = array(
        'post_type'   => 'page',
        'name'        => 'jt_redirect_page_id',
        'sort_column' => 'menu_order, post_title',
        'selected'    => intVal( get_post_meta( $post->ID, 'jt_redirect_page_id', true ) ),
        'show_option_none'      => '리다이렉트 없음', // string
        'option_none_value' => '0', // string
        'echo'        => 1
    );

    // Use nonce for verification
    // wp_nonce_field( plugin_basename( __FILE__ ), 'myplugin_noncename');

    //Dropdown of pages
    wp_dropdown_pages( $dropdown_args );
}

function jt_redirect_save_meta_box_data( $post_id ) {
    if ( isset( $_POST['jt_redirect_page_id'] ) ) {
        $redirect_id = intVal( esc_attr($_POST['jt_redirect_page_id'] )) ?: 0;

        update_post_meta( $post_id, 'jt_redirect_page_id', $redirect_id );
    }
}
add_action( 'save_post', 'jt_redirect_save_meta_box_data' );


function jt_redirect_rule(){
    // jt_redirect( 5, 121 );
    // add your rule redirection here using page id  eg:jt_redirect($from,$to)
    global $post;

    if ( $post ) {

        $redirect_id = get_post_meta( $post->ID , 'jt_redirect_page_id', true );

        if ( ! is_search() && intVal( $redirect_id ) > 0 && $post->ID != $redirect_id ) {
            wp_redirect( get_permalink( $redirect_id ), 301 );
            exit;
        }

    }
}
add_action( 'wp', 'jt_redirect_rule' );