<?php
function ajax_jt_video_add_image() {

    $img_src   = esc_attr( $_POST[ 'img_src' ] );
    $video_url = esc_attr( $_POST[ 'video_url' ] );
    $file_name = esc_attr( $_POST[ 'file_name' ] );
    $post_id   = esc_attr( $_POST[ 'post_id' ] );

    if ( ! empty( $img_src ) && ! empty( $video_url ) && ! empty( $file_name ) && ! empty( $post_id ) ) {

        $tmp_arr = explode( '.', $img_src );
        $ext     = explode( '?', $tmp_arr[ count( $tmp_arr ) - 1 ] );
        $ext     = $ext[ 0 ];

        $new_file_name   = "{$file_name}.{$ext}";
        $tmp_upload_path = wp_upload_dir();
        $full_path       = $tmp_upload_path[ 'path' ] . '/' . basename( $new_file_name );
        $full_url        = $tmp_upload_path[ 'url' ] . '/' . basename( $new_file_name );

        // 파일 업로드
        if ( file_put_contents( $full_path, file_get_contents( $img_src ) ) ) {

            $file_type = wp_check_filetype( basename( $full_path ), null );

            $attachment = array(
                'guid'           => $full_url,
                'post_mime_type' => $file_type[ 'type' ],
                'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $full_path ) ),
                'post_content'   => '',
                'post_status'    => 'inherit'

            );

            $attach_id = wp_insert_attachment( $attachment, $full_path );

            if ( $attach_id > 0 ) {

                // Make sure that this file is included, as wp_generate_attachment_metadata() depends on it.
                require_once( ABSPATH . 'wp-admin/includes/image.php' );

                // Generate the metadata for the attachment, and update the database record.
                $attach_data = wp_generate_attachment_metadata( $attach_id, $full_path );
                wp_update_attachment_metadata( $attach_id, $attach_data );

                $res = array(
                    'video_url'  => $video_url,
                    'attach_id'  => $attach_id,
                    'attach_url' => $full_url,
                    'thumbnail'  => _wp_post_thumbnail_html( $attach_id, $post_id )
                );
                wp_send_json_success( $res );

            } else {

                wp_send_json_error( '파일 등록 오류' );

            }

        } else {

            wp_send_json_error( '파일 업로드 실패' );

        }

    } else {

        wp_send_json_error( '입력값 오류' );

    }

    exit;

}
add_action( 'wp_ajax_jt_video_add_image', 'ajax_jt_video_add_image' );

