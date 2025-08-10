<?php
/**
 * Name       : PRODUCT
 * namespace  : product
 * File       : /modules/product/index.php
 * Author     : STUDIO-JT (Nico)
 * Guideline  : JTstyle.2.0 (beta : add wp comment code standard)
 * Guideline  : https://codex.studio-jt.co.kr/dev/?p=2109
 *              https://make.wordpress.org/core/handbook/best-practices/coding-standards/php/
 *
 * SUMMARY:
 * 01) PRODUCT 프로그램 실행.
 * 02) Extend Jt_Module Class.
 */



/**
 * PRODUCT 프로그램 실행
 */
$jt_product = new jt_product();



/**
 * jt_product Class
 *
 * Extend Jt_Module class, note that folder location is important
 * Available template : last.php, list.php, single.php
 *
 * @see Jt_Module
 */
class jt_product extends Jt_Module {
	public function __construct() {
		parent::__construct(
			array(
				'namespace'   => 'product',
				'name'        => '제품',
				'menu'        => '제품',
				'slug'        => 'product',
				'support'     => array( 'title' ),
				'support_cat' => true,
				'pageid'      => 679,
			)
		);

		add_action( 'taxonomy_template', array( $this, 'taxonomy_template' ) );
		add_action( 'pre_get_posts', array( $this, 'category_pre_get_posts' ) );
	}


	public function create_taxonomy() {
		$namespace = $this->_namespace;
		$name      = $this->_name;

		register_taxonomy(
			$namespace . '-categories',
			$namespace,
			array(
				'hierarchical'      => true,
				'label'             => $name . ' 분류',
				'query_var'         => true,
				'show_in_rest'      => true,
				'show_admin_column' => true,
			)
		);

		register_taxonomy(
			$namespace . '-labels',
			$namespace,
			array(
				'hierarchical'      => true,
				'label'             => $name . ' 라벨 분류',
				'query_var'         => true,
				'show_in_rest'      => true,
				'show_admin_column' => true,
				'meta_box_cb'       => false,
			)
		);

		register_taxonomy(
			$namespace . '-skin',
			$namespace,
			array(
				'hierarchical'      => true,
				'label'             => 'Skin Concern 분류',
				'query_var'         => true,
				'show_in_rest'      => true,
				'show_admin_column' => true,
				'meta_box_cb'       => false,
			)
		);

		register_taxonomy(
			$namespace . '-ingredient',
			$namespace,
			array(
				'hierarchical'      => true,
				'label'             => 'Ingredient 분류',
				'query_var'         => true,
				'show_in_rest'      => true,
				'show_admin_column' => true,
				'meta_box_cb'       => false,
			)
		);

		register_taxonomy(
			$namespace . '-icon',
			$namespace,
			array(
				'hierarchical'      => true,
				'label'             => $name . ' 아이콘 분류',
				'query_var'         => true,
				'show_in_rest'      => true,
				'show_admin_column' => true,
				'meta_box_cb'       => false,
			)
		);
	}

	public function the_list( $num = 0, $cat = null, $echo = true ) {
		$num = (int) ( empty( $num ) ? get_option( 'posts_per_page' ) : $num ); // Set post per page

		// Get posttype namespace and init some var
		$namespace = $this->_namespace;
		$type      = $this->_namespace;
		$paged     = max( 1, intVal( get_query_var( 'paged' ) ) );
		$args      = array(
			'post_type'      => $type,
			'posts_per_page' => $num,
			'paged'          => $paged,
			'tax_query'      => array( 'relation' => 'AND' ),
		);

		// If category
		if ( ! empty( $_GET['category'] ) ) {
			$args['tax_query'][] = array(
				'taxonomy' => $this->_namespace . '-categories',
				'field'    => 'term_id',
				'terms'    => (int) $_GET['category'],
			);

		} elseif ( ! empty( $cat ) ) {
			$args['tax_query'][] = array(
				'taxonomy' => $this->_namespace . '-categories',
				'field'    => 'term_id',
				'terms'    => $cat,
			);
		} else {
			$terms = get_terms(
				array(
					'taxonomy'   => 'product-categories',
					'hide_empty' => false,
				)
			);

			if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
				foreach ( $terms as $term ) {
					$all_term_ids[] = $term->term_id;
				}

				$args['tax_query'][] = array(
					'taxonomy' => $this->_namespace . '-categories',
					'field'    => 'term_id',
					'terms'    => $all_term_ids,
				);
			}
		}

		if ( is_tax() ) {
			$current_term = get_queried_object();

			$args['tax_query'][] = array(
				'taxonomy' => $current_term->taxonomy,
				'field'    => 'term_id',
				'terms'    => $current_term->term_id,
			);
		}

		if ( 'popularity' === ( $_REQUEST['sort'] ?? '' ) ) {
			$args['meta_key'] = 'product_data_basic_rank';
			$args['orderby']  = array(
				'meta_value_num' => 'ASC',
				'date'           => 'DESC',
			);
		} else {
			$args['orderby'] = 'date';
			$args['order']   = 'DESC';
		}

		// Set the loop
		$loop = new WP_Query( $args );

		// Include list Custom Template if exist.
		$template_path   = get_template_directory() . '/modules/' . $namespace . '/list.php';
		$template_folder = file_exists( $template_path ) ? $namespace : 'jt-module-template';

		ob_start();
		include get_template_directory() . '/modules/' . $template_folder . '/list.php';
		$output = ob_get_clean();

		// Print or retrun
		if ( $echo ) {
			echo $output;
		} else {
			return $output;
		}
	} // END the_list

	public function taxonomy_template( $template ) {
		$namespace      = $this->_namespace;
		$arr_categories = array(
			'categories',
			'labels',
			'skin',
			'ingredient',
		);

		foreach ( $arr_categories as $category ) {
			if ( is_tax( $namespace . '-' . $category ) ) {
				$template = locate_template( 'taxonomy-product.php' );
			}
		}

		return $template;
	}

	public function category_pre_get_posts( $query ) {
		if ( $query->is_main_query() && ! is_admin() ) {
			$current_term = get_queried_object();
	
			if ( $current_term instanceof WP_Term && str_starts_with( $current_term->taxonomy, $this->_namespace ) ) {
				$query->set( 'post_type', array( $this->_namespace ) );
			}
		}
	}
}
