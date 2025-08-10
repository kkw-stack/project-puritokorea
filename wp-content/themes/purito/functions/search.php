<?php

/*
 **************************************** *
 * FORM TEMPLATE
 * **************************************** */
function jt_search_form() {
	?>
		<form id="search-modal__form" class="search-modal__form" action="<?php bloginfo( 'wpurl' ); ?>/" autocomplete="off">
			<input name="search_type" type="hidden" value="product" />
			<label for="search-modal__field" class="search-modal__label">What are you looking for?</label>
			<input name="s" type="text" id="search-modal__field" class="search-modal__field" value="" />
			<button type="button" class="search-modal__reset" tabindex="-1">
				<span class="sr-only">초기화</span>
				<i class="jt-icon"><?php jt_icon( 'jt-close-mini-2px' ); ?></i>
			</button>
			<button type="submit" class="search-modal__submit">
				<span class="sr-only">검색하기</span>
				<i class="jt-icon"><?php jt_icon( 'jt-search-secondary' ); ?></i>
			</button>
		</form><!-- .search-modal__form -->
	<?php
}



/*
 **************************************** *
 * ADD ACF AND TAGS TO SEARCH RESULT
 * **************************************** */
function jt_search_custom_where( $where, $query ) {
	global $wpdb;

	if ( is_search() && $query->is_main_query() && ! is_admin() ) {
		try {
			$search = $query->query['s'];

			$replace = 'post_title LIKE $1 ) ';

			// Custom field
			$replace .= $wpdb->prepare( " OR ( {$wpdb->posts}.ID IN ( SELECT post_id FROM {$wpdb->postmeta} WHERE meta_key = 'about' AND meta_value LIKE %s ) ) ", "%{$search}%" );
			$replace .= $wpdb->prepare( " OR ( {$wpdb->posts}.ID IN ( SELECT post_id FROM {$wpdb->postmeta} WHERE meta_key = 'about_english' AND meta_value LIKE %s ) ) ", "%{$search}%" );
			// $replace    .= $wpdb->prepare( " OR ( {$wpdb->posts}.ID IN ( SELECT post_id FROM {$wpdb->postmeta} WHERE meta_key LIKE 'someting_start_with_%' AND meta_value LIKE %s ) ) ", "%{$search}%" );

			// $where      = preg_replace( "/post_title\s+LIKE\s(\'[^\']+\')\s\)/", $replace, $where );
		} catch ( Exception $e ) {

		}
	}

	return $where;
}
// add_filter( 'posts_where', 'jt_search_custom_where', 99999 , 2 );

