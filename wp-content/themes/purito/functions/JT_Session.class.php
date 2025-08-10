<?php defined( 'ABSPATH' ) or die( 'Nothing to see here.' ); // Security (disable direct access).

if ( ! class_exists( 'JT_Session' ) ) {

    class JT_Session {

        public static function getAll() {

            try {

                if ( ! session_id() ) session_start();

                session_write_close();

                return $_SESSION;

            } catch ( Exception $e ) {

                return null;

            }

        }

        public static function get( $name, $value = null ) {

            try {

                if ( ! session_id() ) session_start();

                if ( ! isset( $_SESSION[ $name ] ) ) $_SESSION[ $name ] = ( $value ?: null );

                session_write_close();

                return $_SESSION[ $name ];

            } catch ( Exception $e ) {

                return null;

            }


        }

        public static function set( $name = '', $value = null ) {

            try {

                if ( ! session_id() ) session_start();

                $_SESSION[ $name ] = $value;

                session_write_close();

                return $_SESSION[ $name ];

            } catch ( Exception $e ) {

                return false;

            }

        }

        public static function del( $name ) {

            try {

                if ( ! session_id() ) session_start();

                $_SESSION[ $name ] = null;
                unset( $_SESSION[ $name ] );

                session_write_close();

                return true;

            } catch ( Exception $e ) {

                return false;

            }

        }

        public function __construct() {

        }


    }

}