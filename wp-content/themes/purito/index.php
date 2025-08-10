<?php get_header(); ?>
<?php
    $main_data = get_field( 'main_settings', 'option' );
?>

    <div class="main-visual <?php if ( ! empty( $main_data['visual']['link'] )) { ?>main-visual--show-btn<?php } ?>">
        <?php
        $visual_pc_image        = jt_get_image_src( $main_data['visual']['image']['pc'], 'jt_thumbnail_1903x1071' );
        $visual_mobile_image    = jt_get_image_src( $main_data['visual']['image']['mobile'], 'jt_thumbnail_780x1206' );
        $visual_pc_video        = $main_data['visual']['video']['pc'];
        $visual_mobile_video    = $main_data['visual']['video']['mobile'];
        ?>

        <?php // 영상일때 (large, small 마크업 둘다 뿌려줌. css로 특정 너비에서 교체됨) ?>
        <?php // PC ?>
        <?php if ( ! empty( $visual_pc_video ) ) : ?>
            <?php
            $visual_pc_video_link = add_query_arg(
                array(
                    'quality'  => '1080p',
                    'muted'    => 1,
                    'autoplay' => 1,
                    'autopause' => 0,
                    'loop'     => 1,
                    'background' => 1,
                ),
                $visual_pc_video
            )
            ?>
            <?php // large (860px~) ?>
            <div class="main-visual__bg main-visual__bg--large main-visual__bg--video">
                <div class="jt-fullvid-container jt-autoplay-inview">
                    <iframe class="jt-fullvid" src="https://player.vimeo.com/video/<?php echo $visual_pc_video_link; ?>" width="1920" height="1080" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
                    
                    <span class="jt-fullvid__poster">
                        <span class="jt-fullvid__poster-bg" style="background-image: url(<?php echo $visual_pc_image; ?>);"></span>
                    </span><!-- .jt-fullvid__poster -->
                </div><!-- .jt-fullvid-container -->

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
            </div><!-- .main-visual__bg -->
        <?php else: ?>
            <div class="main-visual__bg main-visual__bg--large" style="background-image: url(<?php echo $visual_pc_image; ?>);"></div>
        <?php endif; ?>
        
        <?php // MOBILE ?>
        <?php if ( ! empty( $visual_mobile_video ) ) : ?>
            <?php
            $visual_mobile_video_link = add_query_arg(
                array(
                    // 'quality'  => '940p',
                    'muted'    => 1,
                    'autoplay' => 1,
                    'autopause' => 0,
                    'loop'     => 1,
                    'background' => 1,
                    'controls' => 0,
                ),
                $visual_mobile_video
            )
            ?>
            <?php // small (~860px) ?>
            <div class="main-visual__bg main-visual__bg--small main-visual__bg--video">
                <div class="jt-fullvid-container jt-autoplay-inview">
                    <iframe class="jt-fullvid" src="https://player.vimeo.com/video/<?php echo $visual_mobile_video_link; ?>" width="780" height="940" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
                    
                    <span class="jt-fullvid__poster">
                        <span class="jt-fullvid__poster-bg" style="background-image: url(<?php echo ( ! empty( $visual_mobile_image ) ? $visual_mobile_image : $visual_pc_image ); ?>);"></span>
                    </span><!-- .jt-fullvid__poster -->
                </div><!-- .jt-fullvid-container -->

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
            </div><!-- .main-visual__bg -->
        <?php else: ?>
            <div class="main-visual__bg main-visual__bg--small" style="background-image: url(<?php echo ( ! empty( $visual_mobile_image ) ? $visual_mobile_image : $visual_pc_image ); ?>);"></div>
        <?php endif; ?>
        
        <?php if ( ! empty( $main_data['visual']['link'] ) && jt_is_lang('en') ): ?>
            <div class="main-visual__btn-wrap">
                <a class="jt-btn__basic jt-btn--type-02 jt-btn--small" href="<?php echo $main_data['visual']['link']; ?>">
                    <span><?php _e( 'Discover', 'jt' ); ?></span>
                    <i class="jt-icon"><?php jt_icon('jt-chevron-right-mini-2px-square'); ?></i>
                </a>
            </div><!-- .main-visual__btn-wrap -->
        <?php endif; ?>
    </div><!-- .main-visual -->
    
    <div class="main-best">
        <div class="wrap">
            <h2 class="main-section__title jt-typo--04 jt-motion--appear" data-motion-duration="1" lang="en"><?php _e( 'Discover <br />our ( Best ) Sellers', 'jt' ); ?></h2>
            
            <div class="main-best__new jt-motion--rise">
                <div class="main-best__new-bg-wrap">
                    <?php 
                    $bestseller_pc_image     = jt_get_image_src( $main_data['bestseller']['background']['pc'], 'jt_thumbnail_1820x1100' );
                    $bestseller_mobile_image = jt_get_image_src( $main_data['bestseller']['background']['mobile'], 'jt_thumbnail_358x550' );
                    ?>
                    <div class="main-best__new-bg main-best__new-bg--large" data-unveil="<?php echo $bestseller_pc_image; ?>"></div>
                    <div class="main-best__new-bg main-best__new-bg--small" data-unveil="<?php echo ( ! empty( $bestseller_mobile_image ) ? $bestseller_mobile_image : $bestseller_pc_image ); ?>"></div>
                </div><!-- .main-best__new-bg-wrap -->

                <div class="main-best__new-content jt-motion--stagger">
                    <span class="main-best__new-subtitle jt-typo--06 jt-motion--stagger-item"><?php echo $main_data['bestseller']['subtitle']; ?></span>
                    <h3 class="main-best__new-title jt-typo--03 jt-motion--stagger-item"><?php echo $main_data['bestseller']['title']; ?></h3>
                    <p class="main-best__new-desc jt-typo--13 jt-motion--stagger-item"><?php echo $main_data['bestseller']['description']; ?></p>
                    <a class="jt-btn__basic jt-btn--type-03 jt-btn--small jt-motion--stagger-item" href="<?php echo $main_data['bestseller']['link']; ?>" lang="en">
                        <span><?php _e( 'Shop Now', 'jt' ); ?></span>
                        <i class="jt-icon"><?php jt_icon('jt-chevron-right-mini-2px-square'); ?></i>
                    </a>
                </div><!-- .main-best__new-content -->
            </div><!-- .main-best__new -->

            <diV class="main-best__list-wrap global-product-list-wrap jt-motion--appear">
                <div class="global-product-list swiper">
                    <div class="swiper-wrapper">

                        <?php foreach ( $main_data['bestseller']['product'] as $item ) : ?>
                            <?php
                            $product_data       = get_field( 'product_data_basic', $item);
                            $product_background = get_field('common_settings_product_background' , 'option');
                            ?>
                            <div class="global-product-list__item swiper-slide" style ="<?php echo ( ! empty( $product_background ) ? 'background:' . $product_background : '' ); ?>">
                                <a class="global-product-list__link" href="<?php echo ( ! empty ( $product_data['use_outlink'] ) ? $product_data['outlink'] : get_permalink($item) ); ?>">
                                    <div class="global-product-list__bg" data-unveil="<?php echo jt_get_image_src( $product_data['thumbnail']['hover'], 'jt_thumbnail_596x840' ); ?>"></div>
        
                                    <div class="global-product-list__img-wrap jt-lazyload">
                                        <img width="1192" height="1192" data-unveil="<?php echo jt_get_image_src( $product_data['thumbnail']['list'], 'jt_thumbnail_1192x1192' ); ?>" src="<?php echo get_stylesheet_directory_uri(); ?>/images/layout/blank.gif" alt="" />
                                        <noscript><img src="<?php echo jt_get_image_src( $product_data['thumbnail']['list'], 'jt_thumbnail_1192x1192' ); ?>" alt="" /></noscript>

                                    </div>
        
                                    <div class="global-product-list__content">
                                        <h4 class="global-product-list__title jt-typo--13"><?php echo $product_data['title']; ?></h4>
                                        <span class="global-product-list__detail jt-typo--16"><?php echo ( ! empty( $product_data['use_outlink'] ) ? $product_data['price'] : $product_data['options'][0]['price'] ); ?></span>
                                    </div>
                                </a>
                            </div><!-- .global-product-list__item -->
                        <?php endforeach; ?>
                    </div><!-- .swiper-wrapper -->
                    
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
                </div><!-- global-product-list -->

                <div class="swiper-pagination"></div>
            </div><!-- .main-best-list-wrap -->
        </div><!-- .wrap -->
    </div><!-- .main-best -->

    <div class="main-ingredient">
        <div class="wrap">
            <h2 class="main-ingredient__title">
                <span class="main-ingredient__title-item jt-typo--04"><?php _e( 'Driven by a <br class="smbr" /><span class="main-ingredient__title--highlight">passion<i></i></span> for <br /><span class="main-ingredient__title--highlight">exploration<i></i>', 'jt' ); ?>
                <?php if ( jt_is_lang('en') ): ?>
                    </span>,
                <?php endif; ?>
                </span>
                <span class="main-ingredient__title-item jt-typo--04"><?php _e( 'we search the <span class="main-ingredient__title--highlight">Korean Peninsula<i></i></span> <br/><br class="smbr" />for the finest natural <strong>ingredients</strong>.', 'jt' ); ?></span>
            </h2>

            <div class="main-ingredient__slider swiper jt-motion--rise">
                <div class="main-ingredient__slider-inner swiper-wrapper">
                    <?php foreach ( $main_data['ingredient'] as $item ) : ?>
                        <div class="main-ingredient__slider-item swiper-slide">
                            <div class="main-ingredient__colgroup">
                                <div class="main-ingredient__first">
                                    <div class="main-ingredient__bg" data-unveil="<?php echo jt_get_image_src( $item['background'], 'jt_thumbnail_902x902' ); ?>"></div>
                                    <div class="main-ingredient__thumb-txt">
                                        <span class="main-ingredient__thumb-subtitle jt-typo--13"><?php echo $item['subtitle']; ?></span>
                                        <b class="main-ingredient__thumb-title jt-typo--04"><?php echo $item['title']; ?></b>
                                    </div><!-- .main-ingredient__thumb-txt -->
                                </div><!-- .main-ingredient__first -->

                                <div class="main-ingredient__last">
                                    <div class="main-ingredient__bg-list-wrap swiper">
                                        <div class="main-ingredient__bg-list swiper-wrapper">
                                            <?php foreach ( $item['image'] as $items ) : ?>
                                                <div class="main-ingredient__bg-item swiper-slide">
                                                    <div class="main-ingredient__bg" data-unveil="<?php echo jt_get_image_src( $items, 'jt_thumbnail_902x902' ); ?>"></div>
                                                </div><!-- .main-ingredient__bg-item -->
                                            <?php endforeach; ?>
                                        </div><!-- .main-ingredient__bg-list -->

                                        <div class="swiper-control">
                                            <div class="swiper-pagination swiper-pagination-vertical"></div>
                                        </div><!-- .swiper-control -->
                                    </div><!-- .main-ingredient__bg-list-wrap -->

                                    <div class="main-ingredient__txt jt-typo--13"><?php echo $item['description']; ?></div>
                                </div><!-- .main-ingredient__last -->

                                <a class="main-ingredient__pop-btn" href="#"></a>
                            </div><!-- .main-ingredient__colgroup -->
                        </div><!-- .main-ingredient__slider-item -->
                    <?php endforeach; ?>
                </div><!-- .main-ingredient__slider-inner -->

                <div class="main-ingredient__slider-index">
                    <ul class="main-ingredient__slider-index-list jt-motion--stagger jt-motion--stagger-large">
                        <?php foreach ( $main_data['ingredient'] as $key => $item ) : ?>
                            <li class="main-ingredient__slider-index-item <?php echo ( 0 === $key ? 'main-ingredient__slider-index-item--active' : '' );?> jt-motion--stagger-item">
                                <span class="main-ingredient__slider-index-txt">
                                    <span class="main-ingredient__slider-index-subtitle jt-typo--13"><?php echo $item['subtitle']; ?></span>
                                    <b class="main-ingredient__slider-index-title jt-typo--05"><?php echo $item['title']; ?></b>
                                </span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div><!-- .main-ingredient__slider-index -->
            </div><!-- .main-ingredient__slider -->

            <div class="main-ingredient__btn-wrap">
                <a class="jt-btn__basic jt-btn--type-05" href="<?php jt_get_lang() == 'ko' ? the_permalink(469) : the_permalink(682) ?>">
                    <span><?php _e( 'Discover Ingredients', 'jt' ); ?></span>
                    <i class="jt-icon"><?php jt_icon('jt-chevron-right-mini-2px-square'); ?></i>
                </a>
            </div><!-- .main-ingredient__btn-wrap -->
        </div><!-- .wrap -->
    </div><!-- .main-ingredient -->

    <div class="main-line">
        <div class="wrap">
            <div class="main-line__banner jt-motion--rise">
                <div class="main-line__banner-bg-wrap">
                    <?php 
                    $newarrival_pc_image     = jt_get_image_src( $main_data['new_arrival']['background']['pc'], 'jt_thumbnail_1820x980' );
                    $newarrival_mobile_image = jt_get_image_src( $main_data['new_arrival']['background']['mobile'], 'jt_thumbnail_716x1100' );
                    ?>
                    <div class="main-line__banner-bg main-line__banner-bg--large" data-unveil="<?php echo $newarrival_pc_image; ?>"></div>
                    <div class="main-line__banner-bg main-line__banner-bg--small" data-unveil="<?php echo ( ! empty( $newarrival_mobile_image ) ? $newarrival_mobile_image : $newarrival_pc_image ); ?>"></div>
                </div><!-- .main-line__banner-bg-wrap -->

                <span class="main-line__banner-label jt-typo--13" lang="en"><?php echo $main_data['new_arrival']['label']; ?></span>
                <div class="main-line__banner-content jt-motion--stagger">
                    <b class="main-line__banner-title jt-typo--03 jt-motion--stagger-item"><?php echo do_shortcode( $main_data['new_arrival']['title'] ); ?></b>
                    <p class="main-line__banner-desc jt-typo--13 jt-motion--stagger-item"><?php echo do_shortcode( $main_data['new_arrival']['description'] ); ?></p>
                    <a class="jt-btn__basic jt-btn--type-03 jt-btn--small jt-motion--stagger-item" href="<?php echo $main_data['new_arrival']['link']; ?>" lang="en">
                        <span><?php echo $main_data['new_arrival']['button']; ?></span>
                        <i class="jt-icon"><?php jt_icon('jt-chevron-right-mini-2px-square'); ?></i>
                    </a>
                </div><!-- .main-line__banner-content -->
            </div>
        </div><!-- .wrap -->
    </div><!-- .main-line -->

    <div class="main-slogan">
        <div class="jt-marquee-wrap">
            <div lang="en" class="jt-marquee jt-typo--01" data-label="Korean Green Miracle &nbsp; Korean Green Miracle &nbsp; ">Korean Green Miracle &nbsp; Korean Green Miracle &nbsp; </div><!-- .jt-marquee -->
        </div><!-- .jt-marquee-wrap -->
    </div><!-- .main-slogan -->

    <div class="main-skincare">
        <div class="wrap">
            <div class="main-skincare__colgroup jt-motion--stagger">

                <div class="main-skincare__bg-wrap jt-motion--stagger-item">
                    <?php
                    $sensorial_pc_image     = jt_get_image_src( $main_data['sensorial']['image']['pc'], 'jt_thumbnail_1208x780' );
                    $sensorial_mobile_image = jt_get_image_src( $main_data['sensorial']['image']['mobile'], 'jt_thumbnail_716x716' );
                    $sensorial_pc_video     = $main_data['sensorial']['video']['pc'];
                    $sensorial_mobile_video = $main_data['sensorial']['video']['mobile'];
                    ?>

                    <?php // pc video ?>
                    <?php if ( ! empty( $sensorial_pc_video ) ) : ?>
                        <div class="main-skincare__bg main-skincare__bg--video main-skincare__bg--large">

                            <div class="jt-fullvid-container jt-autoplay-inview">
                                <?php
                                $sensorial_pc_video_link = add_query_arg(
                                    array(
                                        'quality'  => '1080p',
                                        'muted'    => 1,
                                        'autoplay' => 1,
                                        'autopause' => 0,
                                        'loop'     => 1,
                                        'background' => 1,
                                    ),
                                    $sensorial_pc_video
                                );
                                ?>
                                <iframe class="jt-fullvid" src="https://player.vimeo.com/video/<?php echo $sensorial_pc_video_link; ?>" width="1920" height="1080" allowfullscreen></iframe>
                                
                                <span class="jt-fullvid__poster">
                                    <span class="jt-fullvid__poster-bg" style="background-image: url(<?php echo $sensorial_pc_image; ?>);"></span>
                                </span><!-- .jt-fullvid__poster -->
                            </div><!-- .jt-fullvid-container -->
                        </div><!-- .main-skincare__bg -->
                    <?php else: ?>
                        <div class="main-skincare__bg main-skincare__bg--large" data-unveil="<?php echo $sensorial_pc_image; ?>"></div>
                    <?php endif; ?>
    
                    <?php // mobile video (위와 마크업 동일, large 대신 small 클래스 (main-skincare__bg--small) ?>
                    <?php if ( ! empty( $sensorial_mobile_video ) ) : ?>
                        <div class="main-skincare__bg main-skincare__bg--video main-skincare__bg--small">
                            <div class="jt-fullvid-container jt-autoplay-inview">
                                <?php
                                $sensorial_mobile_video_link = add_query_arg(
                                    array(
                                        'quality'  => '1080p',
                                        'muted'    => 1,
                                        'autoplay' => 1,
                                        'autopause' => 0,
                                        'loop'     => 1,
                                        'background' => 1,
                                    ),
                                    $sensorial_mobile_video
                                );
                                ?>
                                <iframe class="jt-fullvid" src="https://player.vimeo.com/video/<?php echo $sensorial_mobile_video_link; ?>" width="1920" height="1080" allowfullscreen></iframe>
                                
                                <span class="jt-fullvid__poster">
                                    <span class="jt-fullvid__poster-bg" style="background-image: url(<?php echo ( ! empty( $sensorial_mobile_image ) ? $sensorial_mobile_image : $sensorial_pc_image ); ?>);"></span>
                                </span><!-- .jt-fullvid__poster -->
                            </div><!-- .jt-fullvid-container -->
                        </div><!-- .main-skincare__bg -->
                    <?php else: ?>
                        <div class="main-skincare__bg main-skincare__bg--small" data-unveil="<?php echo ( ! empty( $sensorial_mobile_image ) ? $sensorial_mobile_image : $sensorial_pc_image ); ?>"></div>
                    <?php endif; ?>
                </div><!-- .main-skincare__bg-wrap -->
    
                <div class="main-skincare__content jt-motion--stagger-item">
                    <div class="main-skincare__content-inner">
                        <h3 class="main-skincare__content-title jt-typo--04 jt-motion--stagger-item" lang="en"><?php echo $main_data['sensorial']['title']; ?></h3>
                        <p class="main-skincare__content-desc jt-typo--14 jt-motion--stagger-item"><?php echo $main_data['sensorial']['description']; ?></p>
                        <?php if ( ! empty( $main_data['sensorial']['link'] ) ) : ?>
                            <a class="jt-btn__basic jt-btn--type-01 jt-btn--simple" href="<?php echo $main_data['sensorial']['link']; ?>">
                                <span><?php _e( 'Dive Deeper', 'jt' ); ?></span>
                                <div class="jt-btn__simple-circle">
                                    <i class="jt-icon jt-btn__simple--default"><?php jt_icon('jt-chevron-right-mini-2px-square'); ?></i>
                                </div>
                            </a>
                        <?php endif; ?>
                    </div><!-- .main-skincare__content-inner -->
                </div><!-- .main-skincare__content -->
            </div><!-- .main-skincare__colgroup -->
        </div><!-- .wrap -->
    </div><!-- .main-skincare -->
    
    <div class="main-brandstory jt-full-h">
        <div class="main-brandstory__slider main-brandstory__slider--first swiper">
            <div class="swiper-wrapper">
                <?php foreach ( $main_data['touch_your_seoul'] as $key => $item ) : ?>
                    <div class="main-brandstory__slider-item swiper-slide">
                        <img loading="lazy" src="<?php echo jt_get_image_src( $item['background'], 'jt_thumbnail_1903x980' ); ?>" alt="" />
                    </div><!-- .main-brandstory__slider-item -->
                <?php endforeach; ?>

                <div class="main-brandstory__slider-item main-brandstory__slider-item--last swiper-slide">
                    <img loading="lazy" src="<?php echo get_stylesheet_directory_uri(); ?>/images/main/main-brandstory-last-bg.jpg" alt="" />
                </div><!-- .main-brandstory__slider-item -->
            </div><!-- .swiper-wrapper -->

            <canvas id="canvas" resize></canvas>

            <div class="main-brandstory__content">
                <div class="main-brandstory__content-inner jt-motion--stagger">
                    <h2 class="main-brandstory__title jt-typo--01 jt-motion--stagger-item" lang="en">
                        Touch Your 
                        <span class="main-brandstory__keyword-wrap">
                            <span class="main-brandstory__keyword">
                                <?php foreach ( $main_data['touch_your_seoul'] as $key => $item ) : ?>
                                    <span class="main-brandstory__keyword-item"><?php echo $item['keyword']; ?></span>
                                <?php endforeach; ?>
                                <span class="main-brandstory__keyword-item">Seoul</span>
                            </span><!-- .main-brandstory__keyword -->
                        </span>
                    </h2>

                    <div class="main-brandstory__desc-wrap jt-motion--stagger-item">
                        <?php foreach ( $main_data['touch_your_seoul'] as $key => $item ) : ?>
                            <p class="main-brandstory__desc <?php echo ( 0 === $key ? 'main-brandstory__desc--active jt-typo--06': 'jt-typo--07' ); ?>">
                                <span class="main-brandstory__desc-en"><?php echo $item['en_captions']; ?></span>
                                <span class="main-brandstory__desc-ko"><?php echo $item['ko_captions']; ?></span>
                            </p>
                        <?php endforeach; ?>
                    </div><!-- .main-brandstory__desc-wrap -->
                    
                    <div class="main-brandstory__last">
                        <p class="main-brandstory__last-desc jt-typo--06">
                            <?php _e( 'We explore the rich culture <br class="smbr" />and boundless <br />creativity of Seoul, <br /><br class="smbr" />where nature and urbanity <br class="smbr" />thrive in harmony.', 'jt' ); ?>
                        </p>
                        
                        <a class="jt-btn__basic jt-btn--type-03 jt-btn--small" href="<?php jt_get_lang() == 'ko' ? the_permalink(471) : the_permalink(684) ?>" lang="en">
                            <span><?php _e( 'Learn More', 'jt' ); ?></span>
                            <i class="jt-icon"><?php jt_icon('jt-chevron-right-mini-2px-square'); ?></i>
                        </a>
                    </div><!-- .main-brandstory__last -->
                </div><!-- .main-brandstory__content-inner -->
            </div><!-- .main-brandstory__content -->

            <div class="swiper-pagination"></div>

            <div class="main-brandstory__nav main-brandstory__nav--prev hide custom-hover" data-type="paging" data-name="prev">
                <span class="sr-only"><?php _e( 'PREV', 'jt' ); ?></span>
            </div>

            <div class="main-brandstory__nav main-brandstory__nav--next custom-hover" data-type="paging" data-name="next">
                <span class="sr-only"><?php _e( 'NEXT', 'jt' ); ?></span>
            </div>
        </div><!-- .main-brandstory__slider -->
    </div><!-- .main-brandstory -->

    <div class="main-insta">
        <div class="wrap">
            <h2 class="main-insta__title jt-typo--01" lang="en"><?php _e( 'Follow <br />our <br class="smbr">Seoul-full feed', 'jt' ); ?></h2>
            <span class="main-insta__txt jt-typo--06" lang="en">follow us @purito_official</span>

            <div class="main-insta__list-wrap">
                <div class="main-insta__list">
                    <?php foreach ( $main_data['insta_feed'] as $key => $item ) : ?>
                        <?php 
                        $insta_feed_image = jt_get_image_src( $item['image'], 'jt_thumbnail_443x443' ); 
                        ?>
    
                        <?php if ( 3 === $key ) : ?>
                            <div class="main-insta__list-item main-insta__list-item--txt">
                                <p class="main-insta__list-txt jt-typo--04" lang="en"><?php _e( 'follow us @purito_official', 'jt' ); ?></p>
                            </div><!-- .main-insta__list-item -->
                        <?php endif; ?>
    
                        <div class="main-insta__list-item <?php echo ( ! empty( $item['video_icon'] ) ? 'main-insta__list-item--video' : '' ); ?>">
                            <a href="<?php echo $item['link']; ?>" target="_blank" rel="noopener">
                                <figure class="main-insta__list-figure jt-lazyload">
                                    <img width="443" height="443" data-unveil="<?php echo $insta_feed_image; ?>" src="<?php echo get_stylesheet_directory_uri(); ?>/images/layout/blank.gif" alt="" />
                                    <noscript><img src="<?php echo $insta_feed_image; ?>" alt="" /></noscript>
                                </figure>
                            </a>
                        </div><!-- .main-insta__list-item -->
                    <?php endforeach; ?>
                </div><!-- .main-insta__list -->
            </div><!-- .main-insta__list-wrap -->
        </div><!-- .wrap -->
    </div><!-- .main-insta -->

<?php get_footer(); ?>