function jt_pre_get_posts_custom_search( $query ) {
	global $wpdb;

	if ( is_search() && $query->is_main_query() && ! is_admin() ) {
		$search_type = $_GET['search_type'] ?? 'product';
		$search = trim( strtolower( isset( $query->query['s'] ) ? $query->query[ 's' ] : '' ) );

		if ( 'community' === $search_type && ! empty( $search ) ) {
			$str_query = "SELECT ID";

			if ( ! empty( $search ) ) {
				$str_query .= ", (0 ";
			
				$placeholders = array_fill( 0, 2, '%' . str_replace( ' ', '%', $search) . '%' );
				$str_query .= $wpdb->prepare(
					" + ( CASE WHEN (
						( LOWER( post_title ) LIKE %s )
						OR ( LOWER( post_content ) LIKE %s )
					) THEN 1 ELSE 0 END )",
					$placeholders
				);
			
				foreach ( explode( ' ', $search ) as $value ) {
					$placeholders = array_fill( 0, 2, '%' . $value . '%' );
					$str_query .= $wpdb->prepare(
						" + ( CASE WHEN (
							( LOWER( post_title ) LIKE %s )
							OR ( LOWER( post_content ) LIKE %s )
						) THEN 1 ELSE 0 END )",
						$placeholders
					);
				}
			
				$str_query .= " ) AS order_cnt";
			}
			
			$str_query .= " FROM {$wpdb->posts}";
			$str_query .= " WHERE post_type = 'newspress' AND post_status = 'publish'";
			
			if ( ! empty( $search ) ) {
				$str_query .= ' AND ( 1=0 ';
			
				foreach ( explode( ' ', $search ) as $value ) {
					$placeholders = array_fill( 0, 2, '%' . $value . '%' );
					$str_query .= $wpdb->prepare(
						" OR (
							( LOWER( post_title ) LIKE %s )
							OR ( LOWER( post_content ) LIKE %s )
						)",
						$placeholders
					);
				}
			
				$str_query .= ' ) ';
			}
			
			$str_query .= ' GROUP BY ID ';
			$str_query .= " ORDER BY post_date DESC, 
            CASE 
                WHEN ( LOWER( post_title ) LIKE %s ) THEN 0 
                ELSE 1 
            END ASC ";
			$str_query = $wpdb->prepare( $str_query, '%' . str_replace( ' ', '%', $search ) . '%' );

			$result = $wpdb->get_results( $str_query, ARRAY_A );

			$query->set( 'post_type', 'newspress' );
			$query->set( 'post__in', empty( $result ) ? array( 0 ) : array_column( $result, 'ID' ) );
			$query->set( 'orderby', 'post__in' );
		} else {
			$str_query = "SELECT p.ID";

			if ( ! empty( $search ) ) {
				$str_query .= ", (0 ";
			
				$placeholders = array_fill( 0, 3, '%' . str_replace( ' ', '%', $search) . '%' );
				$str_query .= $wpdb->prepare(
					" + ( CASE WHEN (
						( LOWER( pm1.meta_value ) LIKE %s )
						OR ( LOWER( pm2.meta_value ) LIKE %s )
						OR ( LOWER( pm3.meta_value ) LIKE %s )
					) THEN 1 ELSE 0 END )",
					$placeholders
				);
			
				foreach ( explode( ' ', $search ) as $value ) {
					$placeholders = array_fill( 0, 3, '%' . $value . '%' );
					$str_query .= $wpdb->prepare(
						" + ( CASE WHEN (
							( LOWER( pm1.meta_value ) LIKE %s )
							OR ( LOWER( pm2.meta_value ) LIKE %s )
							OR ( LOWER( pm3.meta_value ) LIKE %s )
						) THEN 1 ELSE 0 END )",
						$placeholders
					);
				}
			
				$str_query .= " ) AS order_cnt";
			}
			
			$str_query .= " FROM {$wpdb->posts} AS p";
			$str_query .= " LEFT JOIN {$wpdb->postmeta} AS pm1 ON pm1.post_id = p.ID AND pm1.meta_key = 'product_data_basic_title'";
			$str_query .= " LEFT JOIN {$wpdb->postmeta} AS pm2 ON pm2.post_id = p.ID AND pm2.meta_key LIKE 'product_data_basic_spec_%_item'";
			$str_query .= " LEFT JOIN {$wpdb->postmeta} AS pm3 ON pm3.post_id = p.ID AND pm3.meta_key LIKE 'product_data_new_detail_%_data_%_name'";
			$str_query .= " WHERE p.post_type = 'product' AND p.post_status = 'publish'";
			
			if ( ! empty( $search ) ) {
				$str_query .= ' AND ( 1=0 ';
			
				foreach ( explode( ' ', $search ) as $value ) {
					$placeholders = array_fill( 0, 3, '%' . $value . '%' );
					$str_query .= $wpdb->prepare(
						" OR (
							( LOWER( pm1.meta_value ) LIKE %s )
							OR ( LOWER( pm2.meta_value ) LIKE %s )
							OR ( LOWER( pm3.meta_value ) LIKE %s )
						)",
						$placeholders
					);
				}
			
				$str_query .= ' ) ';
			}
			
			$str_query .= ' GROUP BY p.ID ';
			$str_query .= " ORDER BY order_cnt DESC, 
            CASE 
                WHEN ( LOWER( pm1.meta_value ) LIKE %s ) THEN 0 
                ELSE 1 
            END ASC ";
			$str_query = $wpdb->prepare( $str_query, '%' . str_replace( ' ', '%', $search ) . '%' );

			$result = $wpdb->get_results( $str_query, ARRAY_A );

			$query->set( 'post_type', 'product' );
			$query->set( 'post__in', empty( $result ) ? array( 0 ) : array_column( $result, 'ID' ) );

			if ( 'popularity' === ( $_REQUEST['sort'] ?? '' ) ) {
				$query->set( 'meta_key', 'product_data_basic_rank' );
				$query->set(
					'orderby',
					array(
						'meta_value_num' => 'ASC',
						'date'           => 'DESC',
					)
				);
			} else {
				$query->set( 'orderby', 'post__in' );
			}
		}

		$query->set( 'posts_per_page', 12 );
		$query->set( 's', '' );
	}
}
add_action( 'pre_get_posts', 'jt_pre_get_posts_custom_search' );


// Exclude some page from search
function jt_search_filter( $query ) {
	if ( is_search() && $query->is_main_query() && ! is_admin() ) {
		$query->set( 'post__not_in', array( 179, 242 ) ); // exclude privacy + email deny
	}

	return $query;
}
// add_filter( 'pre_get_posts', 'jt_search_filter' );
