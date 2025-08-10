<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover" />

    <?php wp_head(); ?>

    <?php // webfont ?>
    <?php /* <script type="module" src="https://8fl3k30sy0.execute-api.ap-northeast-2.amazonaws.com/v1/api/fontstream/djs/?sid=gAAAAABlqO9-cgebYvR2crE8NSJcjRo6DZ_cuhocm7JBOleZbzdjPF0RPZtcciWCzsJ4adZWSX7R8TNZOtHGjE7xvijmNENxAFPjD4lzPjIY2MSDOHLDjX_jHFuRO-K1fkVzFueCnfZUTjiPCDaUCNVhHCMA3lUona0AtJZSLQRVuWsCOgS2N04LQJxle-MnOapAiyq_ArQXNSji7FvoulUNGCPb9EsY0VlfvFUH-cDstWkxFjhN_yoHLDdKbQeyaRKBWkzkr1kw" charset="utf-8"></script> */ ?>

    <?php if( is_page_template(array('sub/stores-offline.php')) ) : ?>
        <?php // google map ?>
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBHzjz542fkjdLlJ9vil9GUTBlRcyeSKq4&callback=initMap&libraries=marker&v=beta&region=KR"></script>
    <?php endif; ?>

    <?php if (strpos(home_url(), 'purito.com') !== false): ?>
        <meta name="google-site-verification" content="E2YAvTaFe3LEXHM_tbLLD-x2C3LPfYTTkkd570t8HWc" />

        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-N8QQ5M2C');</script>
        <!-- End Google Tag Manager -->

        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-DBJ6B5N8B5"></script>
        <script>window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date());
        gtag('config', 'G-DBJ6B5N8B5');
        </script>
    <?php endif; ?>

</head>

