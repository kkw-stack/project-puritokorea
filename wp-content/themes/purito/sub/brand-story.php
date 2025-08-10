<?php
  /*
    Template Name: Brand Story
  */
?>

<?php get_header(); ?>

<?php if(have_posts()) : ?>
	<?php while( have_posts()) : the_post(); ?>
        <?php
        $brand_story_data = get_field( 'brand_story', 'options' );
        ?>
		<div class="article brandstory">
			<div class="article__header article__header--visual">
                <div class="article__visual jt-full-h">
                    <div class="article__visual-bg article__visual-bg--large" style="background-image:url('<?php echo jt_get_image_src( $brand_story_data['background']['pc'], 'jt_thumbnail_1903x954' ); ?>')"></div>
                    <div class="article__visual-bg article__visual-bg--small" style="background-image:url('<?php echo jt_get_image_src( $brand_story_data['background']['mobile'], 'jt_thumbnail_780x1294' ); ?>')"></div>
                    
                    <div class="article__visual-content">
                        <div class="wrap">
                            <h1 class="article__visual-title jt-typo--02" lang="en"><?php _e( 'Purito’s Story', 'jt' ); ?></h1>
                            <p class="article__visual-desc jt-typo--13">
                                <?php _e( 'Purito Seoul is a contemporary Korean skincare brand that draws inspiration from Korean ingredients <br />
                                and culture to create delightful, sensorial experiences that connect and inspire.', 'jt' ); ?>
                            </p>
                        </div><!-- .wrap -->
                    </div><!-- .article__visual-content -->

                    <a class="scroll-down" href="#scroll-down-target">
                        <i class="jt-icon">
                            <?php jt_svg('/images/layout/scroll-down-arrow-small.svg')?>
                        </i>
                    </a>
                </div><!-- .article__visual -->
			</div><!-- .article__header -->

            <div class="article__body" id="scroll-down-target">
                <div class="brandstory-slogan">
                    <div class="jt-marquee-wrap">
                        <div lang="en" class="jt-marquee jt-typo--01" data-label="Rooted in Wonder. Rooted in Wonder. ">Rooted in Wonder. Rooted in Wonder. </div><!-- .jt-marquee -->
                    </div><!-- .jt-marquee-wrap -->
                </div><!-- .brandstory-slogan -->

                <div class="brandstory-intro jt-motion--rise jt-motion--rise-small">
                    <div class="wrap">
                        <div class="brandstory-intro__bg jt-motion--rise jt-motion--rise-large">
                            <div class="brandstory-intro__bg-inner">
                                <div class="jt-fullvid-container jt-autoplay-inview">
                                    <?php if ( wp_is_mobile() ) { ?>
                                        <iframe class="jt-fullvid" src="https://player.vimeo.com/video/997977446?quality=728p&autopause=0&loop=1&muted=1&controls=0" width="728" height="728" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
                                    <?php } else { ?> 
                                        <iframe class="jt-fullvid" src="https://player.vimeo.com/video/997621441?quality=1080p&autopause=0&loop=1&muted=1&controls=0" width="1903" height="1080" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
                                    <?php } ?>
                                    
                                    <span class="jt-fullvid__poster">
                                        <span class="jt-fullvid__poster-bg" style="background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/sub/brandstory/brandstory-intro-bg.jpg?v1.2);"></span>
                                    </span><!-- .jt-fullvid__poster -->
                                </div><!-- .jt-fullvid-container -->
                            </div><!-- .main-skincare__bg-inner -->

                            <div class="jt-sound jt-sound--off">
                                <button class="jt-sound__btn jt-sound__btn--on">
                                    <span class="jt-typo--14">ON</span>
                                    <i class="jt-icon"><?php jt_svg('/images/layout/sound-on.svg') ?></i><!-- .jt-guide--icon -->
                                </button><!-- .jt-sound__btn -->
                                <button class="jt-sound__btn jt-sound__btn--off">
                                    <span class="jt-typo--14">OFF</span>
                                    <i class="jt-icon"><?php jt_svg('/images/layout/sound-off.svg') ?></i><!-- .jt-guide--icon -->
                                </button><!-- .jt-sound__btn -->
                            </div><!-- .jt-sound -->
                        </div><!-- .brandstory-intro__bg -->

                        <div class="brandstory-intro__contents jt-motion--rise jt-motion--rise-large">
                            <h3 class="brandstory-intro__contents-title jt-typo--04" lang="en"><?php _e( 'Touch Your ( Seoul )', 'jt' ); ?></h3>
                            <p class="brandstory-intro__contents-desc jt-typo--13"><?php _e( 'At Purito Seoul, we are captivated by the vibrant culture and limitless creativity that define Seoul - a city where nature and urban life coexist in perfect harmony.', 'jt' ); ?></p>
                        </div><!-- .brandstory-intro__contents -->
                    </div><!-- .wrap -->
                </div><!-- .brandstory-intro -->

                <div class="brandstory-to">
                    <div class="brandstory-to__inner--pc">
                        <div class="brandstory-to__column brandstory-to__column--puri">
                            <div class="brandstory-to__contents">
                                <div class="brandstory-to__title">
                                    <i><?php jt_svg('/images/layout/logo-puri.svg'); ?></i>

                                    <div class="brandstory-to__title--hidden">
                                        <span class="jt-typo--01" lang="en">fication</span>
                                    </div><!-- .brandstory-to__title--hidden -->
                                </div><!-- .brandstory-to__title -->

                                <div class="brandstory-to__desc jt-typo--13">
                                    <?php _e( 'Inspired by the Korean word 정화 - <br />"Purification", the "PURI" in our name signifies <br />our dedication to sourcing the finest, <br />pure ingredients from diverse regions of Korea.', 'jt' ); ?>
                                </div><!-- .brandstory-to__desc -->
                            </div><!-- .brandstory-to__contents -->

                            <div class="brandstory-to__bg brandstory-to__bg--main">
                                <figure class="jt-lazyload">
                                    <img width="951" height="954" data-unveil="<?php echo get_stylesheet_directory_uri(); ?>/images/sub/brandstory/brandstory-bg-water-left.jpg" src="<?php echo get_stylesheet_directory_uri(); ?>/images/layout/blank.gif" alt="" />
                                    <noscript><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/sub/brandstory/brandstory-bg-water-left.jpg" alt="" /></noscript>
                                </figure><!-- .jt-lazyload -->
                            </div>
                            <div class="brandstory-to__bg brandstory-to__bg--sub">
                                <figure class="jt-lazyload">
                                    <img width="951" height="954" data-unveil="<?php echo get_stylesheet_directory_uri(); ?>/images/sub/brandstory/brandstory-bg-water-right.jpg" src="<?php echo get_stylesheet_directory_uri(); ?>/images/layout/blank.gif" alt="" />
                                    <noscript><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/sub/brandstory/brandstory-bg-water-right.jpg" alt="" /></noscript>
                                </figure><!-- .jt-lazyload -->
                            </div>
                        </div><!-- .brandstory-to__column -->

                        <div class="brandstory-to__column brandstory-to__column--to">
                            <div class="brandstory-to__contents">
                                <div class="brandstory-to__title">
                                    <i><?php jt_svg('/images/layout/logo-to.svg'); ?></i>
                                </div><!-- .brandstory-to__title -->

                                <div class="brandstory-to__desc jt-typo--13">
                                    <?php _e( 'The 	&#39;To (土)&#39; in PURITO is derived from the Chinese <br />character for "Earth or Soil," <br />symbolizing our deep-rooted connection to <br />the planet Earth and its community.', 'jt' ); ?>
                                </div><!-- .brandstory-to__desc -->
                            </div><!-- .brandstory-to__contents -->

                            <div class="brandstory-to__bg brandstory-to__bg--sub">
                                <figure class="jt-lazyload">
                                    <img width="951" height="954" data-unveil="<?php echo get_stylesheet_directory_uri(); ?>/images/sub/brandstory/brandstory-bg-soil-left.jpg" src="<?php echo get_stylesheet_directory_uri(); ?>/images/layout/blank.gif" alt="" />
                                    <noscript><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/sub/brandstory/brandstory-bg-soil-left.jpg" alt="" /></noscript>
                                </figure><!-- .jt-lazyload -->
                            </div>
                            <div class="brandstory-to__bg brandstory-to__bg--main">
                                <figure class="jt-lazyload">
                                    <img width="951" height="954" data-unveil="<?php echo get_stylesheet_directory_uri(); ?>/images/sub/brandstory/brandstory-bg-soil-right.jpg" src="<?php echo get_stylesheet_directory_uri(); ?>/images/layout/blank.gif" alt="" />
                                    <noscript><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/sub/brandstory/brandstory-bg-soil-right.jpg" alt="" /></noscript>
                                </figure><!-- .jt-lazyload -->
                            </div>
                        </div><!-- .brandstory-to__column -->

                        <div class="brandstory-to__logo--hidden">
                            <i><?php jt_svg('/images/layout/logo-seoul.svg'); ?></i>   
                        </div><!-- .brandstory-to__logo--hidden -->

                        <div class="brandstory-to__line"></div>
                    </div><!-- .brandstory-to__inner -->

                    <div class="brandstory-to__inner--mo">
                        <div class="brandstory-to__slide">
                            <div class="brandstory-to__slide-item">
                                <div class="brandstory-to__slide-inner">
                                    <i class="brandstory-logo-purito"><?php jt_svg('/images/layout/logo-purito.svg'); ?></i>
                                    <i class="brandstory-logo-seoul"><?php jt_svg('/images/layout/logo-seoul.svg'); ?></i>
                                </div>
                            </div>
                            
                            <div class="brandstory-to__slide-item">
                                <div class="brandstory-to__slide-inner">
                                    <div class="puri">
                                        <i class="brandstory-logo-puri"><?php jt_svg('/images/layout/logo-puri.svg'); ?></i>
                                        <span class="jt-typo--02" lang="en">fication</span>
                                    </div>

                                    <div class="plus"></div>

                                    <div class="to">
                                        <i class="brandstory-logo-to"><?php jt_svg('/images/layout/logo-to.svg'); ?></i>
                                    </div>
                                </div>
                            </div>

                            <div class="brandstory-to__slide-item">
                                <div class="brandstory-to__slide-inner">
                                    <i class=""><?php jt_svg('/images/layout/logo-puri.svg'); ?></i>

                                    <div class="brandstory-to__desc jt-typo--13">
                                        <?php _e( 'Inspired by the Korean word 정화 - <br />"Purification", the "PURI" in our name signifies <br />our dedication to sourcing the finest, <br />pure ingredients from diverse regions of Korea.', 'jt' ); ?>
                                    </div><!-- .brandstory-to__desc -->
                                </div>
                            </div>

                            <div class="brandstory-to__slide-item">
                                <div class="brandstory-to__slide-inner">
                                    <i class=""><?php jt_svg('/images/layout/logo-to.svg'); ?></i>

                                    <div class="brandstory-to__desc jt-typo--13">
                                        <?php _e( 'The 	&#39;To (土)&#39; in PURITO is derived from the Chinese <br />character for "Earth or Soil," <br />symbolizing our deep-rooted connection to <br />the planet Earth and its community.', 'jt' ); ?>
                                    </div><!-- .brandstory-to__desc -->
                                </div>
                            </div>
                        </div>

                        <div class="brandstory-to__process">
                            <div class="brandstory-to__process-bar"></div>
                        </div>
                    </div>
                </div><!-- .brandstory-to -->

                <div class="brandstory-philosophy">
                    <div class="wrap-middle">
                        <h2 class="brandstory-philosophy__title jt-typo--04"><?php _e( 'Our Core Values', 'jt' ); ?></h2>

                        <ul class="brandstory-philosophy__list">
                            <li class="brandstory-philosophy__item">
                                <div class="brandstory-philosophy__contents">
                                    <h3 class="brandstory-philosophy__contents-title jt-typo--06"><?php _e( 'Explorative', 'jt' ); ?></h3>
                                    <p class="brandstory-philosophy__contents-desc jt-typo--13">
                                        <?php _e( 'Driven by a passion for exploration, we scout the Korean Peninsula for exceptional  natural ingredients. Our products blend natural Korean goodness with clinically proven actives, creating safe, effective skincare solutions for all.', 'jt' ); ?>
                                    </p><!-- .brandstory-philosophy__contents-desc -->

                                    <a class="brandstory-philosophy__contents-btn jt-btn__basic jt-btn--type-01 jt-btn--simple" href="<?php echo home_url('/ingredients/');?>">
                                        <span><?php _e( 'Explore our Korean ingredients', 'jt' ); ?></span>
                                        <div class="jt-btn__simple-circle">
                                            <?php /* <i class="jt-icon jt-btn__simple--hover"><?php jt_icon('jt-chevron-right-mini-2px-square'); ?></i> */ ?>
                                            <i class="jt-icon jt-btn__simple--default"><?php jt_icon('jt-chevron-right-mini-2px-square'); ?></i>
                                        </div>
                                    </a>
                                </div><!-- .brandstory-philosophy__contents -->

                                <div class="brandstory-philosophy__figure">
                                    <figure class="jt-lazyload">
                                        <img width="458" height="340" data-unveil="<?php echo get_stylesheet_directory_uri(); ?>/images/sub/brandstory/brandstory-philosophy-01.jpg" src="<?php echo get_stylesheet_directory_uri(); ?>/images/layout/blank.gif" alt="" />
                                        <noscript><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/sub/brandstory/brandstory-philosophy-01.jpg" alt="" /></noscript>
                                    </figure><!-- .jt-lazyload -->
                                </div><!-- .brandstory-philosophy__figure -->
                            </li><!-- .brandstory-philosophy__item -->

                            <li class="brandstory-philosophy__item">
                                <div class="brandstory-philosophy__contents">
                                    <h3 class="brandstory-philosophy__contents-title jt-typo--06"><?php _e( 'Sensorial', 'jt' ); ?></h3>
                                    <p class="brandstory-philosophy__contents-desc jt-typo--13">
                                        <?php _e( 'Meticulously crafted, our skincare products are designed to deliver not only exceptional results but also a delightful and exciting sensorial experience.', 'jt' ); ?>
                                    </p><!-- .brandstory-philosophy__contents-desc -->
                                </div><!-- .brandstory-philosophy__contents -->

                                <div class="brandstory-philosophy__figure">
                                    <figure class="jt-lazyload">
                                        <img width="458" height="340" data-unveil="<?php echo get_stylesheet_directory_uri(); ?>/images/sub/brandstory/brandstory-philosophy-02.jpg?v1.2" src="<?php echo get_stylesheet_directory_uri(); ?>/images/layout/blank.gif" alt="" />
                                        <noscript><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/sub/brandstory/brandstory-philosophy-01.jpg?v1.2" alt="" /></noscript>
                                    </figure><!-- .jt-lazyload -->
                                </div><!-- .brandstory-philosophy__figure -->
                            </li><!-- .brandstory-philosophy__item -->

                            <li class="brandstory-philosophy__item">
                                <div class="brandstory-philosophy__contents">
                                    <h3 class="brandstory-philosophy__contents-title jt-typo--06"><?php _e( 'Simplicity', 'jt' ); ?></h3>
                                    <p class="brandstory-philosophy__contents-desc jt-typo--13">
                                        <?php _e( 'Our formulations are carefully crafted, using only the most essential of ingredients. By embracing simplicity, we elevate the skincare experience, making it accessible, effective, and a daily delight.', 'jt' ); ?>
                                    </p><!-- .brandstory-philosophy__contents-desc -->
                                </div><!-- .brandstory-philosophy__contents -->

                                <div class="brandstory-philosophy__figure">
                                    <figure class="jt-lazyload">
                                        <img width="458" height="340" data-unveil="<?php echo get_stylesheet_directory_uri(); ?>/images/sub/brandstory/brandstory-philosophy-03.jpg?v1.1" src="<?php echo get_stylesheet_directory_uri(); ?>/images/layout/blank.gif" alt="" />
                                        <noscript><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/sub/brandstory/brandstory-philosophy-01.jpg" alt="" /></noscript>
                                    </figure><!-- .jt-lazyload -->
                                </div><!-- .brandstory-philosophy__figure -->
                            </li><!-- .brandstory-philosophy__item -->

                            <li class="brandstory-philosophy__item">
                                <div class="brandstory-philosophy__contents">
                                    <h3 class="brandstory-philosophy__contents-title jt-typo--06"><?php _e( 'Community-centric', 'jt' ); ?></h3>
                                    <p class="brandstory-philosophy__contents-desc jt-typo--13">
                                        <?php _e( 'We actively engage with our community, valuing their voices and empowering collaboration.', 'jt' ); ?>
                                    </p><!-- .brandstory-philosophy__contents-desc -->
                                </div><!-- .brandstory-philosophy__contents -->

                                <div class="brandstory-philosophy__figure">
                                    <figure class="jt-lazyload">
                                        <img width="458" height="340" data-unveil="<?php echo get_stylesheet_directory_uri(); ?>/images/sub/brandstory/brandstory-philosophy-04.jpg" src="<?php echo get_stylesheet_directory_uri(); ?>/images/layout/blank.gif" alt="" />
                                        <noscript><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/sub/brandstory/brandstory-philosophy-04.jpg" alt="" /></noscript>
                                    </figure><!-- .jt-lazyload -->
                                </div><!-- .brandstory-philosophy__figure -->
                            </li><!-- .brandstory-philosophy__item -->

                            <li class="brandstory-philosophy__item">
                                <div class="brandstory-philosophy__contents">
                                    <h3 class="brandstory-philosophy__contents-title jt-typo--06"><?php _e( 'Eco-ethical', 'jt' ); ?></h3>
                                    <p class="brandstory-philosophy__contents-desc jt-typo--13">
                                        <?php _e( 'Receiving our philosophy and ingredients from the Earth, we incorporate ethical and eco-conscious practices in our product development.', 'jt' ); ?>
                                    </p><!-- .brandstory-philosophy__contents-desc -->

                                    <div class="brandstory-philosophy__contents-icon-list">
                                        <div class="brandstory-philosophy__contents-icon">
                                            <figure class="jt-lazyload">
                                                <img width="80" height="80" data-unveil="<?php echo get_stylesheet_directory_uri(); ?>/images/sub/brandstory/brandstory-philosophy-icon-01.png" src="<?php echo get_stylesheet_directory_uri(); ?>/images/layout/blank.gif" alt="" />
                                                <noscript><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/sub/brandstory/brandstory-philosophy-icon-01.png" alt="" /></noscript>
                                            </figure><!-- .jt-lazyload -->
                                        </div><!-- .brandstory-philosophy__contents-icon -->

                                        <div class="brandstory-philosophy__contents-icon">
                                            <figure class="jt-lazyload">
                                                <img width="80" height="80" data-unveil="<?php echo get_stylesheet_directory_uri(); ?>/images/sub/brandstory/brandstory-philosophy-icon-02.png" src="<?php echo get_stylesheet_directory_uri(); ?>/images/layout/blank.gif" alt="" />
                                                <noscript><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/sub/brandstory/brandstory-philosophy-icon-02.png" alt="" /></noscript>
                                            </figure><!-- .jt-lazyload -->
                                        </div><!-- .brandstory-philosophy__contents-icon -->

                                        <div class="brandstory-philosophy__contents-icon">
                                            <figure class="jt-lazyload">
                                                <img width="80" height="80" data-unveil="<?php echo get_stylesheet_directory_uri(); ?>/images/sub/brandstory/brandstory-philosophy-icon-03.png" src="<?php echo get_stylesheet_directory_uri(); ?>/images/layout/blank.gif" alt="" />
                                                <noscript><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/sub/brandstory/brandstory-philosophy-icon-03.png" alt="" /></noscript>
                                            </figure><!-- .jt-lazyload -->
                                        </div><!-- .brandstory-philosophy__contents-icon -->

                                        <div class="brandstory-philosophy__contents-icon">
                                            <figure class="jt-lazyload">
                                                <img width="80" height="80" data-unveil="<?php echo get_stylesheet_directory_uri(); ?>/images/sub/brandstory/brandstory-philosophy-icon-04.png" src="<?php echo get_stylesheet_directory_uri(); ?>/images/layout/blank.gif" alt="" />
                                                <noscript><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/sub/brandstory/brandstory-philosophy-icon-04.png" alt="" /></noscript>
                                            </figure><!-- .jt-lazyload -->
                                        </div><!-- .brandstory-philosophy__contents-icon -->
                                    </div><!-- .brandstory-philosophy__contents-list -->
                                </div><!-- .brandstory-philosophy__contents -->

                                <div class="brandstory-philosophy__figure">
                                    <figure class="jt-lazyload">
                                        <img width="458" height="340" data-unveil="<?php echo get_stylesheet_directory_uri(); ?>/images/sub/brandstory/brandstory-philosophy-05.jpg" src="<?php echo get_stylesheet_directory_uri(); ?>/images/layout/blank.gif" alt="" />
                                        <noscript><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/sub/brandstory/brandstory-philosophy-05.jpg" alt="" /></noscript>
                                    </figure><!-- .jt-lazyload -->
                                </div><!-- .brandstory-philosophy__figure -->
                            </li><!-- .brandstory-philosophy__item -->
                        </ul><!-- .brandstory-philosophy__list -->
                    </div><!-- .wrap-middle -->
                </div><!-- .brandstory-philosophy -->
            </div><!-- .article__body -->
        </div><!-- .article -->

    <?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>
