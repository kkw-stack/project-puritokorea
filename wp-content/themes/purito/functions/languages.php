<?php

/* ************************************** *
 * Set MO file
 * ************************************** */
function jt_theme_mo_file_init(){

    load_theme_textdomain('jt', get_template_directory() . '/languages');

}
add_action('after_setup_theme', 'jt_theme_mo_file_init');



/* **************************************** *
 * Add lang has a body class
 * **************************************** */
function jt_language_body_class($classes){

	$lang = jt_get_lang();

	$classes[] = 'lang-'.$lang;

	return $classes;

}
add_action('body_class','jt_language_body_class');



/* **************************************** *
 * Get lang short code helper
 * **************************************** */
function jt_get_lang(){

	$local = get_locale();
	$has_underscore = strpos($local, '_');

	if ($has_underscore !== false) {
	    $lang = strstr($local, '_', true);
	}else{
		$lang = $local;
	}

	return $lang;

}



/* ****************************************
 * Is lang conditional helper
 * USAGE : if(jt_is_lang('en')){  }
 * **************************************** */
function jt_is_lang($lang_shortname){

	if(jt_get_lang() === $lang_shortname){
		return true;
	}else{
		return false;
	}

}



/* ****************************************
 * Convert phone number to internation number if need
 * USAGE : jt_lang_phone('020-1223-0323')
 * **************************************** */
function jt_lang_phone($phone_num){

	if(!jt_is_lang('ko')){
		if($phone_num[0] == '0'){
			$int_phone_num = '+82-' . substr($phone_num, 1);
			return $int_phone_num;			
		}
	}
    return $phone_num;
	
}



/* **************************************** *
 * Force admin in korea
 * **************************************** */
function jt_admin_force_korean_lang() {

    if ( is_admin() ) {
        switch_to_locale('ko_KR');
    }

}
add_filter('init', 'jt_admin_force_korean_lang');



/* **************************************** *
 * Get iso3 from iso 2 code
 *
 * Note : use manual conversion because wpml
 * not provide iso3 or english version
 * on the language
 *
 * **************************************** */
function jt_language_iso2_to_iso3($iso2){

    $iso_arr = array(
        'ko' => 'KOR',
        'en' => 'ENG',
        'cn' => 'CHN',
        'ja' => 'JPN'
    );

    if ( array_key_exists( $iso2, $iso_arr ) ) {
        $iso3 = $iso_arr[ $iso2 ];
        return $iso3;
    }

}

