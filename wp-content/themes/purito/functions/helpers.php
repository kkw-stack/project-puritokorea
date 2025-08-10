<?php

/* ************************************** *
 * Display the slug of the current page or a specific page ($id).
 *
 * Work only if permalink are set.
 *
 * @param $id int optional a page or post id
 * @param $echo bool optional echo or not the slug
 * ************************************** */
function jt_the_slug($id = NULL, $echo = true){

    $slug = basename(get_permalink($id ));
    $slug = urldecode ($slug);

    if( $echo ) {
        echo $slug;
    }else{
        return $slug;
    }

}



/* ************************************** *
 * Get image url by attachement id
 *
 * @param $id int required the image attachement id
 * @param $size string the image size (default if 'thumbnail')
 * @param $echo bool optional echo or not the url
 *
 * USAGE :
 * <img src="<?php jt_the_image_url(825, 'large') ?>" alt="이미지" />
 * <img src="<?php jt_the_image_url(get_field('my_acf_image_id'), 'some_custom_image_size') ?>" alt="이미지" />
 *
 * ************************************** */
function jt_the_image_url($id , $size = 'thumbnail', $echo = true){

    $image_src = wp_get_attachment_image_src( $id, $size);

	if($echo){
	    echo $image_src[0];
	}else{
	    return $image_src[0];
	}

}



/* ************************************** *
 * Get image url by attachement id
 *
 * @param $id int required the image attachement id
 * @param $size string the image size (default if 'thumbnail')
 * @param $echo bool optional echo or not the url
 *
 * USAGE :
 * <img src="<?php jt_the_image_url(825, 'large') ?>" alt="이미지" />
 * <img src="<?php jt_the_image_url(get_field('my_acf_image_id'), 'some_custom_image_size') ?>" alt="이미지" />
 *
 * ************************************** */
function jt_get_image_src( $image_id, $size = 'thumbnail', $default = '' ) {

    try {

        if (in_array(get_post_mime_type($image_id), ["image/gif", "image/webp"])) {
                $size = "full";
        }

        if ( $image_id > 0 ) {

            $image = wp_get_attachment_image_src( $image_id, $size );


            return ( isset( $image[ 0 ] ) && ! empty( $image[ 0 ] ) ? $image[ 0 ] : $default );

        } else {

            return $default;

        }

    } catch ( Exception $e ) {

        return $default;

    }

}



/* ************************************** *
 * Helper
 * ************************************** */
// isset 확장 함수
function jt_isset( &$var = null, $default = null ) {

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
function jt_console( $var, $var_name = '' ) {

    echo '<script>console.log( ' . ( jt_isset( $var_name ) ? json_encode( $var_name  ) . ', ' : '' ) . json_encode( $var ) . ' );</script>';

}



//
function jt_is_array_empty($arr){

    if(is_array($arr)){

        foreach($arr as $key => $value){

            if(!empty($value) || $value != NULL || $value != ""){

                return true;

                break;

            }

        }

        return false;

    }

}
