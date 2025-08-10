<?php
/**
 * Name       : INGREDIENT
 * namespace  : ingredient
 * File       : /modules/ingredient/index.php
 * Author     : STUDIO-JT (Nico)
 * Guideline  : JTstyle.2.0 (beta : add wp comment code standard)
 * Guideline  : https://codex.studio-jt.co.kr/dev/?p=2109
 *              https://make.wordpress.org/core/handbook/best-practices/coding-standards/php/
 *
 * SUMMARY:
 * 01) INGREDIENT 프로그램 실행.
 * 02) Extend Jt_Module Class.
 */



/**
 * INGREDIENT 프로그램 실행
 */
$jt_ingredient = new jt_ingredient();



/**
 * jt_ingredient Class
 *
 * Extend Jt_Module class, note that folder location is important
 * Available template : last.php, list.php, single.php
 *
 * @see Jt_Module
 */
class jt_ingredient extends Jt_Module {

    public function __construct() {

        parent::__construct( array(
            'namespace'         => 'ingredient',
            'name'              => '성분상세',
            'menu'              => 'Ingredient',
            'slug'              => 'ingredient',
            'support'           => array('title', 'revisions'),
            'support_cat'       => false,
            'is_sticky'         => false,
            // 'use_single'        => false,
            'pageid'            => 682,
        ) );
    }
}
