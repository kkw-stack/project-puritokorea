<?php
/**
 * Name       : NEWS&PRESS
 * namespace  : newspress
 * File       : /modules/newspress/index.php
 * Author     : STUDIO-JT (Nico)
 * Guideline  : JTstyle.2.0 (beta : add wp comment code standard)
 * Guideline  : https://codex.studio-jt.co.kr/dev/?p=2109
 *              https://make.wordpress.org/core/handbook/best-practices/coding-standards/php/
 *
 * SUMMARY:
 * 01) NEW&PRESS 프로그램 실행.
 * 02) Extend Jt_Module Class.
 */



/**
 * NEW&PRESS 프로그램 실행
 */
$jt_newspress = new jt_newspress();



/**
 * jt_newspress Class
 *
 * Extend Jt_Module class, note that folder location is important
 * Available template : last.php, list.php, single.php
 *
 * @see Jt_Module
 */
class jt_newspress extends Jt_Module {

    public function __construct() {

        if ( 'en_US' === get_locale() ) {
            $page_id = 693; // 영문 페이지 ID
        } else {
            $page_id = 479; // 국문 페이지 ID
        }

        parent::__construct( array(
            'namespace'         => 'newspress',
            'name'              => 'News & Press',
            'menu'              => 'News & Press',
            'slug'              => 'newspress',
            'support'           => array( 'title', 'revisions', 'editor' ),
            'support_cat'       => true,
            'is_sticky'         => false,
            // 'use_single'        => false,
            'pageid'            => $page_id,
        ) );
    }
}