function jt_acf_video_thumbnail_script() {
?>
        <style>
            div.jt_video_background { position:absolute;background-color:rgba( 0, 0, 0, 0.85 );top:0px;left:0px;z-index:99998;display:none; }
            div.jt_video_popup { display:none;position:fixed;top:50% !important;left:0px; transform:translateY(-50%); z-index:99999; }
            div.jt_video_popup div.container {width:640px; position:relative; margin:auto; }
            div.jt_video_popup div.container figure { margin:0px;max-height:640px;}
            div.jt_video_popup div.container figure img { width:100%; }
            div.jt_video_popup div.container div.btn_wrap { width:100%;position:relative;top:-40px; }
            div.jt_video_popup div.container div.btn_wrap input.ok { position:absolute;left:5px; }
            div.jt_video_popup div.container div.btn_wrap input.close { position:absolute;right:5px; }
        </style>

        <script>
            jQuery( function ( $ ) {

                if ( typeof acf == 'undefined' || $( '.jt_video' ).length == 0 ) { return; }

                // Add Button
                $( '<input />', { type: 'button', class: 'jt_get_video_img_btn button', style: 'margin-top:5px;', value: '썸네일가져오기' } ).appendTo( $( '.jt_video' ) );
                jt_vimeo_add_btn_get_thumbnail();

                function jt_vimeo_add_btn_get_thumbnail() {

                    $( 'input.jt_get_video_img_btn' ).on( 'click', function () {

                        var $this   = $( this );
                        var $target = $this.parents( '.jt_video:first' ).find( 'input[type=text], input[type=url]' );
                        var video   = get_video_from_url( $target.val() );

                        if ( video ) {

                            if ( video.api ) {

                                $.get( video.api, function ( response ) {

                                    if ( response.length > 0 ) {

                                        data = response[ 0 ];

                                        if ( data.thumbnail_large ) {

                                            video.img = data.thumbnail_large;

                                            jt_video_view_item( video );
                                            return false;

                                        }

                                    }

                                    alert( '썸네일 정보를 가져올 수 없습니다.' );

                                } );

                            } else {

                                jt_video_view_item( video );

                            }

                            return false;

                        } else {

                            alert( '썸네일 정보를 가져올 수 없습니다.' );
                            $target.focus();

                        }

                        return false;

                    } );

                }


                function jt_video_view_item( video ) {

                    var $background = $( 'div.jt_video_background' );
                    var $popup      = $( 'div.jt_video_popup' );

                    if ( video.name.index( 'vimeo' ) > -1 ) {

                        video.img = video.img.replace( '_640', '' ) + '?mw=1200&mh=675';

                    }

                    if ( $popup.length > 0 ) { $popup.remove(); }
                    if ( $background.length > 0 ) { $background.remove(); }


                    $popup = $( '<div />', { class: 'jt_video_popup' } ).append( [
                        $( '<div />', {
                            class : 'container',
                            html  : [
                                $( '<figure />', { html: $( '<img />', { src: img } ) } ),
                                $( '<div />', { class: 'btn_wrap', html: [
                                    $( '<input />', { type: 'button', class: 'ok button', value: '썸네일 사용', 'data-name': video.name, 'data-url': video.url, 'data-img': video.img } ),
                                    $( '<input />', { type: 'button', class: 'close button', value: '취소' } )
                                ] } )
                            ]
                        } )
                    ] ).appendTo( 'body' );

                    $( 'input.ok', $popup ).on( 'click', jt_video_set_img );
                    $( 'input.close', $popup ).on( 'click', jt_video_close_item );



                    $background = $( '<div />', { class: 'jt_video_background' } ).appendTo( 'body' );
                    $background.width( $( document ).width() );
                    $background.height( $( document ).height() );
                    $background.on( 'click', jt_video_close_item );

                    $background.fadeIn( 'fast', function () {

                        $popup.css( 'top', Math.max( 0, ( ( $( window ).height() - 749 ) / 2 ) + $( window ).scrollTop() ) + 'px' );
                        $popup.css( 'left', Math.max( 0, ( ( $( window ).width() - $popup.outerWidth() ) / 2 ) + $( window ).scrollLeft() ) + 'px' );

                        $popup.fadeIn( 'slow' );

                    } );

                    return false;

                }

                function jt_video_set_img() {

                    var $this = $( this );
                    var data  = {
                        action    : 'jt_video_add_image',
                        file_name : $this.data( 'name' ),
                        video_url : $this.data( 'url' ),
                        img_src   : $this.data( 'img' ),
                        post_id   : $( 'input[name=post_ID]' ).val()
                    };

                    if ( $( '.jt_video_thumb' ).length > 0 || $( '#postimagediv' ).length > 0 ) {

                        $.post( ajaxurl, data, function ( response ) {

                            if ( response.success == true ) {

                                if ( $( '.jt_video_thumb' ).length > 0 ) {

                                    var $parent       = $( '.jt_video input[value="' + response.data.video_url + '"]' ).parents( 'tr:first' );
                                    var $target       = $( '.jt_video_thumb' );
                                    var $target_input = $( 'input[type=hidden]', $target );
                                    var $target_img   = $( 'img', $target );


                                    $target_input.val( response.data.attach_id );
                                    $target_img.attr( 'src', response.data.attach_url );

                                    $( 'div.acf-image-uploader', $target ).addClass( 'has-value' );

                                } else if ( $( '#postimagediv' ).length > 0 ) {

                                    $( '#postimagediv' ).find( 'div.inside' ).html( response.data.thumbnail );

                                }

                            } else {

                                alert( '파일 업로드 중 오류가 발생했습니다' );

                            }

                            jt_video_close_item();

                        } );

                    } else {

                        alert( '이미지를 설정할 수 없습니다. jt_video_thumb 클래스를 추가하거나 특성 이미지를 사용하도록 설정하세요' );

                    }

                    return false;

                }

                function jt_video_close_item() {

                    var $background = $( 'div.jt_video_background' );
                    var $popup      = $( 'div.jt_video_popup' );

                    $background.fadeOut( 'fast', function () {

                        $( this ).remove();

                    } );

                    $popup.fadeOut( 'fast', function () {

                        $( this ).remove();

                    } );

                    return false;

                }

                function get_video_from_url( url ) {

                    if ( ! url || url.length == 0 ) { return null; }

                    var res = null;

                    try { // CHECK VIMEO

                        var tmp = url;
                        tmp = tmp.split(/(vimeo\.com\/)(video\/)|(vimeo\.com\/)/);
                        tmp = tmp.length > 0 ? tmp[ tmp.length - 1 ] : tmp;
                        tmp = tmp.split( /[?&]/ );
                        tmp = tmp.length > 0 ? tmp[ 0 ] : tmp;

                        if ( tmp.length > 0 && parseInt( tmp ) ) {

                            return { name: 'vimeo_' + tmp, url: url, api: 'http://vimeo.com/api/v2/video/' + tmp + '.json' };

                        }

                    } catch( err ) { }

                    try { // CHECK YOUTUBE

                        var tmp = url.match( /(?:https?:\/{2})?(?:w{3}\.)?youtu(?:be)?\.(?:com|be)(?:\/watch\?v=|\/)([^\s&]+)/ )[ 1 ];

                        if ( tmp ) {

                            return { name: 'youtube_' + tmp, url: url, img: 'http://img.youtube.com/vi/' + tmp + '/hqdefault.jpg' };

                        }

                    } catch ( err) { console.log( err ); }

                    return res;

                }

            } );
        </script>

<?php

}
add_action( 'admin_footer', 'jt_acf_video_thumbnail_script' );

/*
function get_image_sizes() {
    global $_wp_additional_image_sizes;

    $sizes = array();

    foreach ( get_intermediate_image_sizes() as $_size ) {
        if ( in_array( $_size, array('thumbnail', 'medium', 'medium_large', 'large') ) ) {
            $sizes[ $_size ]['width']  = get_option( "{$_size}_size_w" );
            $sizes[ $_size ]['height'] = get_option( "{$_size}_size_h" );
            $sizes[ $_size ]['crop']   = (bool) get_option( "{$_size}_crop" );
        } elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {
            $sizes[ $_size ] = array(
                'width'  => $_wp_additional_image_sizes[ $_size ]['width'],
                'height' => $_wp_additional_image_sizes[ $_size ]['height'],
                'crop'   => $_wp_additional_image_sizes[ $_size ]['crop'],
            );
        }
    }

    return $sizes;
}
*/