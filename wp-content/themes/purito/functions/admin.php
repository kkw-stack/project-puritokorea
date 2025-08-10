<?php

/* ************************************** *
 * CHANGE DEFAULT LOGO URL ON LOGIN PAGE
 * ************************************** */
function jt_login_headerurl(){

	return get_bloginfo('url');

}
add_filter( 'login_headerurl', 'jt_login_headerurl' );



/* ************************************ *
 * HIDE UPDATE NOTIFICATION
 * ************************************ */
function jt_hide_update_notice_to_all_but_admin_users(){
    if (!current_user_can('update_core')) {
        remove_action( 'admin_notices', 'update_nag', 3 );
    }
}
add_action( 'admin_head', 'jt_hide_update_notice_to_all_but_admin_users', 1 );



/* ************************************ *
 * CUSTOM LOGIN PAGE STYLE
 * ************************************ */
function jt_login_stylesheet() {

    wp_enqueue_style( 'jt-custom-login', get_template_directory_uri() . '/css/login.css' );
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'jt-custom-login', get_template_directory_uri() . '/js/login.js' );

}
add_action( 'login_enqueue_scripts', 'jt_login_stylesheet' );



/* ************************************ *
 * CUSTOM ADMIN STYLE
 * ************************************ */
function jt_admin_stylesheet() {

    wp_enqueue_style( 'jt-custom-admin', get_template_directory_uri() . '/css/admin.css', NULL, '1.0.0' );
    wp_enqueue_script( 'jt-custom-admin-script', get_template_directory_uri() . '/js/admin.js', array('jquery'), '1.0.0', true);

}
add_action( 'admin_enqueue_scripts', 'jt_admin_stylesheet',999 );



/* ************************************ *
 * REMOVE‘워드프레스’ FROM ADMIN <title>
 ************************************** */
function jt_admin_title($admin_title, $title){

    return get_bloginfo('name').' &bull; '.$title;

}
add_filter('admin_title', 'jt_admin_title', 10, 2);



/* ************************************ *
 * REMOVE‘워드프레스’ FROM LOGIN <title>
 ************************************** */
function jt_login_title( $login_title, $title ) {
	$login_title = $title . ' | ' . get_bloginfo( 'name' );
	return $login_title;
}
add_filter( 'login_title', 'jt_login_title', 10, 2 );



/* ************************************ *
 * REMOVE DASHBOARD WIDGET
 ************************************** */
function jt_remove_dashboard_widgets() {

 	// Main column:
	remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_browser_nag' , 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_site_health', 'dashboard', 'normal' );

	// Side Column:
	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_secondary', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );

}
add_action('wp_dashboard_setup', 'jt_remove_dashboard_widgets' );



/* ************************************** *
 * JPEG IMAGE QUALITY 100
 * ************************************** */
function jt_jpeg_quality() {
	return 100;
}
add_filter( 'jpeg_quality', 'jt_jpeg_quality' );



/* ************************************** *
 * 큰이미지 사이즈 업로드시 scale 현상 수정
 * ************************************** */
add_filter( 'big_image_size_threshold', '__return_false' );



/* ************************************** *
 * CUSTOM ADMIN STYLE
 * ************************************** */
function jt_remove_admin_bar_items( $wp_admin_bar ) {
	$wp_admin_bar->remove_node( 'wp-logo' );
	$wp_admin_bar->remove_node( 'comments' );
	$wp_admin_bar->remove_node( 'customize' );
	//$wp_admin_bar->remove_node( 'edit' );
	$wp_admin_bar->remove_node( 'new-content' );
	$wp_admin_bar->remove_node( 'search' );
	$wp_admin_bar->remove_node( 'updates' );
    $wp_admin_bar->remove_menu( 'WPML_ALS' );
}
add_action( 'admin_bar_menu', 'jt_remove_admin_bar_items', 999 );



/* ************************************** *
 * ALLOW UPLOAD HWP FILE
 * ************************************** */
function jt_custom_upload_mimes ( $existing_mimes = array() ) {
    $existing_mimes['hwp'] = 'application/x-hwp';
    $existing_mimes['egg'] = 'application/alzip';
    $existing_mimes['svg'] = 'image/svg+xml';
    $existing_mimes['avif'] = 'image/avif';

    return $existing_mimes;
}
add_filter('upload_mimes', 'jt_custom_upload_mimes',999);



/* ************************************** *
 * Custom admin profile page
 * ************************************** */
function jt_custom_admin_profil_page(){

	if(is_admin()){
        // remove theme color
	    remove_action( 'admin_color_scheme_picker', 'admin_color_scheme_picker' );

	    // remove gravatar profil image
        add_filter( 'option_show_avatars', '__return_false' );
	}

}
add_action( 'admin_init', 'jt_custom_admin_profil_page' );



