<?php
/**
 * Name       : OFFLINE
 * namespace  : offline
 * File       : /modules/offline/index.php
 * Author     : STUDIO-JT (Nico)
 * Guideline  : JTstyle.2.0 (beta : add wp comment code standard)
 * Guideline  : https://codex.studio-jt.co.kr/dev/?p=2109
 *              https://make.wordpress.org/core/handbook/best-practices/coding-standards/php/
 *
 * SUMMARY:
 * 01) OFFLINE 프로그램 실행.
 * 02) Extend Jt_Module Class.
 */



/**
 * OFFLINE 프로그램 실행
 */
$jt_offline = new jt_offline();



/**
 * jt_offline Class
 *
 * Extend Jt_Module class, note that folder location is important
 * Available template : last.php, list.php, single.php
 *
 * @see Jt_Module
 */
class jt_offline extends Jt_Module {
	public function __construct() {
		parent::__construct(
			array(
				'namespace'   => 'offline',
				'name'        => '오프라인 스토어',
				'menu'        => '오프라인 스토어',
				'slug'        => 'offline',
				'support'     => array( 'title' ),
				'support_cat' => false,
				'is_sticky'   => false,
				'use_single'  => false,
				'pageid'      => 728,
			)
		);

		add_action( 'acf/init', array( $this, 'google_map_api_key' ) );
		add_action( 'pre_get_posts', array( $this, 'offline_custom_search' ) );
	}

	public function google_map_api_key() {
		acf_update_setting( 'google_api_key', 'AIzaSyBHzjz542fkjdLlJ9vil9GUTBlRcyeSKq4' );
	}

	public function the_list( $num = 0, $cat = null, $echo = true ) {
		$num = -1;

		// Set post per page
		if ( empty( $num ) ) {
			$num = get_option( 'posts_per_page' );
		}

		// Get posttype namespace and init some var
		$namespace  = $this->_namespace;
		$menu_name  = $this->_menu;
		$type       = $this->_namespace;
		$tax        = $namespace . '_categories';
		$item_class = '';
		$paged      = max( 1, intVal( get_query_var( 'paged' ) ) );
		$args       = array(
			'post_type'      => $type,
			'posts_per_page' => $num,
			'paged'          => $paged,
			'order'          => 'ASC',
			'orderby'        => 'title',
		);

		// If search
		if ( ! empty( $_REQUEST['search'] ) ) {
			$args['search_offline'] = $_REQUEST['search'];
		}

		// Set the loop
		$loop = new WP_Query( $args );
		// echo $loop->request;

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

	public function offline_custom_search( $query ) {
		global $wpdb;

		if ( ! empty( $query->get( 'search_offline' ) ) ) {
			$search = strtolower( $query->get( 'search_offline' ) );
			$sql    = " SELECT post_id FROM {$wpdb->postmeta} WHERE meta_key IN ('offline_store_store', 'offline_store_address') ";
			$sql   .= ' AND (';
			$sql   .= implode(
				' OR ',
				array_map(
					function ( $search_item ) use ( $wpdb ) {
						return $wpdb->prepare( 'LOWER(meta_value) LIKE %s', '%' . $search_item . '%' );
					},
					explode( ' ', $search )
				)
			);
			$sql   .= ' ) ';
			$sql   .= ' ORDER BY ';
			$sql   .= '(' . implode(
				'+',
				array_map(
					function ( $search_item ) use ( $wpdb ) {
						return $wpdb->prepare( '(CASE WHEN LOWER(meta_value) LIKE %s THEN 1 ELSE 0 END)', '%' . $search_item . '%' );
					},
					explode( ' ', $search )
				)
			) . ') DESC';
			$sql   .= ', post_id DESC';

			$result = $wpdb->get_results( $sql, ARRAY_A );

			$query->set( 'post_type', $this->_namespace );
			$query->set( 'post__in', empty( $result ) ? array( 0 ) : array_column( $result, 'post_id' ) );
			$query->set( 'orderby', 'post__in' );
			$query->set( 's', '' );
		}
	}
}
