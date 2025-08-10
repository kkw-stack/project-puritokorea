<?php
/*
 * Name       : WALKER
 * File       : /functions/walker.php
 * Author     : STUDIO-JT
 * Guideline  : JTstyle.1.1
 * Guideline  : https://codex.studio-jt.co.kr/dev/?p=2109
 *
 * SUMMARY:
 * 1) JT_Navigation_Walker_Page
 */



/* ************************************** *
* REGISTER : JT_Navigation_Walker_Page
* AUTHOR : MS
* ************************************** */
class JT_Navigation_Walker_Page extends Walker_Page {

    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class='children'>\n";
    }

    function start_el(&$output, $page, $depth=0, $args=array(), $current_page=0) {
        if ( $depth )
            $indent = str_repeat("\t", $depth);
        else
            $indent = '';
        extract($args, EXTR_SKIP);


        $css_class = array( 'page_item', 'page-item-' . $page->ID );
        if ( isset( $args['pages_with_children'][ $page->ID ] ) ) {
            $css_class[] = 'page_item_has_children';
        }
        if ( ! empty( $current_page ) ) {
            $_current_page = get_post( $current_page );
            if ( $_current_page && in_array( $page->ID, $_current_page->ancestors ) ) {
                $css_class[] = 'current_page_ancestor';
                $css_class[] = 'current';
            }
            if ( $page->ID == $current_page ) {
                $css_class[] = 'current_page_item';
                $css_class[] = 'current';
            } elseif ( $_current_page && $page->ID == $_current_page->post_parent ) {
                $css_class[] = 'current_page_parent';
            }
        } elseif ( $page->ID == get_option('page_for_posts') ) {
            $css_class[] = 'current_page_parent';
        }

        $css_classes  = implode(' ',$css_class);
        $class_attr = ' class="' . $css_classes . '"';

        // $pages[0] != "" ? $page->ID = $pages[0]->ID : $page->ID;
        if( is_object($pages)) $page->ID = $pages[0]->ID;

        $pages = get_pages(array( 'sort_column'  => 'menu_order, post_title', 'child_of'=> $page->ID));

        if(count($pages) > 0) {
            $pages[0] != "" ? $page->ID = $pages[0]->ID : $page->ID;
        }
        // var_dump($page->ID);

        $output .= $indent . '<li' . $class_attr . '><a href="' . get_page_link($page->ID) . '">' . $link_before . apply_filters( 'the_title', $page->post_title, $page->ID ) . $link_after .'</a>';

    }

}  // JT_Navigation_Walker_Page








class JT_Title_Only_Walker_Nav_Menu extends Walker_Nav_Menu  {

	 
	 public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		
		$item_output = "";
		$item_id = $item->menu_item_parent;
       
        if(!$item_id ){
			$item_output .= $item->title;
		}

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
	
	public function end_el( &$output, $item, $depth = 0, $args = array() ) {
        $output .= "";
    }
	
	
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
        $output .= "";
    }
	
	public function end_lvl( &$output, $depth = 0, $args = array() ) {
        $output .= "";
    }

}



function get_menu_parent( $menu, $post_id = null ) {

    $post_id        = $post_id ? : get_the_ID();
    $menu_items     = wp_get_nav_menu_items( $menu );
    $parent_item_id = wp_filter_object_list( $menu_items, array( 'object_id' => $post_id ), 'and', 'menu_item_parent' );

    if ( ! empty( $parent_item_id ) ) {
        $parent_item_id = array_shift( $parent_item_id );
        $parent_post_id = wp_filter_object_list( $menu_items, array( 'ID' => $parent_item_id ), 'and', 'object_id' );

        if ( ! empty( $parent_post_id ) ) {
            $parent_post_id = array_shift( $parent_post_id );

            return get_post( $parent_post_id );
        }
    }

    return false;
}

