<?php
/**
 * Name       : STUDIO JT 모듈 CLASS
 * namespace  : module
 * File       : /modules/module-class.php
 * Author     : STUDIO-JT (Nico)
 * Guideline  : JTstyle.2.0 (beta : add wp comment code standard)
 * Guideline  : https://codex.studio-jt.co.kr/dev/?p=2109
 *              https://make.wordpress.org/core/handbook/best-practices/coding-standards/php/
 *
 * CLASS SUMMARY:
 *
 * 01) construct
 * 02) enqueue_style_script
 * 03) enqueue_style_script
 * 04) create_post_type
 * 05) the_list
 * 06) search_form
 * 07) search_title
 * 08) search_content
 * 09) list_shortcode
 * 10) last_posts
 * 11) single_templates
 * 12) pass obj tosingle.php
 * 13) pagination
 * 14) track_post_views
 * 15) post_views
 * 16) enable_sticky
 * 17) attachments
 * 18) front_form
 *
 */


// Security (disable direct access).
defined( 'ABSPATH' ) or die( 'Nothing to see here.' );


/**
 * Class Jt_Module
 *
 * @author STUDIO-JT (Nico) <nico@studio-jt.co.kr>, STUDIO-JT (201) <201@studio-jt.co.kr>
 * @access public
 * @version 1.0.0
 */
class Jt_Module{

    public string $_namespace;
    public $_name;
    public $_menu;
    public $_slug;
    public $_support;
    public $_version;
    public $_pageid;
    public $_thumbnail_list;
    public $_gutenberg;
    public $_paging_with_pagecnt;

    /**
     * Constructor.
     *
     * @author STUDIO-JT (Nico)
     * @since 1.0.0
     * @access public
     *
     * @param string $namespace The namespace.
     * @param string $name.
     * @param string $menu.
     * @param string $slug.
     * @param array $support.
     * @param string $version.
     * @param string $pageid The page id where the shortcode is.
     */
    // public function __construct( $namespace, $name, $menu, $slug, $support, $support_cat, $version, $pageid = null ) {
    public function __construct( $params = array() ) {

        /*
        $this->_namespace       = $namespace;
        $this->_name            = $name;
        $this->_menu            = $menu;
        $this->_slug            = $slug;
        $this->_support         = $support;
        $this->_support_cat     = $support_cat;
        $this->_version         = $version;
        $this->_pageid          = $pageid;
        */

        $this->_namespace            = $this->is_set( $params[ 'namespace' ] );
        $this->_name                 = $this->is_set( $params[ 'name' ], $this->_namespace );
        $this->_menu                 = $this->is_set( $params[ 'menu' ], $this->_name );
        $this->_slug                 = $this->is_set( $params[ 'slug' ], $this->_name );
        $this->_support              = $this->is_set( $params[ 'support' ], array( 'title', 'editor', 'excerpt', 'thumbnail' ) );
        $this->_support_cat          = $this->is_set( $params[ 'support_cat' ], false );
        $this->_version              = $this->is_set( $params[ 'version' ], defined('VERSION') ? VERSION : '1.0.0' );
        $this->_pageid               = $this->is_set( $params[ 'pageid' ], null );
        $this->_thumbnail_list       = $this->is_set( $params[ 'thumbnail_list' ], false );
        $this->_gutenberg            = ( $this->is_set( $params[ 'gutenberg' ], true ) && in_array( 'editor', $this->_support ) );
		$this->_use_single           = $this->is_set( $params[ 'use_single' ], true );
        $this->_exclude_from_search  = $this->is_set( $params[ 'exclude_from_search' ], true );
		$this->_show_in_nav_menus    = $this->is_set( $params[ 'show_in_nav_menus' ], true );
        $this->_is_sticky            = $this->is_set( $params[ 'is_sticky' ], true );
        $this->_paging_with_pagecnt  = $this->is_set( $params['paging_with_pagecnt'], false );

        // ACTIONS
        if ( $this->is_set( $this->_namespace ) ) {

            add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_style_script' ), 9999 );
            add_action( 'init', array( $this, 'create_post_type' ) );
            add_action( 'wp_head', array( $this, 'track_post_views' ) );

            add_action( 'loop_start', array( $this, 'pass_obj_to_single' ), 10, 1 );
            add_action( 'acf/init', array( $this, 'acf_field' ) );

            add_action( 'add_meta_boxes', array( $this, 'meta_boxes' ) );
            add_action( 'save_post', array( $this, 'save_post' ) );

            // FILTERS
            add_filter( 'template_include', array( $this, 'single_template_include' ) );
            add_filter( 'posts_search', array( $this, 'search_title' ), 10, 2 );
            add_filter( 'posts_search', array( $this, 'search_content' ), 10, 2 );
            add_filter( 'posts_orderby', array( $this, 'orderby_sticky_first' ), 10, 2 );

            // SHORTCODES
            add_shortcode( $this->_namespace, array( $this,'list_shortcode' ) );

            // OPTIONS Category
            if ( $this->_support_cat === true ) {

                add_action( 'init', array( $this, 'create_taxonomy' ) );

                // 관리자 뷰 카테고리 필터 추가
                add_action( 'restrict_manage_posts', array( $this, 'admin_filter_category_selector' ) );
                add_action( 'admin_head', array( $this, 'admin_category_style' ) );

            }

            if ( $this->_thumbnail_list ) {

                add_action( 'admin_head', array( $this, 'admin_thumb_style' ) );
                add_filter( 'manage_' . $this->_namespace . '_posts_columns', array( $this, 'admin_thumb_columns' ) );
                add_action( 'manage_' . $this->_namespace . '_posts_custom_column', array( $this, 'admin_thumb_column_value' ), 10, 2 );

            }

            // GUTENBERG
            if ( ! $this->_gutenberg ) {

                add_action( 'post_submitbox_misc_actions', array( $this,'enable_sticky' ) );

            }
            add_filter( 'use_block_editor_for_post_type', array( $this, 'disable_gutenberg' ), 10, 2 );


            // Add Current Menu Class
            add_filter( 'nav_menu_css_class', array( $this, 'menu_css' ), 10, 2 );

        }

    }

