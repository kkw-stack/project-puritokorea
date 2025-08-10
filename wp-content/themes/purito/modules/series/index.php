<?php
/**
 * Name       : SERIES
 * namespace  : series
 * File       : /modules/series/index.php
 * Author     : STUDIO-JT (Nico)
 * Guideline  : JTstyle.2.0 (beta : add wp comment code standard)
 * Guideline  : https://codex.studio-jt.co.kr/dev/?p=2109
 *              https://make.wordpress.org/core/handbook/best-practices/coding-standards/php/
 *
 * SUMMARY:
 * 01) SERIES 프로그램 실행.
 * 02) Extend Jt_Module Class.
 */



/**
 * SERIES 프로그램 실행
 */
$jt_series = new jt_series();



/**
 * jt_series Class
 *
 * Extend Jt_Module class, note that folder location is important
 * Available template : last.php, list.php, single.php
 *
 * @see Jt_Module
 */
class jt_series extends Jt_Module {

    public function __construct() {

        parent::__construct( array(
            'namespace'         => 'series',
            'name'              => '시리즈',
            'menu'              => '크리에잇미 시리즈',
            'slug'              => 'series',
            'support'           => array('title'),
            'support_cat'       => false,
            'is_sticky'         => false,
            'use_single'        => false,
            'pageid'            => 691,
        ) );
    }
}
