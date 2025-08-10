<?php

/* ************************************** *
 * Block Robots
 * ************************************** */
function jt_block_robots_for_dev( $value, $option ) {
    $home_url = home_url();

    return ( strpos( $home_url, '.studio-jt.co.kr' ) !== false ? '0' : $value );
}
add_filter( 'option_blog_public', 'jt_block_robots_for_dev', 9999, 2 );
add_filter( 'pre_option_blog_public', 'jt_block_robots_for_dev', 9999, 2 );



/* ************************************** *
 * functions.php
 * ************************************** */
// VERSION
require_once locate_template('/version.php');

// CLEAN UP
require_once locate_template('/functions/admin.php'); // Custom admin (clean up the admin)
require_once locate_template('/functions/front.php'); // Custom front (clean up the head)

// SECURITY
require_once locate_template('/functions/security.php');

// FUNCTIONS
require_once locate_template('/functions/image-sizes.php'); // CUSTOM IMAGE SIZES
require_once locate_template('/functions/JT_Session.class.php'); // SESSION
require_once locate_template('/functions/helpers.php'); // HELPERS
require_once locate_template('/functions/redirect.php'); // REDIRECT
require_once locate_template('/functions/languages.php'); // 다국어 함수
require_once locate_template('/functions/pagination.php'); // PAGINATION
require_once locate_template('/functions/sns.php'); // SNS SHARE
require_once locate_template('/functions/shortcodes.php'); // SHORTCODES
require_once locate_template('/functions/blocks.php'); // BLOCKS CUSTOM
require_once locate_template('/functions/search.php'); // SEARCH

// MODULES
require_once locate_template('/modules/JT_Module.class.php');
require_once locate_template('/modules/product/index.php'); // Product
require_once locate_template('/modules/offline/index.php'); // offline Store
require_once locate_template('/modules/faq/index.php'); // FAQ
require_once locate_template('/modules/newspress/index.php'); // New&Press
require_once locate_template('/modules/ingredient/index.php'); // Ingredient
require_once locate_template('/modules/series/index.php'); // Series

// ACF
if (!is_main_site()) {
require_once locate_template('/functions/acf.php');
}




/* ************************************** *
 * ENQUEUE STYLE & SCRIPT
 * ************************************** */
function jt_enqueue_script_before() {

    // First load browser selector before style (avoid fouc)
    echo '<script src="'.get_template_directory_uri() . '/js/vendors/browser/browser-selector.js"></script>';

}
add_action( 'wp_head', 'jt_enqueue_script_before', 1 );