    /**
     * Style and script enqueue.
     *
     * Enqueue style and script only if exist.
     *
     * @author STUDIO-JT (Nico)
     * @since 1.0.0
     * @access public
     */
    public function enqueue_style_script() {

        $version     = $this->_version;
        $namespace   = $this->_namespace;
        $style_path  = '/modules/' . $namespace . '/style.css';
        $script_path = '/modules/' . $namespace . '/script.js';

        if ( file_exists( get_template_directory() . $style_path ) ) {

            wp_enqueue_style( 'jt-' . $namespace . '-style', get_template_directory_uri() . $style_path, array(), $version );

        }

        if ( file_exists( get_template_directory() . $script_path ) ) {

            wp_enqueue_script( 'jt-' . $namespace . '-script', get_template_directory_uri() . $script_path, array(), $version, true );

        }

    }

    /**
     * Register post type.
     *
     * @author STUDIO-JT (Nico)
     * @since 1.0.0
     * @access public
     *
     * @uses register_post_type().
     */
    public function create_post_type() {

        $name    = $this->_name;
        $menu    = $this->_menu;
        $slug    = $this->_slug;
        $support = $this->_support;
		$use_single = $this->_use_single;
		$exclude_from_search = $this->_exclude_from_search;
		$show_in_nav_menus = $this->_show_in_nav_menus;

        $labels  = array(
            'name'               => $name,
            'singular_name'      => $name,
            'add_new'            => '새 ' . $name . ' 등록',
            'add_new_item'       => $name . ' 등록',
            'edit_item'          => $name . ' 수정',
            'new_item'           => '새 ' . $name,
            'all_items'          => '모든 ' . $name,
            'view_item'          => $name . ' 보기',
            'search_items'       => '검색',
            'not_found'          => $name . ' 없음',
            'not_found_in_trash' => '휴지통에 ' . $name . ' 없음',
            'parent_item_colon'  => '',
            'menu_name'          => $menu
        );

        register_post_type(
            $this->_namespace,
            array(
                'labels'        => $labels,
                'public'        => true,
                'show_ui'       => true,
                'show_in_rest'  => true, // use block editor
                'has_archive'   => false, // Avoid conflict with same slug page
                'rewrite'       => array( 'slug' => $slug ),
                'supports'      => $support,
                'query_var'     => $use_single,
				'publicly_queryable'  => $use_single,
                'exclude_from_search' => $exclude_from_search,
                'show_in_nav_menus'   => $show_in_nav_menus
            )
        );

        // Avoid conflict with same slug page in the pagination
        add_rewrite_rule('^'.$slug.'/page/([0-9]+)','index.php?pagename='.$slug.'&paged=$matches[1]', 'top');

        flush_rewrite_rules();

    } // END create_post_type



    /**
     * Register taxonomy
     *
     * @author STUDIO-JT (Nico)
     * @since 1.0.0
     * @access public
     *
     * @uses register_taxonomy().
     */
     public function create_taxonomy() {

        $namespace = $this->_namespace;
        $name      = $this->_name;

        register_taxonomy(
            $namespace . '_categories',
            $namespace,
            array(
                'hierarchical'      => true,
                'label'             => $name . ' 분류',
                'query_var'         => true,
                'show_in_rest'      => true,
                'rewrite'           => array( 'slug' => $name . '-분류' ),
                'show_admin_column' => true,
            )
        );

    }



    public function admin_category_style() {

        echo '<style>';
            echo '.column-taxonomy-' . $this->_namespace . '_categories { width: 15%; }';
        echo '</style>';


    }


    /**
     * Add Category Selector For Admin List View Filter
     *
     * @author STUDIO-JT ( 201 )
     * @since 1.0.0
     * @access public
     *
     * @param array $columns
     */
    public function admin_filter_category_selector() {

        $post_type  = esc_attr( isset( $_REQUEST[ 'post_type' ] ) ? $_REQUEST[ 'post_type' ] : 'post' );
        $namespace  = $this->_namespace;

        if ( $post_type == $namespace ) {

            $jt_cat = urldecode( isset( $_REQUEST[ $namespace . '_categories' ] ) ? esc_attr($_REQUEST[ $namespace . '_categories' ]) : '' );
            $terms  = get_terms( array( 'taxonomy' => $namespace . '_categories', 'hide_empty' => false ) );

            echo '<select name="' . $namespace . '_categories">';
                echo '<option value="">모든 카테고리</option>';

                foreach ( $terms as $term ) {

                    echo '<option value="' . $term->slug . '" ' . selected( $jt_cat, urldecode( $term->term_id ), false ) . '>' . $term->name . '</option>';

                }

            echo '</select>';

        }

    }



