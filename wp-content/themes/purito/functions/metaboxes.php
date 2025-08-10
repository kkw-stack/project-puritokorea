<?php 

/* ************************************** *
 * HAS HEADER METABOX
 * ************************************** */
/*
function jt_has_header_meta_box() {
    add_meta_box(
        'jt_has_header',               // ID attribute of metabox
        'Has Header',                  // Title of metabox visible to user
        'jt_has_header_meta_box_html', // Function that prints box in wp-admin
        'page',                        // Show box for posts, pages, custom, etc.
        'side',                        // Where on the page to show the box
        'low'                          // Priority of box in display order
    );
}
add_action( 'admin_init', 'jt_has_header_meta_box' );

function jt_has_header_meta_box_html() {

    global $post;
    
    $has_header = get_post_meta( $post->ID, 'jt_has_header', true );
    if(empty($has_header)){
        $has_header = '1';
    }
?>
    <label for="has-header-checkbox">
        <input type="checkbox" name="jt_has_header" id="has-header-checkbox" value="1" <?php if ( isset ( $has_header ) ) checked( $has_header, '1' ); ?> />
        <span>show header</span>
    </label>
<?php

}

function jt_has_header_save_meta_box_data( $post_id ) {

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return  $post_id ;
    }
    
    if ( isset( $_POST['jt_has_header'] ) ) {

        $has_header = esc_attr($_POST['jt_has_header'] );        
        update_post_meta( $post_id, 'jt_has_header', $has_header);

    }else{
        update_post_meta( $post_id, 'jt_has_header', '0');
    }

}
add_action( 'save_post', 'jt_has_header_save_meta_box_data' );


// CHECK IF HAS HEADER HELPER 
function jt_has_header(){
    
    $val = get_post_meta( get_the_ID(), 'jt_has_header', true );
    
    if(!empty($val)){
        return filter_var($val, FILTER_VALIDATE_BOOLEAN);
        
    }else{
        if($val === ""){
           // show by default
           return true;
        }else{
           return false;
        }
    }

}
*/

/* ************************************** *
 * USE JT BLOCKS STYLE METABOX
 * ************************************** */
/*
function jt_use_block_style_meta_box() {
    add_meta_box(
        'jt_use_block_style', 
        'BLock style', 
        'jt_use_block_style_meta_box_html', 
        'page', 
        'side',  
        'low' 
    );
}
add_action( 'admin_init', 'jt_use_block_style_meta_box' );

function jt_use_block_style_meta_box_html() {

    global $post;
    
    $has_header = get_post_meta( $post->ID, 'jt_use_block_style', true );
    if(empty($has_header)){
        $has_header = '1';
    }
?>
    <label for="jt-use-block-checkbox">
        <input type="checkbox" name="jt_use_block_style" id="jt-use-block-checkbox" value="1" <?php if ( isset ( $has_header ) ) checked( $has_header, '1' ); ?> />
        <span>사용</span>
    </label>
<?php

}

function jt_use_block_style_save_meta_box_data( $post_id ) {

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return  $post_id ;
    }
    
    if ( isset( $_POST['jt_use_block_style'] ) ) {

        $has_header = esc_attr($_POST['jt_use_block_style'] );        
        update_post_meta( $post_id, 'jt_use_block_style', $has_header);

    }else{
        update_post_meta( $post_id, 'jt_use_block_style', '0');
    }

}
add_action( 'save_post', 'jt_use_block_style_save_meta_box_data' );


// CHECK IF HAS HEADER HELPER 
function jt_use_block_style(){
    
    $val = get_post_meta( get_the_ID(), 'jt_use_block_style', true );
    
    if(!empty($val)){
        return filter_var($val, FILTER_VALIDATE_BOOLEAN);
        
    }else{
        if($val === ""){
           // show by default
           return true;
        }else{
           return false;
        }
    }

}
*/