<body <?php body_class(); ?>>

    <?php if (strpos(home_url(), 'purito.com') !== false): ?>
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-N8QQ5M2C" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->
    <?php endif; ?>

    <script>
        if( document.body.classList.contains('home') && sessionStorage.getItem('jt-visited-session') != 1 ) { // first init
            sessionStorage.setItem('jt-visited-session', '1');
            document.body.classList.add('logo-expand');
        }
    </script>

    <div id="skip">
        <a href="#main"><?php _e( 'Go home', 'jt' ); ?></a>
    </div><!-- #skip -->

    <header id="header" class="<?php if(is_page_template(array('sub/ingredients.php','sub/ingredients-centella.php','sub/brand-story.php', 'sub/create-me.php')) || in_array('single-ingredient',get_body_class())) echo 'header--invert'; ?>">

        <div class="header__inner">
            <<?php logo_tag(); ?> id="logo">
                <a href="<?php bloginfo('url'); ?>/">
                    <i class="logo-purito"><?php jt_svg('/images/layout/logo-purito.svg'); ?></i>
                    <i class="logo-seoul"><?php jt_svg('/images/layout/logo-seoul.svg'); ?></i>
                </a>
            </<?php logo_tag(); ?>><!-- #logo -->

            <nav class="menu-container">
                <?php wp_nav_menu(array(
                    'theme_location' => 'main-menu',
                    'menu_id'        => 'menu',
                    'container'      => false,
                    'link_before'    => '<span>',
                    'link_after'     => '<i class="jt-icon"><svg width="12" height="12" viewBox="0 0 12 12" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6.1,9.4L1.3,4.7l1.4-1.4L6,6.6l3.2-3.3l1.4,1.4L6.1,9.4z" fill="black"/>
                    </svg></i></span>'
                )); ?>

                <div class="sub-menu-banner">
                    <?php
                    $gnb_banner_data = get_field('common_settings_banner_gnb' , 'option');
                    ?>
                    <div class="sub-menu-banner__bg" data-unveil="<?php echo jt_get_image_src( $gnb_banner_data['image'], 'jt_thumbnail_596x350' ); ?>"></div>
                    <div class="sub-menu-banner__content">
                        <p class="sub-menu-banner__title jt-typo--05"><?php echo $gnb_banner_data['text']; ?></p>
                        <a class="sub-menu-banner__btn jt-typo--15" href="<?php echo $gnb_banner_data['link']; ?>"><span><?php _e( 'Shop Now' ) ?></span></a>
                    </div><!-- .sub-menu-banner__content -->
                </div><!-- .sub-menu-banner -->
            </nav><!-- .menu-container -->

            <div class="menu-overlay" id="menu-overlay"></div>

            <nav class="side-menu-container">
                <?php wp_nav_menu(array(
                    'theme_location' => 'side-menu',
                    'menu_id'        => 'side-menu',
                    'container'      => false,
                    'link_before'    => '<span>',
                    'link_after'     => '<i class="jt-icon"><svg width="12" height="12" viewBox="0 0 12 12" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6.1,9.4L1.3,4.7l1.4-1.4L6,6.6l3.2-3.3l1.4,1.4L6.1,9.4z" fill="black"/>
                    </svg></i></span>'
                )); ?>
            </nav><!-- .menu-container -->

            <div class="search-controller">
                <a href="#search-modal" class="search-controller__btn">
                    <span class="sr-only"><?php _e( 'Search Open', 'jt' ); ?></span>
                    <i class="jt-icon"><?php jt_icon('jt-search'); ?></i>
                </a><!-- .search-controller__btn -->
            </div><!-- .search-controller -->

            <div class="lang-container">
                <a class="lang-menu-btn" href="#lang-menu">
                    <i class="jt-icon"><?php jt_icon('jt-globe'); ?></i>
                </a>

                <ul id="lang-menu" class="lang-menu">
                    <li class="jt-typo--14 <?php echo ( jt_get_lang() == 'en' ? 'lang-menu--current':''); ?>" lang="en"><a href="/"><span><?php _e( 'Eng', 'jt' ); ?></span></a></li>
                    <li class="jt-typo--14 <?php echo ( jt_get_lang() == 'ko' ? 'lang-menu--current':''); ?>" lang="en"><a href="/ko"><span><?php _e( 'Kor', 'jt' ); ?></span></a></li>
                </ul><!-- .lang-menu -->
            </div><!-- .lang-container -->
        </div><!-- .header__inner -->

        <a href="#small-menu-container" id="small-menu-controller" class="small-menu-controller">
            <span class="small-menu-controller__line small-menu-controller__line--01"></span>
            <span class="small-menu-controller__line small-menu-controller__line--02"></span>
            <span class="small-menu-controller__line small-menu-controller__line--03"></span>
        </a><!-- #small-menu-controller -->

        <div id="small-menu-container" class="small-menu-container">
            <div class="small-menu-container__inner">
                <nav class="small-menu-nav">
                    <?php wp_nav_menu(array(
                        'theme_location' => 'small-menu',
                        'menu_id'        => 'small-menu',
                        'container'      => false,
                        'link_before'    => '<span>',
                        'link_after'     => '</span>'
                    )); ?>
                </nav><!-- .small-menu-nav -->

                <div class="small-menu-banner">
                    <div class="small-menu-banner__bg" style="background-image: url(<?php echo jt_get_image_src( $gnb_banner_data['image'], 'jt_thumbnail_596x350' ); ?>)"></div>
                    <div class="small-menu-banner__content">
                        <p class="small-menu-banner__title jt-typo--05"><?php _e( '10-Second Rapid Soothing', 'jt' ) ?></p>
                        <a class="small-menu-banner__btn jt-typo--15" href="<?php echo $gnb_banner_data['link']; ?>"><span><?php _e( 'Shop Now' , 'jt' ) ?></span></a>
                    </div><!-- .small-menu-banner__content -->
                </div><!-- .small-menu-banner -->
            </div><!-- .small-menu-container__inner -->
        </div><!-- .small-menu-container -->

        <div class="small-menu-overlay" id="small-menu-overlay"></div>
    </header>

    <div id="search-modal" class="search-modal">
		<div class="search-modal__inner">
			<button id="search-modal__close" class="search-modal__close">
                <span class="sr-only"><?php _e( 'Close', 'jt' ); ?></span>
                <i class="jt-icon"><?php jt_icon('jt-close-small-2px'); ?></i>
            </button>

			<div class="wrap-small">
				<div class="search-modal__content">
                    <?php if ( function_exists( 'jt_search_form' ) ) : ?>
						<?php jt_search_form(); ?>
					<?php endif; ?>

					<div class="search-modal__option">
                        <div class="search-modal__keyword">
							<b class="search-modal__keyword-title jt-typo--08"><?php _e( 'Suggestions', 'jt' ); ?></b>
                            <ul class="search-modal__keyword-list">
                                <?php foreach ( get_field( 'common_settings_search_keywords' , 'option' ) as $item ) : ?>
                                <li><a class="jt-typo--16" href="<?php echo $item['link']; ?>"><span><?php echo $item['keyword']; ?></span></a></li>
                                <?php endforeach; ?>
                            </ul>
						</div><!-- .search-modal__keyword -->

                        <div class="search-modal__product">
                            <b class="search-modal__product-title jt-typo--08"><?php _e( 'Recommended Products', 'jt' ); ?></b>
                            <div class="search-modal__product-list-wrap swiper">
                                <ul class="search-modal__product-list swiper-wrapper">
                                    <?php foreach ( get_field('common_settings_search_product_search_exposure' , 'option') as $item ) : ?>
                                        <?php
                                        $search_product_data = get_field( 'product_data_basic', $item);
                                        $product_background = get_field('common_settings_product_background' , 'option');
                                        ?>
                                        <li class="search-modal__product-item swiper-slide">
                                            <a href="<?php echo ( ! empty ( $search_product_data['use_outlink'] ) ? $search_product_data['outlink'] : get_permalink($item) ); ?>">
                                                <figure class="search-modal__product-figure jt-lazyload">
                                                    <span class="search-modal__product-figure-bg" style="<?php echo ( ! empty ( $product_background ) ? 'background:' . $product_background : '' ); ?>"></span>
                                                    <img width="1192" height="1192" data-unveil="<?php echo jt_get_image_src( $search_product_data['thumbnail']['list'], 'jt_thumbnail_1192x1192' ); ?>" src="<?php echo get_stylesheet_directory_uri(); ?>/images/layout/blank.gif" alt="" />
                                                    <noscript><img src="<?php echo jt_get_image_src( $search_product_data['thumbnail']['list'], 'jt_thumbnail_1192x1192' ); ?>" alt="" /></noscript>
                                                </figure>
                                                <p class="search-modal__product-list-title jt-typo--15"><?php echo $search_product_data['title']; ?></p>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>

                                <div class="swiper-pagination"></div>
                            </div><!-- .search-modal__product-list-wrap -->


                            <div class="swiper-navigation">
                                <div class="swiper-button swiper-button-prev">
                                    <div class="jt-icon"><?php jt_icon('jt-chevron-left-smaller-2px-square'); ?></div>
                                    <span class="sr-only"><?php _e( 'PREV', 'jt' ); ?></span>
                                </div><!-- .swiper-button-prev -->

                                <div class="swiper-button swiper-button-next">
                                    <div class="jt-icon"><?php jt_icon('jt-chevron-right-smaller-2px-square'); ?></div>
                                    <span class="sr-only"><?php _e( 'NEXT', 'jt' ); ?></span>
                                </div><!-- .swiper-button-next -->
                            </div><!-- .swiper_navigation -->
                        </div><!-- .search-modal__product -->
					</div><!-- .search-modal__option -->
				</div><!-- .search-modal__content -->
			</div><!-- .wrap-small -->

		</div><!-- .search-modal__inner -->
	</div><!-- #search-modal -->

    <div id="search-modal-overlay" class="search-modal-overlay"></div>

    <main id="main" class="main-container">
