<?php

/* ************************************** *
 * Remove block style if not home
 * ************************************** */
function jt_blocks_remove_block_library_css(){
    if( !is_single() ){
        wp_dequeue_style( 'wp-block-library' );
        wp_dequeue_style( 'wp-block-library-theme' );
        wp_dequeue_style( 'wc-block-style' ); // Remove WooCommerce block CSS
    }
} 
add_action( 'wp_enqueue_scripts', 'jt_blocks_remove_block_library_css', 9999 );



/* ************************************** *
 * Enqueue blocks editor custom style
 * ************************************** */
function jt_blocks_editor_styles() {
    
    if( is_admin() ) {
        wp_enqueue_style( 'jt-blocks-editor-styles', get_theme_file_uri( '/css/admin-blocks.css' ), false, '1.0.0', 'all' );
    }
    
}
add_action( 'enqueue_block_assets', 'jt_blocks_editor_styles' );



/* ************************************** *
 * Enqueue blocks editor custom script 
 * (Block filter component with js)
 * ************************************** */
function jt_blocks_editor_script() {

    wp_enqueue_script( 'jt-admin-blocks-script', get_theme_file_uri( '/js/admin-blocks.js' ), array( 'wp-blocks' ), '1.0.0' );

}
add_action( 'enqueue_block_editor_assets', 'jt_blocks_editor_script', 999 );



/* ************************************** *
 * WhiteList component
 * core component list https://github.com/WordPress/WordPress/tree/c3ea09ebb8034be04f42e5aaf5f523cbead7e2a4/wp-includes/blocks
 * ************************************** */
function jt_whitelist_blocks( $allowed_block_types ) {

    // $screen = get_current_screen();

    // if( ( $screen->base == 'post' ) && ( $screen->post_type == 'news' ) ){
        return array(
            'core/paragraph',
            'core/heading',
            'core/list',
            'core/list-item',
            'core/quote',
            'core/separator',
            'core/spacer',
            'core/image',
            'core/gallery',
            // 'core/table',
            'core/buttons',
            'core/button',
            // 'core/group',
            'core/shortcode',
            'core/embed' // embed white provider list done using worpdress js api js/admin-blocks.js
        );
    // } else {
    //     return $allowed_block_types;
    // }

}
add_filter( 'allowed_block_types_all', 'jt_whitelist_blocks' );



/* ************************************** *
 * UnRegister defaut wp pattern
 * ************************************** */
function jt_blocks_unregister_default_patterns(){
    remove_theme_support( 'core-block-patterns' );
}
add_action( 'after_setup_theme', 'jt_blocks_unregister_default_patterns' );



/* ************************************** *
 * Register pattern categories
 * ************************************** */
/*
function jt_blocks_register_patterns_categories(){

    register_block_pattern_category(
        'etc',
        array( 'label' => '기타' )
    );

}
add_action('init', 'jt_blocks_register_patterns_categories');
*/



/* ************************************** *
 * Register pattern
 *
 * copy blocks markup and
 * escape with https://onlinestringtools.com/escape-string
 *
 * TODO : auto load via template file (wp core pattern 참고)
 * ************************************** */
/*
function jt_blocks_register_patterns() {

    register_block_pattern(
        'jt/section-gray-pattern',
        array(
            'title'       => "섹션 Gray",
            'categories'  => array("section"),
            'description' => "",
            'content'     => "<!-- wp:group {\"align\":\"full\",\"backgroundColor\":\"type-05\"} -->\n<div class=\"wp-block-group alignfull has-type-05-background-color has-background\"><div class=\"wp-block-group__inner-container\"><!-- wp:paragraph {\"align\":\"center\"} -->\n<p class=\"has-text-align-center\">섹션</p>\n<!-- /wp:paragraph --></div></div>\n<!-- /wp:group -->",
        )
    );

}
add_action('init', 'jt_blocks_register_patterns');
*/



/* ************************************** *
 * Disable block editor by page ID
 * ************************************** */
/*
function jt_disable_block_editor_by_id( $can_edit, $post ) {

    if ( $post->post_type == 'page' ) {
        if( $post->ID == 857 ) {
            return false;
        }
        return true;
    }

    if ( $post->post_type != 'acf-field-group' ) {
        return true;
    }

}
add_filter( 'use_block_editor_for_post', 'jt_disable_block_editor_by_id', 10, 2 );
*/

