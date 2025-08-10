<?php
/**
 * Custom Login Page Actions
 * src: http://wordpress.stackexchange.com/a/105224/83181
 */


/**
 * Custom Login Page Functions
 */
// Change the login url sitewide to the custom login page
function jt_login_url( $login_url='', $redirect='' )
{

	$login_url = jt_login_get_page_link_by_template_name('sub/login.php');
    if ( $login_url )
    {
        if (! empty($redirect) )
            $login_url = add_query_arg('redirect_to', urlencode($redirect), $login_url);
    }
    return $login_url;

}
add_filter( 'login_url', 'jt_login_url', 10, 2 );


// Redirects wp-login to custom login with some custom error query vars when needed
function jt_custom_redirect_login( $redirect_to='', $request='' )
{
    if ( 'wp-login.php' == $GLOBALS['pagenow'] )
    {
        $redirect_url = jt_login_url();

        if (! empty($_GET['action']) )
        {
            if ( 'lostpassword' == $_GET['action'] )
            {
                return;
            }
            elseif ( 'register' == $_GET['action'] )
            {
                $register_page = get_page_by_path('register');
                $redirect_url = get_permalink($register_page->ID);
            }
        }
        elseif (! empty($_GET['loggedout'])  )
        {
            $redirect_url = add_query_arg('action', 'loggedout', jt_login_url());
        }

        wp_redirect( $redirect_url );
        exit;
    }
}
add_action( 'login_head', 'jt_custom_redirect_login', 10, 2 );



// Updates login failed to send user back to the custom form with a query var
function jt_login_failed( $username ){
    $referrer = wp_get_referer();

    if ( $referrer && ! strstr($referrer, 'wp-login') && ! strstr($referrer, 'wp-admin') ) {
        if ( empty($_GET['loggedout']) ){
            wp_redirect( add_query_arg('action', 'failed', jt_login_url()) );
	     }else{
            wp_redirect( add_query_arg('action', 'loggedout', jt_login_url()) );
		 }
        exit;
    }
}
add_action( 'wp_login_failed', 'jt_login_failed', 10, 2 );



// Updates authentication to return an error when one field or both are blank
function jt_login_authenticate_username_password( $user, $username, $password ){
    if ( is_a($user, 'WP_User') ) { return $user; }

    if ( empty($username) || empty($password) )
    {
        $error = new WP_Error();
        $user  = new WP_Error('authentication_failed', __('<strong>ERROR</strong>: Invalid username or incorrect password.'));

        return $error;
    }
}
add_filter( 'authenticate', 'jt_login_authenticate_username_password', 30, 3);






function jt_login_get_page_link_by_template_name($template_name){

	 $pages = query_posts(array(
         'post_type' =>'page',
         'meta_key'  =>'_wp_page_template',
         'meta_value'=> $template_name
     ));

	 $url = '';
     $last_page = $pages[0];
	 if(isset($last_page)) {
		 $last_page_id = $last_page->ID;
		 $url = get_page_link($last_page_id );
     }

	 return $url;

}



function jt_login_get_page_id_by_template_name($template_name){

	 $pages = query_posts(array(
         'post_type' =>'page',
         'meta_key'  =>'_wp_page_template',
         'meta_value'=> $template_name
     ));

     $last_page = $pages[0];
	 $last_page_id = NULL;
	 if(isset($last_page)) {
		 $last_page_id = $last_page->ID;
     }

	 return $last_page_id ;

}


// Filter WSL plugin markup output
function wsl_jt_markup( $provider_id, $provider_name, $authenticate_url ){

	// Provider 이름 한글번역
	switch($provider_name){
	    case 'Facebook' :
		     $name = '페이스북';
			 break;
	    case 'Naver' :
		     $name = '네이버';
			 break;
		case 'Kakao' :
		     $name = '카카오톡';
			 break;
		default :
			 $name = $provider_name;
	}
	?>
        <a
           rel           = "nofollow"
           href          = "<?php echo $authenticate_url; ?>"
           data-provider = "<?php echo $provider_id ?>"
           class         = "wp-social-login-provider wp-social-login-provider-<?php echo strtolower( $provider_id ); ?> login_<?php echo strtolower( $provider_id ); ?>"
         >
            <i></i><span><?php echo $name; ?> 아이디로 로그인</span>
        </a>
    <?php
}

add_filter( 'wsl_render_auth_widget_alter_provider_icon_markup', 'wsl_jt_markup', 10, 3 );
