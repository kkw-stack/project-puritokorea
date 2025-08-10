<?php defined( 'ABSPATH' ) or die( 'Nothing to see here.' ); // Security (disable direct access).

if ( ! class_exists( 'JT_Helper' ) ) {

    class JT_Helper {

        // esc_attr 확장 함수( 배열 및 오브젝트 지원 )
        public static function esc_attr( $var ) {

            if ( is_string( $var ) || is_numeric( $var ) || empty( $var ) ) {

                return esc_attr( $var );

            } else {

                foreach ( $var as &$item ) {

                    $item = self::esc_attr( $item );

                }

                return $var;

            }

        }

        // isset 확장 함수
        public static function is_set( &$var = null, $default = null ) {

            try {

                if ( ! isset( $var ) || empty( $var ) ) {

                    // return $default;
                    $var = $default; // 포인터 사용시 $var 의 값을 $default 값으로 대체

                }

                return $var;

            } catch ( Exception $e ) {

                // self::debug( $e ); exit;
                return null;

            }

        }

        // print_r, var_dump 확장 함수
        public static function debug( $var, $var_name = '', $show_type = false ) {

            echo '<pre>' . ( $var_name ? $var_name . ' :: ' : '' );

            if ( $show_type ) {

                var_dump( $var );

            } else {

                print_r( $var );

            }

            echo '</pre>';

        }

        // ajax 여부
        public static function is_ajax() {

            return defined( 'DOING_AJAX' ) && DOING_AJAX;

        }

        // mobile 여부
        public static function is_mobile() {

            return wp_is_mobile();

        }


        // Nonce Field
        public static function nonce( $name = '', $with_id = true ) {

            $nonce = wp_nonce_field( $name, $name, true, false );

            if ( ! $with_id ) {

                $nonce = preg_replace( '/id=\"\w+\"/', '', $nonce );

            }

            return $nonce;

        }

        public static function paged() {

            return self::is_set( $_REQUEST[ 'paged' ], 1 );

        }

        public static function date_format( $time, $format = 'Y-m-d H:i:s' ) {

            try {

                if ( is_string( $time ) ) {

                    $time = strtotime( $time );

                }

                $offset = get_option( 'gmt_offset' ) * HOUR_IN_SECONDS;

                return gmdate( $format, $time + $offset );

            } catch ( Exception $e ) {

                return '-';

            }

        }

    }

}