function jt_enqueue_style_script() {

    $version = '1.0.38';

    // STYLE
    wp_enqueue_style( 'style', get_stylesheet_uri(), array(), $version ); // style.css (wp 필수)
    wp_enqueue_style( 'font', get_template_directory_uri() . '/css/font.css', array(), $version);
    wp_enqueue_style( 'choices', get_template_directory_uri() . '/css/vendors/select/choices.min.css', array(), '10.2.0' );
    wp_enqueue_style( 'swiper', get_template_directory_uri() . '/css/vendors/slider/swiper/swiper-bundle.min.css', array(), '8.4.2');
    wp_enqueue_style( 'jt-media-popup', get_template_directory_uri() . '/css/vendors/jt/jt-media-popup.css', array(), '1.0.0');
    wp_enqueue_style( 'variables', get_template_directory_uri() . '/css/var.css', array(), $version);
	wp_enqueue_style( 'reset', get_template_directory_uri() . '/css/reset.css', array(), $version);
    wp_enqueue_style( 'layout', get_template_directory_uri() . '/css/layout.css', array(), $version);
    wp_enqueue_style( 'jt-strap', get_template_directory_uri() . '/css/jt-strap.css', array(), $version);
    wp_enqueue_style( 'blocks', get_template_directory_uri() . '/css/blocks.css', array(), $version);
    wp_enqueue_style( 'main', get_template_directory_uri() . '/css/main.css', array(), $version);
    wp_enqueue_style( 'sub-hee', get_template_directory_uri() . '/css/sub-hee.css', array(), $version);
    wp_enqueue_style( 'sub-hree', get_template_directory_uri() . '/css/sub-hree.css', array(), $version);
    wp_enqueue_style( 'sub-kms', get_template_directory_uri() . '/css/sub-kms.css', array(), $version);
    wp_enqueue_style( 'rwd-layout', get_template_directory_uri() . '/css/rwd-layout.css', array(), $version);
    wp_enqueue_style( 'rwd-strap', get_template_directory_uri() . '/css/rwd-strap.css', array(), $version);
    wp_enqueue_style( 'rwd-blocks', get_template_directory_uri() . '/css/rwd-blocks.css', array(), $version);
    wp_enqueue_style( 'rwd-main', get_template_directory_uri() . '/css/rwd-main.css', array(), $version);

    // Languages
    if( jt_get_lang() == 'ko' ) {
        wp_enqueue_style( 'lang-ko', get_template_directory_uri() . '/css/lang-ko.css', array(), $version);
    }

    // SCRIPT
    wp_deregister_script('jquery');
	wp_enqueue_script( 'jquery', get_template_directory_uri() . '/js/vendors/jquery/jquery.min.js', array(), null, true);
    wp_enqueue_script( 'gsap', get_template_directory_uri() . '/js/vendors/greensock/gsap.min.js', array(), '3.10.3', true);
	wp_enqueue_script( 'scrolltoplugin', get_template_directory_uri() . '/js/vendors/greensock/ScrollToPlugin.min.js', array(), '3.10.3', true);
	wp_enqueue_script( 'scrolltrigger', get_template_directory_uri() . '/js/vendors/greensock/ScrollTrigger.min.js', array(), '3.10.3', true);
	wp_enqueue_script( 'MorphSVGPlugin', get_template_directory_uri() . '/js/vendors/greensock/MorphSVGPlugin.min.js', array(), '3.10.3', true);
	wp_enqueue_script( 'DrawSVGPlugin', get_template_directory_uri() . '/js/vendors/greensock/DrawSVGPlugin.min.js', array(), '3.10.3', true);
	wp_enqueue_script( 'MotionPathPlugin', get_template_directory_uri() . '/js/vendors/greensock/MotionPathPlugin.min.js', array(), '3.10.3', true);
    wp_enqueue_script( 'imagesloaded', get_template_directory_uri() . '/js/vendors/utilities/imagesloaded.pkgd.min.js', array(), '3.1.8', true);
    wp_enqueue_script( 'jtlazyload', get_template_directory_uri() . '/js/vendors/jt/jt-unveil.js', array(), '1.0.0', true);
    wp_enqueue_script( 'swiper', get_template_directory_uri() . '/js/vendors/slider/swiper/swiper-bundle.min.js', array(), '8.4.2', true);
    wp_enqueue_script( 'choices', get_template_directory_uri() . '/js/vendors/select/choices.min.js', array(), '10.2.0', true);
    wp_enqueue_script( 'hover-intent', get_template_directory_uri() . '/js/vendors/jquery/jquery.hoverIntent.js', array(), '1.9.0', true);
    wp_enqueue_script( 'paper', get_template_directory_uri() . '/js/vendors/paper/paper-full.min.js', array(), '0.12.17', true);
    wp_enqueue_script( 'dat-gui', get_template_directory_uri() . '/js/vendors/dat-gui/dat.gui.min.js', array(), '0.7.9', true);
    wp_enqueue_script( 'anime', get_template_directory_uri() . '/js/vendors/anime/anime.js', array(), '3.2.2', true);
    wp_enqueue_script( 'jt-media-popup', get_template_directory_uri() . '/js/vendors/jt/jt-media-popup.min.js', array('gsap', 'imagesloaded'), '1.0.0', true);
	wp_enqueue_script( 'jt', get_template_directory_uri() . '/js/jt.js', array(), '1.0.0', true);
    wp_enqueue_script( 'jt-strap', get_template_directory_uri() . '/js/jt-strap.js', array(), $version, true);
    wp_enqueue_script( 'main', get_template_directory_uri() . '/js/main.js', array(), $version, true);
    wp_enqueue_script( 'script-hee', get_template_directory_uri() . '/js/script-hee.js', array(), $version, true);
    wp_enqueue_script( 'script-hree', get_template_directory_uri() . '/js/script-hree.js', array(), $version, true);
    wp_enqueue_script( 'script-kms', get_template_directory_uri() . '/js/script-kms.js', array(), $version, true);
    wp_enqueue_script( 'motion', get_template_directory_uri() . '/js/motion.js', array(), $version, true);

}
add_action( 'wp_enqueue_scripts', 'jt_enqueue_style_script' );



/* ************************************** *
 * REMOVE JS TYPE ATTR (w3c validation)
 * ************************************** */