    /**
     * Display the category menu.
     *
     * Build custom url instead of wp native term url
     * because wp taxonomy template do not work very
     * well with sidebar
     *
     * @author STUDIO-JT (Nico)
     * @since 1.0.0
     * @access public
     *
     * @uses get_terms().
     * @uses is_wp_error().
     * @uses esc_url().
     */
    public function category_menu($childof = 0) {

        $post_id     = get_the_ID();
        $current_url = get_permalink( $post_id );
        $namespace   = $this->_namespace;
        $cate         = ( ! empty( $_REQUEST[ 'cate' ] ) ? esc_attr( $_REQUEST[ 'cate' ] ) : '' );
        $terms       = get_terms( array( 'taxonomy' => $namespace . '_categories', 'hide_empty' => false, 'child_of' => $childof ) );

        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
            $template_path   = get_template_directory() . '/modules/' . $namespace . '/category.php';
            $template_folder = file_exists( $template_path ) ? $namespace : 'jt-module-template';
            include get_template_directory() . '/modules/' . $template_folder . '/category.php';
        }

    } // END create_post_type



    /**
     * Display the list.
     *
     * Display or return the list of the current postype.
     *
     * @author STUDIO-JT (Nico)
     * @since 1.0.0
     * @access public
     *
     * @uses WP_Query().
     * @uses get_query_var().
     * @uses esc_attr().
     *
     * @param int $num Number post per page, If empty use wp default value set in the admin.
     * @param mixed $cat The id or list of ids of the category .
     * @param string $layout The layout type you want list,grid,isotope. you can add your own by adding list.php file in module folder.
     * @param string $col Number of column for the grid or isotope layout
     * @param array An array of component you want to display or not in the list template (defaut is all show except category)
     * @param bool $echo Echo or return the markup result Default true.
     *
     */
    public function the_list( $num = 0, $cat = null, $echo = true ) {

        // Set post per page
        if ( empty( $num ) ) {

            $num = get_option( 'posts_per_page' );

        }

        // Get posttype namespace and init some var
        $namespace   = $this->_namespace;
        $menu_name   = $this->_menu;
        $type        = $this->_namespace;
        $tax         = $namespace . '_categories';
        $total_found = 0;
        $item_class  = '';
        $paged       = max( 1, intVal( get_query_var( 'paged' ) ) );
        $args        = array( 'post_type' => $type , 'posts_per_page' => $num, 'paged' => $paged );

        // If category

        if ( ! empty( $cat ) || ! empty( $_REQUEST[ 'cate' ] ) ) {

            if ( ! empty( $_REQUEST[ 'cate' ] ) ) {

                $cate = $_REQUEST[ 'cate' ];
                $field = 'slug';

            }else{
                $cate = $cat;
                $field = 'term_id';
            }

            $args[ 'tax_query' ] = array( array( 'taxonomy' => $tax, 'field' => $field ,'terms' => esc_attr( $cate ) ) );

        }

        // If search
        if ( ! empty( $_REQUEST[ 'search' ] ) ) {

            $search = esc_attr( $_REQUEST[ 'search' ] );

            if ( ($_REQUEST[ 'type' ] ?? '') == 'title' ) {

                $args[ 'search_title' ] = $search;

            } elseif ( ($_REQUEST[ 'type' ] ?? '') == 'content' ) {

                $args[ 'search_content' ] = $search;

            } else {

                $args[ 's' ] = $search;

            }
        }

        // Set the loop
        $loop = new WP_Query( $args );

        // Count number of post
        if ( $loop->have_posts() ) {

            $current_paged  = max( 1, get_query_var( 'paged' ) );
            $max_page       = $loop->max_num_pages;
            $total_found    = $loop->found_posts;
            $posts_per_page = $loop->post_count;

            if ( $current_paged == 1 ) {

                $count = $total_found;

            } elseif ( $current_paged == $max_page ) {

                $count = $posts_per_page;

            } elseif ( $total_found > $posts_per_page ) {

                $count = $total_found - ( ( $paged - 1 ) * $posts_per_page );

            }

        }

        // Include list Custom Template if exist.
        $template_path   = get_template_directory() . '/modules/' . $namespace . '/list.php';
        $template_folder = file_exists( $template_path ) ? $namespace : 'jt-module-template';

        ob_start();

        include get_template_directory() . '/modules/' . $template_folder . '/list.php';
        $output = ob_get_contents();

        ob_end_clean();

        // Print or retrun
        if ( $echo ) {

            echo $output;

        } else {

            return $output;

        }

    } // END the_list




    /**
     * Create the list shortcode.
     *
     * @author STUDIO-JT (Nico)
     * @since 1.0.0
     * @access public
     */
    public function list_shortcode( $atts ) {

        $a = shortcode_atts(
            array(
                'num' => 0,
                'cat' => null
            ),
            $atts
        );

        return $this->the_list( $a[ 'num' ], $a[ 'cat' ], false );

    }



    /**
     * Get search form.
     *
     * @author STUDIO-JT (Nico)
     * @since 1.0.0
     * @access public
     */
    public function search_form() {

        $s_val  = ( ! empty( $_REQUEST[ 'search' ] ) ? esc_attr( $_REQUEST[ 'search' ] ) : '' );
        $s_type = ( ! empty( $_REQUEST[ 'type' ] )   ? esc_attr( $_REQUEST[ 'type' ] )   : '' );

        // Include last post custom Template if exist.
        $template_path   = get_template_directory() . '/modules/' . $this->_namespace . '/search.php';
        $template_folder = file_exists( $template_path ) ? $this->_namespace : 'jt-module-template';

        ob_start();
        include get_template_directory() . '/modules/' . $template_folder . '/search.php';
        $html = ob_get_clean();

        return $html;

    }


    /**
     * Search title filter.
     *
     * @author STUDIO-JT (Nico)
     * @since 1.0.0
     * @access public
     */
    public function search_title( $search, $loop ) {

        global $wpdb;

        if ( $search_term = $loop->get( 'search_title' ) ) {

            $search .= ' AND ' . $wpdb->posts . ".post_title LIKE '%" . esc_sql( $wpdb->esc_like( $search_term ) ) . "%' ";

            if ( ! is_user_logged_in() ) {

                $search .= ' AND ' . $wpdb->posts . ".post_password = '' ";

            }

        }

        return $search;

    }


    /**
     * Search content filter.
     *
     * @author STUDIO-JT (Nico)
     * @since 1.0.0
     * @access public
     */
    public function search_content( $search, $loop ) {

        global $wpdb;

        if ( $search_term = $loop->get( 'search_content' ) ) {

            $search .= ' AND ' . $wpdb->posts . ".post_content LIKE '%" . esc_sql( $wpdb->esc_like( $search_term ) ) . "%' ";

            if ( ! is_user_logged_in() ) {

                $search .= ' AND ' . $wpdb->posts . ".post_password = '' ";

            }

        }

        return $search;

    }


    /**
     * Order By Sticky Posts First
     *
     * @author STUDIO-JT (201)
     * @since 1.0.0
     * @access public
     */
    public function orderby_sticky_first( $orderby_statement, $wp_query ) {

        if ( $wp_query->get( 'post_type' ) == $this->_namespace ) {

            global $wpdb;

            $sticky_posts = get_option( 'sticky_posts' );

            if ( count( $sticky_posts ) > 0 ) {

                $str_sticky_posts = is_array( $sticky_posts ) ? implode( ',', $sticky_posts ) : $sticky_posts;
                $str_order        = " CASE WHEN {$wpdb->posts}.ID IN ( {$str_sticky_posts} ) THEN 0 ELSE 1 END ASC ";
                $res_order        = ( $orderby_statement ? $str_order . ',' . $orderby_statement : $str_order );

                return $res_order;

            }

        }

        return $orderby_statement;

    }


    /**
     * Get and display last post template.
     *
     * @author STUDIO-JT (Nico)
     * @since 1.0.0
     * @access public

     * @param mixed $cat The id or list of ids of the category .
     */
    public function last_posts( $num = 3 , $cat = null) {

        $type  = $this->_namespace;
        $tax   = $type . '_categories';
        $args  = array( 'post_type' => $type , 'posts_per_page' => $num, 'ignore_sticky_posts' => true );

        // If category
        if ( ! empty( $cat ) ) {

            $cate = $cat;
            $field = 'slug';

            $args[ 'tax_query' ] = array( array('taxonomy' => $tax, 'field' => $field , 'terms' => esc_attr( $cate ) ) );

        }

        $loop  = new WP_Query( $args );

        // Include last post custom Template if exist.
        $template_path   = get_template_directory() . '/modules/' . $type . '/last.php';
        $template_folder = file_exists( $template_path ) ? $type : 'jt-module-template';

        include get_template_directory() . '/modules/' . $template_folder . '/last.php';

    }


    /**
     * Hook the WP native single.php template.
     *
     * @author STUDIO-JT (Nico)
     * @since 1.0.0
     * @access public
     *
     * @uses is_singular()
     */
    public function single_template_include( $template ) {

        $namespace  = $this->_namespace;
        $post_types = array($namespace);

        if ( is_singular( $post_types ) ) {

            // Include single custom Template if exist.
            $template_path   = get_template_directory() . '/modules/' . $namespace . '/single.php';
            $template_folder = file_exists( $template_path ) ? $namespace : 'jt-module-template';
            $new_template    = get_template_directory() . '/modules/' . $template_folder . '/single.php';

            if ( '' != $new_template ) {

                return $new_template;

            }

        }

        return $template;

    }



    /**
     * Make module object global on the single template.
     *
     * Pass the full object for better templating.
     *
     * @author STUDIO-JT (Nico)
     * @since 1.0.0
     * @access public
     *
     * @todo Find a way to not use GLOBALS
     *
     * @uses is_singular()
     */
    public function pass_obj_to_single() {

        if ( is_singular( $this->_namespace ) ) {

             $GLOBALS[ 'jt_module' ] = $this;

        }

    }



    /**
     * Pagination.
     *
     * @author STUDIO-JT (201)
     * @since 1.0.0
     * @access public
     *
     * @uses esc_url()
     * @uses get_pagenum_link()
     * @uses get_query_var()
     * @uses wp_is_mobile()
     * @uses paginate_links()
     *
     * @param object $loop The current WP_Query
     */
    public function pagination( $loop, $page_cnt = 5, $echo = false ) {

        $current_url  = str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) );
        $total_page   = $loop->max_num_pages;
        $current_page = max( 1, get_query_var( 'paged' ) );

        if ( $total_page <= 1 ) return;

        if ( wp_is_mobile() ) {

            $page_cnt = 3;

        }

        if ( $this->_paging_with_pagecnt !== true ) { // + 1

            $separator  = floor( $page_cnt / 2 );
            $paging     = '';
            $arr_page   = range( $current_page - $separator, $current_page + $separator );
            $arr_page   = array_filter( $arr_page, function ( $val ) use( $total_page ) { return $val > 0 && $val <= $total_page; } );

            if($arr_page){
				while( count( $arr_page) < $page_cnt ) {

					if ( max( $arr_page ) + 1 <= $total_page ) {

						$arr_page[] = max( $arr_page ) + 1;

					} else {

						break;

					}

				}

				while( count( $arr_page) < $page_cnt ) {

					if ( min( $arr_page ) - 1 > 0 ) {

						$arr_page[] = min( $arr_page ) - 1;

					} else {

						break;

					}

				}
				sort( $arr_page );

				$start_page = min( $arr_page ) ?: 1;
				$end_page   = max( $arr_page ) ?: 1;

				if ( $current_page > 1 ) {

					$paging .= '<a data-barba-prevent class="jt-pagination--first jt-pagination__numbers" href="' . str_replace( '%#%', 1, $current_url ) . '"><span class="sr-only">첫 페이지</span><i class="jt-icon">' . jt_get_icon('jt-first') . '</i></a>' . "\n";
					$paging .= '<a data-barba-prevent class="jt-pagination--prev jt-pagination__numbers" href="' . str_replace( '%#%', ( $current_page - 1 > 1 ? $current_page - 1 : 1 ), $current_url ) . '"><span class="sr-only">이전 페이지</span><i class="jt-icon">' . jt_get_icon('jt-prev') . '</i></a>' . "\n";

				}

				for ( $i = $start_page; $i <= $end_page; $i++ ) {

					if ($i == $current_page) {

						$paging .= '<span class="jt-pagination--current jt-pagination__numbers">' . $i . '</span>' . "\n";

					} else {

						$paging .= '<a data-barba-prevent class="jt-pagination__numbers" href="' . str_replace( '%#%', $i, $current_url ) . '">' . $i . '</a>' . "\n";

					}

				}

				if ( $current_page < $total_page ) {

					$paging .= '<a data-barba-prevent class="jt-pagination--next jt-pagination__numbers" href="' . str_replace( '%#%', ( $current_page + 1 < $total_page ? $current_page + 1 : $total_page ), $current_url ) . '"><span class="sr-only">다음 페이지</span><i class="jt-icon">' . jt_get_icon('jt-next') . '</i></a>' . "\n";
					$paging .= '<a data-barba-prevent class="jt-pagination--last jt-pagination__numbers" href="' . str_replace( '%#%', $total_page, $current_url ) . '"><span class="sr-only">마지막 페이지</span><i class="jt-icon">' . jt_get_icon('jt-last') . '</i></a>' . "\n";

				}
			} // End if $arr_page

        } else { // + $page_cnt

            $start_page   = floor( ( $current_page - 1 ) / $page_cnt ) * $page_cnt + 1;
            $end_page     = $start_page + $page_cnt < $total_page ? $start_page + $page_cnt : $total_page + 1;

            $first_pager  = 1;
            $prev_pager   = ( ( $start_page - 1 ) / $page_cnt ) * $page_cnt > 1 ? ( ( $start_page - 1 ) / $page_cnt ) * $page_cnt : 1;
            $next_pager   = ( $end_page /$page_cnt ) * $page_cnt < $total_page ? ( $end_page /$page_cnt ) * $page_cnt : $total_page;
            $last_pager   = $total_page;

            $paging       = '';

            if ( $current_page > 1 ) {

                $paging .= '<a data-barba-prevent class="jt-pagination--first jt-pagination__numbers" href="' . str_replace( '%#%', $first_pager, $current_url ) . '"><span class="sr-only">첫 페이지</span><i class="jt-icon">' . jt_get_icon('jt-first') . '</i></a>' . "\n";
                $paging .= '<a data-barba-prevent class="jt-pagination--prev jt-pagination__numbers" href="' . str_replace( '%#%', $prev_pager, $current_url ) . '"><span class="sr-only">이전 페이지</span><i class="jt-icon">' . jt_get_icon('jt-prev') . '</i></a>' . "\n";

            }

            for ( $i = $start_page; $i < $end_page; $i++ ) {

                if ($i == $current_page) {

                    $paging .= '<span class="jt-pagination--current jt-pagination__numbers">' . $i . '</span>' . "\n";

                } else {

                    $paging .= '<a data-barba-prevent class="jt-pagination__numbers" href="' . str_replace( '%#%', $i, $current_url ) . '">' . $i . '</a>' . "\n";

                }

            }

            if ( $current_page < $total_page ) {

                $paging .= '<a data-barba-prevent class="jt-pagination--next jt-pagination__numbers" href="' . str_replace( '%#%', $next_pager, $current_url ) . '"><span class="sr-only">다음 페이지</span><i class="jt-icon">' . jt_get_icon('jt-next') . '</i></a>' . "\n";
                $paging .= '<a data-barba-prevent class="jt-pagination--last jt-pagination__numbers" href="' . str_replace( '%#%', $last_pager, $current_url ) . '"><span class="sr-only">마지막 페이지</span><i class="jt-icon">' . jt_get_icon('jt-last') . '</i></a>' . "\n";

            }

        }

        if ( $echo ) {

            echo $paging;

        } else {

            return $paging;

        }

    }



    /**
     * Loadmore Pagination.
     *
     * @author STUDIO-JT (KMS,NICO)
     * @since 1.0.1
     * @access public
     *
     * @uses esc_url()
     * @uses get_pagenum_link()
     * @uses get_query_var()
     *
     * @param object $loop The current WP_Query
     */
    public function loadmore( $loop, $html = "<span>LOAD MORE</span>", $list = "", $history = "", $css_class = "jt-loadmore__btn jt-btn__basic jt-btn--type-01", $echo = true) {

        $current_url  = str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) );
        $total_page   = $loop->max_num_pages;
        $current_page = max( 1, get_query_var( 'paged' ) );
        $num          = $loop->query_vars[ 'posts_per_page' ];
        $paging       = '';

        if ( $total_page > $current_page ) {

            $paging .= '<div id="jt-loadmore" class="jt-loadmore">';
                $paging .= '<a class="'.$css_class.'" data-loadmore-list="'. $list .'" data-loadmore-history="'. $history .'" data-ppp="' . $num . '" href="' . str_replace( '%#%', ( $current_page + 1 < $total_page ? $current_page + 1 : $total_page ), $current_url ) . '">';
                    $paging .= $html;
                    $paging .= '<div class="jt-loadmore__spinner">';
                        $paging .= '<div class="jt-loadmore__spinner_ball_01"></div>';
                        $paging .= '<div class="jt-loadmore__spinner_ball_02"></div>';
                        $paging .= '<div class="jt-loadmore__spinner_ball_03"></div>';
                    $paging .= '</div>';
                $paging .= '</a>';
            $paging .= '</div><!-- .jt-loadmore -->';

        }

        if ( $echo ) {

            echo $paging;

        } else {

            return $paging;

        }

    }



    /**
     * Run the jt_set_post_views function on each single post
     *
     * Be sure to set remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0); keep view accurate (no prefeching)
     *
     * @author STUDIO-JT (Nico)
     * @since 1.0.0
     * @access public
     *
     * @uses is_singular
     * @uses get_the_ID
     * @uses get_post_meta
     * @uses delete_post_meta
     * @uses add_post_meta
     * @uses update_post_meta
     *
     */
    public function track_post_views () {

        $type = $this->_namespace;

        if ( is_singular( $type ) ) {

            $post_id   = get_the_ID();
            $count_key = 'jt_post_views_count';
            $count     = get_post_meta( $post_id, $count_key, true );

            if ( $count == '' ) {

                $count = 0;
                delete_post_meta( $post_id, $count_key );
                add_post_meta( $post_id, $count_key, '0' );

            } else {

                $count++;
                update_post_meta( $post_id, $count_key, $count );

            }

        }

    }



    /**
     * Display the number of view of the current page
     *
     * @author STUDIO-JT (Nico)
     * @since 1.0.0
     * @access public
     *
     * @uses get_the_ID()
     * @uses get_post_meta()
     * @uses update_post_meta()
     *
     * @param int $post_id The id of the post you want to retrieve the number of view, Default the current post id
     */
    public function post_views( $post_id = null ) {

        if ( empty ( $post_id ) ) {

            $post_id = get_the_ID();

        }

        $count_key = 'jt_post_views_count';
        $count     = get_post_meta( $post_id, $count_key, true );

        if ( $count == '' ) {

            update_post_meta( $post_id, $count_key, '0' );
            $count = '0';

        }

        return number_format( $count );

    }



    /**
     * Enable sticky(공지) for custom post type
     *
     * @author STUDIO-JT (Nico)
     * @since 1.0.0
     * @access public
     */
    public function enable_sticky( $post ) {

        if ( $post->post_type === $this->_namespace ) {

            echo  '<div style="padding: 5px 0 15px 0">';
                echo '<span id="sticky-span" style="margin-left:12px;">';
                    echo '<input id="sticky" name="sticky" type="checkbox" value="sticky" ' . checked( is_sticky( $post->ID ), true, false ) . ' />';
                    echo ' ';
                    echo '<label for="sticky" class="selectit">공지</label>';
                echo '</span>';
            echo '</div>';

        }

    }



    /**
     * Display comments.
     *
     * Display or return the comments of the current postype.
     *
     * @author STUDIO-JT (201)
     * @since 1.0.0
     * @access public
     *
     * @uses comments_open().
     * @uses get_comments_number().
     * @uses comments_template().
     */
    public function jt_comments() {

         // If comments are open or we have at least one comment, load up the comment template.
        if ( comments_open() || get_comments_number() ) {

            comments_template();

        }

    }



    /**
     * Display attachments.
     *
     * Display or return the attachments of the current postype.
     *
     * @author STUDIO-JT (201)
     * @since 1.0.0
     * @access public
     *
     * @uses get_post_meta().
     * @uses get_the_ID().
     *
     * @param bool $echo Echo or return the markup result Default true.
     *
     */
    public function attachments( $echo = true ) {

        $namespace = $this->_namespace;

        // Get the attachment row
        $jt_download = get_post_meta( get_the_ID(), 'jt_download', true );
        $jt_download = $jt_download ? unserialize( $jt_download ) : array();

        // Include attachments Custom Template if exist.
        $template_path   = get_template_directory() . '/modules/' . $namespace . '/attachments.php';
        $template_folder = file_exists( $template_path ) ? $namespace : 'jt-module-template';

        ob_start();

        include get_template_directory() . '/modules/' . $template_folder . '/attachments.php';
        $output = ob_get_contents();

        ob_end_clean();

        // Print or retrun
        if ( $echo ) {

            echo $output;

        } else {

            return $output;

        }

    }



    /**
     * Hook save post for jt_download.
     *
     *
     * @author STUDIO-JT (201)
     * @since 1.0.0
     * @access public
     *
     * @uses get_post_type().
     * @uses update_post_meta().
     *
     * @param int $post_id Post ID.
     *
     */
    public function save_post( $post_id ) {


        $post_type = get_post_type( $post_id );

        if ( $post_type == $this->_namespace && in_array( 'jt_download', $this->_support ) ) {

            $jt_downloads = array();

            if ( isset( $_POST[ 'jt_download' ] ) && count( $_POST[ 'jt_download' ] ) > 0 ) {

                $jt_download = $_POST[ 'jt_download' ];

                if ( is_array( $jt_download ) && count( $jt_download) > 0 ) {

                    foreach ( $jt_download as $jt_download_item ) {

                        if ( intVal( $jt_download_item ) > 0 ) {

                            $jt_downloads[] = intVal( $jt_download_item );

                        }

                    } unset( $jt_download_item );

                }

            }

            update_post_meta( $post_id, 'jt_download', serialize( $jt_downloads ) );

        }

    }


    /**
     * Get attachment info With Attachment ID
     *
     *
     * @author STUDIO-JT (201)
     * @since 1.0.0
     * @access private
     *
     * @uses get_attached_file().
     * @uses wp_get_attachment_url().
     * @uses get_post_time().
     * @uses wp_get_attachment_image_src().
     *
     * @param int $attachment_id Attachment ID.
     *
     * @return object Return Attachment File Object
     *
     */
    protected function jt_download_get_info( $attachment_id ) {

        $full_path = get_attached_file( $attachment_id );

        if ( file_exists( $full_path ) ) {

            $path    = pathinfo( $full_path );
            $thumb_src = wp_get_attachment_image_src( $attachment_id, 'thumbnail', true );
            $arr_res = array(
                'file_url'     => wp_get_attachment_url( $attachment_id ),
                'full_path'    => $full_path,
                'file_name'    => $path[ 'basename' ],
                'file_size'    => filesize( $full_path ),
                'uploaded'     => get_post_time( 'U', true, $attachment_id ),
                'icon'         => $thumb_src[ 0 ],
                'download_url' => ( file_exists( ABSPATH . '/d.php' ) ? '/d.php?post_id=' . get_the_ID() . '&attachment_id=' . $attachment_id : wp_get_attachment_url( $attachment_id ) )
            );

            return ( object ) $arr_res;

        } else {

            return null;

        }

    }



    /**
     * Add Metabox For JT Attachment
     *
     *
     * @author STUDIO-JT (201)
     * @since 1.0.0
     * @access private
     *
     * @uses add_meta_box().
     *
     */
    public function meta_boxes() {

        if ( in_array( 'jt_download', $this->_support ) ) {

            // add_meta_box( string $id, string $title, callable $callback, string|array|WP_Screen $screen = null, string $context = 'advanced', string $priority = 'default', array $callback_args = null )
            add_meta_box( 'jt_custom_attachement', '첨부파일', array( $this, 'jt_metabox_sticky_attachment' ), $this->_namespace );

        }

        if ( $this->_gutenberg ) {

            if ( $this->_is_sticky ) {

                add_meta_box( 'jt_sticky', '공지사항', array( $this, 'jt_metabox_sticky' ), $this->_namespace, 'side' );

            }

        }

    }



    /**
     * Display attachment meta box
     *
     *
     * @author STUDIO-JT (201)
     * @since 1.0.0
     * @access private
     *
     * @uses wp_enqueue_script().
     * @uses wp_enqueue_media().
     * @uses get_post_meta().
     * @uses get_the_ID().
     *
     */
    public function jt_metabox_sticky_attachment() {

        // Call WP Media Upload API
        wp_enqueue_script( 'media-upload' );
        wp_enqueue_media();

        $jt_download    = get_post_meta( get_the_ID(), 'jt_download', true );
        $jt_download    = $jt_download ? unserialize( $jt_download ) : array();
        ?>
        <ul class="jt_download_list">

            <?php if ( count( $jt_download ) > 0 ) : ?>

                <?php foreach ( $jt_download as $attachment_id ) : $jt_download_item = $this->jt_download_get_info( $attachment_id ); ?>

                    <li class="jt_download_item">
                        <div class="attachment-info">
                            <input type="hidden" name="jt_download[]" value="<?php echo $attachment_id; ?>" />
                            <div class="thumbnail thumbnail-application">
                                <img src="/wp-includes/images/media/default.png" class="icon" draggable="false" alt="">
                            </div>
                            <div class="details">
                                <div class="filename"><a href="<?php echo $jt_download_item->download_url; ?>" target="_blank"><?php echo $jt_download_item->file_name; ?></a></div>
                                <div class="uploaded"><?php echo date( 'Y년 n월 j일', $jt_download_item->uploaded ); ?></div>
                                <div class="file-size"><?php echo sprintf( '%.02f MB', $jt_download_item->file_size / 1024 / 1024 ); ?></div>
                            </div>
                            <div class="attachment-button" style="position:relative;">
                                <button type="button" class="media-modal-close jt_download_select_item" style="width:20px;height:20px;right:35px;">
                                    <span class="dashicons dashicons-edit"></span>
                                </button>
                                <button type="button" class="media-modal-close jt_download_del_item" style="width:20px;height:20px;right:15px;">
                                    <span class="dashicons dashicons-no"></span>
                                </button>
                            </div>
                        </div>
                        <div class="attachment-add" style="border-bottom:1px solid #ddd;padding-bottom:11px;display:none;">
                            <button class="button jt_download_select_item">첨부파일 선택</button>
                            <button class="button jt_download_del_item">삭제</button>
                        </div>
                    </li>

                <?php endforeach; unset( $item, $jt_download_item ); ?>

            <?php endif; ?>

        </ul>
        <p style="text-align:right;">
            <button class="button jt_download_add_item">새 첨부파일 추가</button>
        </p>

       <script>
        jQuery( function ( $ ) {

            $( 'button.jt_download_select_item' ).off( 'click' ).on( 'click', jt_download_select_item_action );
            $( 'button.jt_download_add_item' ).off( 'click' ).on( 'click', jt_download_add_item_action );
            $( 'button.jt_download_del_item' ).off( 'click' ).on( 'click', jt_download_del_item_action );

            function jt_download_select_item_action() {

                var $button = $( this );

                if ( ! $button.is( 'button.jt_download_select_item' ) ) {

                    return false;

                }

                // Create the media frame.
                var file_frame = wp.media.frames.file_frame = wp.media( {
                    title    : '첨부파일 선택',
                    button   : { text: 'Select' },
                    multiple : false // Set to true to allow multiple files to be selected
                } );

                // When an image is selected, run a callback.
                file_frame.on( 'select', function () {

                    // We set multiple to false so only get one image from the uploader
                    var attachment = file_frame.state().get( 'selection' ).first().toJSON();

                    var $jt_download_item = $button.parents( 'li.jt_download_item:first' );

                    $( 'div.thumbnail img', $jt_download_item ).attr( 'src', '/wp-includes/images/media/default.png' );
                    $( 'input[name="jt_download[]"]', $jt_download_item ).val( attachment.id );
                    $( 'div.filename a', $jt_download_item ).attr( 'href', attachment.url );
                    $( 'div.filename a', $jt_download_item ).text( attachment.filename );
                    $( 'div.uploaded', $jt_download_item ).text( attachment.dateFormatted );
                    $( 'div.file-size', $jt_download_item ).text( ( attachment.filesizeInBytes / 1024 / 1024 ).toFixed( 2 ) + ' MB' );

                    $( 'div.attachment-add', $jt_download_item ).hide();
                    $( 'div.attachment-info', $jt_download_item ).show();

                } );

                // Finally, open the modal
                file_frame.open();

                return false;

            }

            function jt_download_add_item_action() {

                var $this = $( this );

                if ( ! $this.is( 'button.jt_download_add_item' ) ) {

                    return false;

                }

                var $list = $( 'ul.jt_download_list' );
                var $jt_download_item = jt_download_item_create();

                $list.append( $jt_download_item );

                return false;

            }

            function jt_download_del_item_action() {

                var $this = $( this );

                if ( ! $this.is( 'button.jt_download_del_item' ) ) {

                    return false;

                }

                var $jt_download_item = $this.parents( 'li.jt_download_item:first' );

                $jt_download_item.fadeOut( 'slow', function () { $( this ).remove(); } );

                return false;

            }

            function jt_download_item_create() {

                var $jt_download_item = $( '<li />', { class: 'jt_download_item' } );

                var $thumbnail = $( '<div />', {
                    class : 'thumbnail thumbnail-application',
                    html  : [ $( '<img />', { src: '/wp-includes/images/media/default.png', class: 'icon', alt: '' } ) ]
                } );

                var $details = $( '<div />', {
                    class : 'details',
                    html  : [
                        $( '<div />', { class: 'filename', html: [ $( '<a />', { target: '_blank' } ) ] } ),
                        $( '<div />', { class: 'uploaded' } ),
                        $( '<div />', { class: 'file-size' } )
                    ]
                } );

                var $attachment_button = $( '<div />', {
                    class : 'attachment-button',
                    style : 'position:relative;',
                    html  : [
                        $( '<button />', {
                            type  : 'button',
                            class : 'media-modal-close jt_download_select_item',
                            style : 'width:20px;height:20px;right:35px;',
                            html  : [ $( '<span />', { class: 'dashicons dashicons-edit' } ) ]
                        } ),
                        $( '<button />', {
                            type  : 'button',
                            class : 'media-modal-close jt_download_del_item',
                            style : 'width:20px;height:20px;right:15px;',
                            html  : [ $( '<span />', { class: 'dashicons dashicons-no' } ) ]
                        } )
                    ]
                } );

                $( '<div />', {
                    class : 'attachment-info',
                    style : 'display:none;',
                    html  : [
                        $( '<input />', { type: 'hidden', name: 'jt_download[]' } ),
                        $thumbnail,
                        $details,
                        $attachment_button
                    ]
                } ).appendTo( $jt_download_item );

                $( '<div />', {
                    class : 'attachment-add',
                    style : 'border-bottom:1px solid #ddd;padding-bottom:11px;',
                    html  : [
                        $( '<button />', {
                            class : 'button jt_download_select_item',
                            text  : '첨부파일 선택'
                        } ),
                        $( '<button />', {
                            class : 'button jt_download_del_item',
                            text  : '삭제'
                        } ),
                    ]
                } ).appendTo( $jt_download_item );

                $( 'button.jt_download_select_item', $jt_download_item ).off( 'click' ).on( 'click', jt_download_select_item_action );
                $( 'button.jt_download_del_item', $jt_download_item ).off( 'click' ).on( 'click', jt_download_del_item_action );

                return $jt_download_item;

            }

        });
       </script>
        <?php

    }



    public function jt_metabox_sticky() {

        echo  '<div style="padding: 5px 0 15px 0">';
            echo '<span id="sticky-span" style="margin-left:12px;">';
                echo '<input id="sticky" name="sticky" type="checkbox" value="sticky" ' . checked( is_sticky( get_the_ID() ), true, false ) . ' />';
                echo ' ';
                echo '<label for="sticky" class="selectit">공지</label>';
            echo '</span>';
        echo '</div>';

    }



    /**
     * Custom field 추가
     *.
     *
     * @author STUDIO-JT (201)
     * @since 1.0.0
     * @access public
     *
     * @required Advance Custom Field plugin
     * Just For Override
     */
    public function acf_field() { }




    public function admin_thumb_style( $hook ) {

        echo '
        <style>
            .column-jt_admin_thumb { width: 150px; }
        </style>
        ';

    }

    public function admin_thumb_columns( $columns ) {

        $new_columns = array();

        foreach ( $columns as $key => $value ) {

            $new_columns[ $key ] = $value;
            $new_columns[ 'jt_admin_thumb' ] = '썸네일';

        }

        return $new_columns;

    }

    public function admin_thumb_column_value( $column_name, $post_id ) {

        if ( $column_name == 'jt_admin_thumb' ) {

            if ( has_post_thumbnail( $post_id ) ) {

                $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'thumbnail' );
                $thumb = $thumb[ 0 ];

                echo '<img src="' . $thumb . '" alt="' . get_the_title( $post_id ) . '" />';

            } else {

                echo '<span>-</span>';

            }

        }

    }

    public function disable_gutenberg( $current_status, $post_type ) {

        if ( $this->_namespace == $post_type ) {

            return $this->_gutenberg;

        }

        return $current_status;

    }



    public function menu_css($classes, $menu) {
        if (is_singular($this->_namespace) && $this->_pageid) {
            if ($menu->object_id == $this->_pageid) {
                if ($menu->menu_item_parent == 0) {
                    if (!in_array('current-menu-ancestor', $classes)) $classes[] = 'current-menu-ancestor';
                    if (!in_array('current-menu-parent', $classes)) $classes[] = 'current-menu-parent';
                    if (!in_array('current_page_parent', $classes)) $classes[] = 'current_page_parent';
                    if (!in_array('current_page_ancestor', $classes)) $classes[] = 'current_page_ancestor';
                }

                //if (!in_array('current-menu-item', $classes)) $classes[] = 'current-menu-item';
                if (!in_array('current_page_item', $classes)) $classes[] = 'current_page_item';
            } else {
                $is_parents = false;

                if (in_array('menu-item-has-children', $menu->classes)) {
                    global $wpdb;
                    $child_items = array_column($wpdb->get_results($wpdb->prepare(
                        "   SELECT DISTINCT pm.meta_value AS post_id
                            FROM {$wpdb->posts} AS p
                                INNER JOIN {$wpdb->postmeta} AS pm ON pm.post_id = p.ID AND pm.meta_key = '_menu_item_object_id'
                            WHERE 1=1
                                AND p.post_type = 'nav_menu_item'
                                AND p.post_status = 'publish'
                                AND p.post_parent = %d
                        ", $menu->object_id
                    )), 'post_id');

                    $parent_id = $this->_pageid;

                    while (!$is_parents && $parent_id > 0 && $child_items) {
                        $is_parents = in_array($parent_id, $child_items);

                        if (!$is_parents) {
                            $parent_id = wp_get_post_parent_id($parent_id);
                        }
                    }
                }

                if ($is_parents) {
                    if (!in_array('current-menu-ancestor', $classes)) $classes[] = 'current-menu-ancestor';
                    if (!in_array('current-menu-parent', $classes)) $classes[] = 'current-menu-parent';
                    if (!in_array('current_page_parent', $classes)) $classes[] = 'current_page_parent';
                    if (!in_array('current_page_ancestor', $classes)) $classes[] = 'current_page_ancestor';
                }
            }
        }

        return $classes;
    }






    // esc_attr 확장 함수( 배열 및 오브젝트 지원 )
    protected function esc_attr( $var ) {

        if ( is_string( $var ) || is_numeric( $var ) ) {

            return esc_attr( $var );

        } elseif ( empty( $var ) ) {

            return $var;

        } else {

            foreach ( $var as &$item ) {

                $item = $this->esc_attr( $item );

            }

            return $var;

        }

    }



    // isset 확장 함수
    protected function is_set( &$var = null, $default = null ) {

        try {

            if ( ( ! isset( $var ) || empty( $var ) ) && ! is_bool( $var ) && ! is_numeric( $var ) ) {

                // return $default;
                $var = $default; // 포인터 사용시 $var 의 값을 $default 값으로 대체

            }

            return $var;

        } catch ( Exception $e ) {

            // self::debug( $e ); exit;
            return null;

        }

    }


    // script console.log 대응 함수
    protected function console( $var, $var_name = '' ) {

        echo '<script>console.log( ' . ( $this->is_set( $var_name ) ? '"' . $var_name . '", ' : '' ) . json_encode( $var ) . ' );</script>';

    }


    // print_r, var_dump 확장 함수
    protected function debug( $var, $var_name = '', $show_type = false ) {

        echo '<pre>' . ( $this->is_set( $var_name ) ? $var_name . ' :: ' : '' );

        if ( $show_type ) {

            var_dump( $var );

        } else {

            print_r( $var );

        }

        echo '</pre>';

    }

} // END CLASS
