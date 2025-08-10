<?php
/**
 * Name       : FAQ
 * namespace  : faq
 * File       : /modules/faq/index.php
 * Author     : STUDIO-JT (Nico)
 * Guideline  : JTstyle.2.0 (beta : add wp comment code standard)
 * Guideline  : https://codex.studio-jt.co.kr/dev/?p=2109
 *              https://make.wordpress.org/core/handbook/best-practices/coding-standards/php/
 *
 * SUMMARY:
 * 01) FAQ 프로그램 실행.
 * 02) Extend Jt_Module Class.
 */



/**
 * FAQ 프로그램 실행
 */
$jt_faq = new jt_faq();



/**
 * jt_faq Class
 *
 * Extend Jt_Module class, note that folder location is important
 * Available template : last.php, list.php, single.php
 *
 * @see Jt_Module
 */
class jt_faq extends Jt_Module {

	public function __construct() {

		parent::__construct(
			array(
				'namespace'   => 'faq',
				'name'        => 'FAQ',
				'menu'        => 'FAQ',
				'slug'        => 'faq',
				'support'     => array( 'title' ),
				'support_cat' => true,
				'is_sticky'   => false,
				'use_single'  => false,
				'pageid'      => 697,
			)
		);
	}

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
				'meta_box_cb'       => false,
			)
		);
	}
	public function the_list( $num = 0, $cat = null, $echo = true ) {
		$num = -1;

		if ( $echo ) {
			parent::the_list( $num, $cat, $echo );
		} else {
			return parent::the_list( $num, $cat, $echo );
		}
	}
}