function jt_remove_type_attr($tag, $handle) {

    return preg_replace( "/type=['\"]text\/(javascript)['\"]/", '', $tag );

}
add_filter('script_loader_tag', 'jt_remove_type_attr', 10, 2);



/* ************************************** *
 * REGISTER MENU
 * ************************************** */
function jt_register_menus() {

    register_nav_menus(array(
        'main-menu' => __('메인메뉴'),
        'side-menu' => __('사이드메뉴'),
        'footer-menu' => __('푸터메뉴'),
        'small-menu' => __('모바일메뉴')
    ));

}
add_action( 'init', 'jt_register_menus' );



/* ************************************** *
 * Define GEOIP constant
 * ************************************** */
/*
function jt_init_geoip(){

 	if(!function_exists('geoip_country_code_by_addr')){
		// https://github.com/maxmind/geoip-api-php/blob/master/README.md
		require_once(get_template_directory().'/geoip/geoip.inc');

		// http://geolite.maxmind.com/download/geoip/database/GeoLiteCountry/GeoIP.dat.gz
		$gi = geoip_open(get_template_directory().'/geoip/GeoIP.dat',GEOIP_STANDARD);
	}

	$ip = $_SERVER['REMOTE_ADDR'];
	$ip_country_code = geoip_country_code_by_addr($gi, $ip);

    define('JT_GEOIP', $ip_country_code);

    geoip_close($gi);

}
add_action('init','jt_init_geoip');
*/



/* ************************************** *
 * Check if user come from china via IP
 * ************************************** */
/*
function jt_is_china(){

	if($_SERVER['REMOTE_ADDR'] === "115.22.23.125") {
		if(JT_GEOIP == 'CN'){
            return true;
		}else{
			return false;
		}
	}else{
		if(JT_GEOIP == 'CN'){
			return true;
		}else{
			return false;
		}
	}

}
*/



/* ************************************** *
 * 옵션페이지 설정 변경시 자동으로 캐쉬 지우기
 * ************************************** */
function jt_clear_cache_on_option_page_updated() {

    global $file_prefix;

    if ( function_exists( 'wp_cache_clean_cache' ) && $file_prefix ) {

        $screen = get_current_screen();

        if ( strpos( $screen->id, 'toplevel_page_' ) !== false && isset( $_POST[ '_acf_changed' ] ) && $_POST[ '_acf_changed' ] ) {

            wp_cache_clean_cache( $file_prefix, true );

        }

    }

}
add_action( 'acf/save_post', 'jt_clear_cache_on_option_page_updated', 20 );



/* ************************************** *
 * full 이미지와 동일한 image size 호출할시 원본을 리턴 :: 2021-09-08 [201]
 * ************************************** */
function jt_wp_get_attachment_image_src( $image, $attachment_id ) {
    list( $img_url, $img_width, $img_height, $img_intermediate ) = $image;
    $meta = wp_get_attachment_metadata( $attachment_id );

    if ( ! empty($meta['width']) && !empty($meta['height']) && $img_width == $meta['width'] && $img_height == $meta['height'] ) {
        return array(
            wp_get_attachment_url( $attachment_id ),
            $meta['width'],
            $meta['height'],
            $img_intermediate
        );
    }

    return $image;
}
add_filter( 'wp_get_attachment_image_src', 'jt_wp_get_attachment_image_src', 10, 2 );

/**
 * 현재 페이지의 메뉴 명 조회
*/
function get_current_menu_name($location = 'main-menu') {
    $locations = get_nav_menu_locations();

    if ( ! empty( $locations[$location] ) ) {
        $menu_items = wp_get_nav_menu_items( $locations[$location] );
        $current_menu = current(wp_filter_object_list($menu_items, array(
            'object_id' => get_queried_object_id(),
        )));

        if (!empty($current_menu)) {
            return $current_menu->title;
        }
    }

    return '';
}

/**
 * 파일 업로드 유형 및 확장명 유효성 검사
*/
function jt_custom_mime_types( $data, $file, $filename, $mimes ) {
  $filetype = wp_check_filetype( $filename, $mimes );

  return array(
    'ext'               => $filetype['ext'],
    'type'              => $filetype['type'],
    'proper_filename'   => $data['proper_filename']
  );
}
add_filter('wp_check_filetype_and_ext', 'jt_custom_mime_types', 10, 4);