/* ************************************** *
 * Custom admin profile page
 * ************************************** */
function jt_admin_default_avatar() {
?>
	<style type="text/css">
		#wp-admin-bar-my-account > .ab-item:before { background-image: url( <?php echo get_site_icon_url( 180 ); ?> ) !important; /* important required to overwrite wp default style (which use important TT) */ }
	</style>
<?php
}
add_action( 'admin_head', 'jt_admin_default_avatar' );



/* ************************************** *
 * Custom admin dashboard widget revision
 * ************************************** */
function jt_page_dashboard_widget() {
    // use add_meta_box instead of wp_add_dashboard_widget to allow right positioning
	add_meta_box(
        'jt_page_dashboard_widget',// Widget slug.
        '최근 수정 페이지', // Title.
        'jt_page_dashboard_widget_function',// Display function.
		'dashboard',
        'normal',
        'high'
    );
}
add_action( 'wp_dashboard_setup', 'jt_page_dashboard_widget' );



function jt_page_dashboard_widget_function () {

    global $wpdb;

    $sql        = $wpdb->prepare(
                    "
                        SELECT * FROM {$wpdb->posts} WHERE post_type=%s ORDER BY post_modified DESC LIMIT %d
                    ",
                    'revision',
                    10
                );
    $list       = $wpdb->get_results( $sql, ARRAY_A );
?>
    <table class="widefat" style="margin-bottom:5px;">
        <thead>
            <tr>
                <th colspan="3">최근 수정 페이지</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ( $list as $item ) { ?>
            <?php
                $post_id = $item['post_parent'];
		        $user = get_user_by( 'id', $item["post_author"] );
		        $username = $user->user_login;
                $admin_posturl = admin_url( 'post.php?post=' . $post_id ) . '&action=edit';
            ?>
                <tr class="jt-dashboard-log-item">
                    <td class="jt-dashboard-log-item__title"><a href= "<?php echo $admin_posturl; ?>"><?php echo get_the_title( $post_id ); ?></a></td>
                    <td class="jt-dashboard-log-item__author"><?php echo $username; ?></td>
                    <td class="jt-dashboard-log-item__date"><?php echo $item['post_date']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

<?php
}



/* ************************************** *
 * Mobile preview
 * ************************************** */
function jt_mobile_preview_dashboard_widget() {
    // use add_meta_box instead of wp_add_dashboard_widget to allow right positioning
	add_meta_box(
        'jt_mobile_preview_dashboard_widget',// Widget slug.
        '모바일 미리보기', // Title.
        'jt_mobile_preview_dashboard_widget_render',// Display function.
		'dashboard',
        'normal', 'high'
    );
}
add_action( 'wp_dashboard_setup', 'jt_mobile_preview_dashboard_widget' );



function jt_mobile_preview_dashboard_widget_render() {
?>
	<div class="jt_mobile_preview">
		<div class="jt_mobile_preview_inner">
		  <div class="jt_mobile_preview_iframe_container">
			  <div class="jt_mobile_preview_iframe_wrapper">
				<iframe class="jt_mobile_preview_iframe" src="/?no_admin" frameborder="0" height="480"></iframe>
			  </div>
		  </div>
		</div>
	</div>
<?php
}



function jt_mobile_preview_dashboard_widget_js() {
?>
    <script>

        var style = '';
            style += '<style type="text/css">';
            style += '::-webkit-scrollbar { width: 2px; height: 2px;}';
            style += '::-webkit-scrollbar-button { width: 0px; height: 0px;}';
            style += '::-webkit-scrollbar-thumb { background: #e1e1e1; border: 0px none #ffffff; border-radius: 50px;}';
            style += '::-webkit-scrollbar-thumb:hover { background: #ffffff;}';
            style += '::-webkit-scrollbar-thumb:active { background: #ffffff;}';
            style += '::-webkit-scrollbar-track { background: #ffffff; border: 0px none #ffffff; border-radius: 50px;}';
            style += '::-webkit-scrollbar-track:hover { background: #ffffff;}';
            style += '::-webkit-scrollbar-track:active { background: #ffffff;}';
            style += '::-webkit-scrollbar-corner {background: transparent;}';
            style += 'html.wp-toolbar{padding-top: 0 !important;}';
            style += '.wpadminbar{display:none !important;}';
            style += '</style>';

            jQuery('.jt_mobile_preview_iframe').on('load',function(){
                jQuery(this).contents().find('body').append(style);
            })

    </script>
<?php
}
add_action( 'admin_footer', 'jt_mobile_preview_dashboard_widget_js', 999 );



function jt_mobile_preview_hide_admin_bar() {
	if(isset($_GET['no_admin'])){
        add_filter( 'show_admin_bar', '__return_false' );
	}
}
add_action( 'init', 'jt_mobile_preview_hide_admin_bar', 1 );