/**
 * 이전 예약글 모두 발행 처리
*/
function jt_publish_past_future_posts() {
    global $wpdb;

    $args = array(
        'post_type'     => get_post_types(),
        'post_status'   => 'future',
        'fields'        => 'ids',
        'date_query'    => array(
            array(
                'column'    => 'post_date',
                'before'    => date_i18n('Y-m-d H:i:s'),
            ),
        ),

    );
    $post_ids = get_posts($args);

    if ( ! empty( $post_ids ) ) {
        foreach ( $post_ids as $post_id ) {
            wp_publish_post( $post_id );
        }
    }
}
add_action('init', 'jt_publish_past_future_posts');

/**
 * 메뉴 프로덕트, 스토어 active 표기 처리
*/
function jt_custom_nav_menu_css_class( $classes, $menu ) {
    $get_queried_id = get_queried_object_id();
    $menu_object_id = $menu->object_id;

    $menu_conditions = array(
        688 => array( 728, 731 ),
        475 => array( 488, 490 ),
    );

    if ( is_page() ) {
        foreach ( $menu_conditions as $parent_id => $child_ids ) {
            if ( $menu_object_id == wp_get_post_parent_id() || in_array( $get_queried_id, $child_ids ) && $menu_object_id == $parent_id ) {
                $classes = array_merge( $classes, array( 'current-menu-item', 'current_page_item' ) );
                break;
            }
        }
    }

    if (is_single()) {
        $url = $menu->url;
    
        if ( ! empty ( $url ) ) {
            $url_parts = parse_url( $url );
            $path = isset( $url_parts['path'] ) ? $url_parts['path'] : '';
            $slug = basename( $path );
    
            $sort_param = $_GET['sort'] ?? '';
            
            if ( ! empty ( $sort_param ) ) {
                if ( strcasecmp( str_replace( '-', ' ', $sort_param ), str_replace( '-', ' ', $slug ) ) === 0 || $menu->ID == 743 || $menu->ID == 515 || $menu->ID == 494 ) {
                    $classes = array_merge( $classes, ['current-menu-item', 'current_page_item'] );
                }
            } else {
                $post_id = get_the_ID();
                $terms = get_the_terms($post_id, 'product-categories');

                if ( ! empty ( $terms[0]->slug ) ) {
                    if ( strcasecmp( str_replace( '-', ' ', $terms[0]->slug ), str_replace( '-', ' ', $slug ) ) === 0 || $menu->ID == 743 || $menu->ID == 515 || $menu->ID == 494 ) {
                        $classes = array_merge( $classes, ['current-menu-item', 'current_page_item'] );
                    }
                }
            }
        }
    }

    return $classes;
}
add_filter( 'nav_menu_css_class', 'jt_custom_nav_menu_css_class', 10, 2 );

/**
 * 메뉴 프로덕트 링크 파라미터 처리
*/

function add_parameter_to_specific_menu_item( $items, $args ) {
    foreach ( $items as &$item ) {
        $parent_id = $item->menu_item_parent;
        $item_id = $item->ID;

        if ( ( $item_id == 1716 && $parent_id == 704 ) || ( $item_id == 522 && $parent_id == 520 ) ) {
            $item->url = add_query_arg( 'sort', 'popularity', $item->url );
        }
    }

    return $items;
}
add_filter( 'wp_nav_menu_objects', 'add_parameter_to_specific_menu_item', 10, 2 );

/**
 * 관리자 body 클래스 추가
*/

function custom_admin_body_class( $classes ) {
    $language = get_locale();

    if ( empty( $language ) || 'en_US' === $language ) {
        $classes .= ' en-US';
    } elseif ( 'ko_KR' === $language ) {
        $classes .= ' ko-KR';
    }

    return $classes;
}
add_filter( 'admin_body_class', 'custom_admin_body_class', 10, 2 );

/**
 * 영문 제품상세 us title 숨김
*/

function hide_field_based_on_language( $field ) {
    preg_match('/\/([a-zA-Z]{2})\//', $_SERVER['REQUEST_URI'], $matches);

    $field_names_to_show_on_korean_site = array(
        'us_title'
    );

    if ( $field['type'] === 'flexible_content' ) {
        foreach ( $field['layouts'] as &$layout ) {
            foreach ( $layout['sub_fields'] as &$sub_field ) {
                if ( in_array( $sub_field['name'], $field_names_to_show_on_korean_site ) ) {
                    if ( empty( $matches[1] ) ) {
                        $sub_field['wrapper']['class'] .= ' acf_us_title_hidden';
                    }
                }
            }
        }
    }

    return $field;
}
add_filter('acf/prepare_field', 'hide_field_based_on_language');

