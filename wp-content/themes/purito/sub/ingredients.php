<?php
  /*
    Template Name: Ingredients
  */
?>

<?php get_header(); ?>

<?php if(have_posts()) : ?>
	<?php while( have_posts()) : the_post(); ?>

		<div class="article article--ingredients">
			<div class="article__header article__header--visual">
                <div class="article__visual jt-full-h">
                    <div class="article__visual-bg article__visual-bg--large"></div>
                    <div class="article__visual-bg article__visual-bg--small"></div>
                    
                    <div class="article__visual-content">
                        <div class="wrap">
                            <h1 class="article__visual-title jt-typo--02"><?php _e( "Natural Ingredients <br />Rooted in <br class='smbr' />Korean Nature", "jt" ); ?></h1>
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

                <div class="ingredients-container">

                    <div class="ingredients-view">
                        <div class="ingredients-view__inner wrap">
                            <div class="ingredients-map">
                                <div class="ingredients-map__bg">
                                    <?php jt_svg('/images/sub/ingredients/ingredients-map.svg'); ?>
                                </div><!-- .ingredients-map__bg -->
                                
                                <ul class="ingredients-map__location">
                                    <li class="ingredients-map__location-item ingredients-map__location-item--goesan">
                                        <div class="ingredients-map__location-content">
                                            <b class="ingredients-map__location-title jt-typo--06"><?php _e( 'Goesan County', 'jt' ); ?></b>
                                            <p class="ingredients-map__location-desc jt-typo--14"><?php _e( 'A plantation where Centella thrives <br />in various climates, enduring <br />strong sunlight, rain and snow.', 'jt' ); ?></p>
                                        </div><!-- .ingredients-map__location-content -->
                                        <i class="ingredients-map__location-dot"><span></span></i>
                                    </li>
                                    <li class="ingredients-map__location-item ingredients-map__location-item--hapcheon">
                                        <div class="ingredients-map__location-content">
                                            <b class="ingredients-map__location-title jt-typo--06"><?php _e( 'Hapcheon County', 'jt' ); ?></b>
                                            <p class="ingredients-map__location-desc jt-typo--14"><?php _e( 'A plantation where Centella <br />perseveres through harsh terrains.', 'jt' ); ?></p>
                                        </div><!-- .ingredients-map__location-content -->
                                        <i class="ingredients-map__location-dot"><span></span></i>
                                    </li>
                                    <li class="ingredients-map__location-item ingredients-map__location-item--jeju">
                                        <div class="ingredients-map__location-content">
                                            <b class="ingredients-map__location-title jt-typo--06"><?php _e( 'Jeju Island', 'jt' ); ?></b>
                                            <p class="ingredients-map__location-desc jt-typo--14"><?php _e( 'A plantation where Centella <br />grows amidst powerful wind and sea.', 'jt' ); ?></p>
                                        </div><!-- .ingredients-map__location-content -->
                                        <i class="ingredients-map__location-dot"><span></span></i>
                                    </li>
                                    <li class="ingredients-map__location-item ingredients-map__location-item--gangwon">
                                        <div class="ingredients-map__location-content">
                                            <b class="ingredients-map__location-title jt-typo--06"><?php _e( 'Gangwondo', 'jt' ); ?></b>
                                            <p class="ingredients-map__location-desc jt-typo--14"><?php _e( 'The origin of nutrient-rich, <br />hydrating Deep Sea Water.', 'jt' ); ?></p>
                                        </div><!-- .ingredients-map__location-content -->
                                        <i class="ingredients-map__location-dot"><span></span></i>
                                    </li>
                                    <li class="ingredients-map__location-item ingredients-map__location-item--gunsan">
                                        <div class="ingredients-map__location-content">
                                            <b class="ingredients-map__location-title jt-typo--06"><?php _e( 'Gunsan', 'jt' ); ?></b>
                                            <p class="ingredients-map__location-desc jt-typo--14"><?php _e( 'Nutrient-rich coastal soil, ideal for <br />cultivating soothing and moisturizing Oats.', 'jt' ); ?></p>
                                        </div><!-- .ingredients-map__location-content -->
                                        <i class="ingredients-map__location-dot"><span></span></i>
                                    </li>
                                    <li class="ingredients-map__location-item ingredients-map__location-item--damyang">
                                        <div class="ingredients-map__location-content">
                                            <b class="ingredients-map__location-title jt-typo--06"><?php _e( 'Damyang', 'jt' ); ?></b>
                                            <p class="ingredients-map__location-desc jt-typo--14"><?php _e( 'A lush Bamboo forest where skin barrier-<br />strengthening Bamboo is harvested.', 'jt' ); ?></p>
                                        </div><!-- .ingredients-map__location-content -->
                                        <i class="ingredients-map__location-dot"><span></span></i>
                                    </li>
                                    <li class="ingredients-map__location-item ingredients-map__location-item--cheongdo">
                                        <div class="ingredients-map__location-content">
                                            <b class="ingredients-map__location-title jt-typo--06"><?php _e( 'Cheongdo Hanjae', 'jt' ); ?></b>
                                            <p class="ingredients-map__location-desc jt-typo--14"><?php _e( 'Home of Minari, a skin vitality <br class="smbr" />supporter, <br />nestled between <br class="smbr" />sunlit mountains.', 'jt' ); ?></p>
                                        </div><!-- .ingredients-map__location-content -->
                                        <i class="ingredients-map__location-dot"><span></span></i>
                                    </li>
                                    <li class="ingredients-map__location-item ingredients-map__location-item--jeju-secondary">
                                        <div class="ingredients-map__location-content">
                                            <b class="ingredients-map__location-title jt-typo--06"><?php _e( 'Jeju Island', 'jt' ); ?></b>
                                            <p class="ingredients-map__location-desc jt-typo--14"><?php _e( 'An island adorned with fields of Hydrangea, <br />the secret to wrinkle-free and elastic skin.', 'jt' ); ?></p>
                                        </div><!-- .ingredients-map__location-content -->
                                        <i class="ingredients-map__location-dot"><span></span></i>
                                    </li>
                                    <li class="ingredients-map__location-item ingredients-map__location-item--jeju-tertiary">
                                        <div class="ingredients-map__location-content">
                                            <b class="ingredients-map__location-title jt-typo--06"><?php _e( 'Jeju Island', 'jt' ); ?></b>
                                            <p class="ingredients-map__location-desc jt-typo--14"><?php _e( 'An island dotted with skin-rejuvenating <br />starflowers that resemble the night sky.', 'jt' ); ?></p>
                                        </div><!-- .ingredients-map__location-content -->
                                        <i class="ingredients-map__location-dot"><span></span></i>
                                    </li>
                                </ul>
                                
                                <div class="ingredients-map__road ingredients-map__road--whole"><?php jt_svg('/images/sub/ingredients/ingredients-road-whole.svg'); ?></div>
                                
                                <div class="ingredients-map__plane"><?php jt_svg('/images/sub/ingredients/ingredients-plane.svg'); ?></div>
                            </div><!-- .ingredients-map -->
                        </div><!-- .ingredients-view__inner -->

                        <div class="ingredients-card">
                            <div class="ingredients-card__inner wrap">
                                <div class="ingredients-card__item ingredients-card--centella">
                                    <a class="ingredients-card__item-inner" href="<?php the_permalink( jt_is_lang('ko') ? 431 : 1696 ); ?>">
                                        <div class="ingredients-card__thumb-wrap">
                                            <figure class="ingredients-card__thumb jt-lazyload">
                                                <img data-unveil="<?php echo get_stylesheet_directory_uri(); ?>/images/sub/ingredients/ingredients-centella.jpg" src="<?php echo get_stylesheet_directory_uri(); ?>/images/layout/blank.gif" alt="" />
                                                <noscript><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/sub/ingredients/ingredients-centella.jpg" alt="" /></noscript>
                                            </figure>
                                        </div><!-- .ingredients-card__thumb-wrap -->
                                        <div class="ingredients-card__content">
                                            <span class="ingredients-card__subtitle jt-typo--13"><?php _e( 'Powerful Soothing', 'jt' ); ?></span>
                                            <b class="ingredients-card__title jt-typo--06">
                                                <span><?php _e( 'Korean Centella Asiatica', 'jt' ); ?></span>
                                                <div class="ingredients-card__title-circle">
                                                    <i class="jt-icon ingredients-card__title--default"><?php jt_icon('jt-chevron-right-tiny-2px-square'); ?></i>
                                                </div>
                                            </b>
                                        </div><!-- .ingredients-card__content -->
                                    </a><!-- .ingredients-card__item-inner -->
                                    <i class="ingredients-card__spotlight"></i>
                                </div><!-- .ingredients-card__item -->
        
                                <div class="ingredients-card__item ingredients-card--deepsea">
                                    <a class="ingredients-card__item-inner" href="<?php the_permalink( jt_is_lang('ko') ? 448 : 1709); ?>">
                                        <div class="ingredients-card__thumb-wrap">
                                            <figure class="ingredients-card__thumb jt-lazyload">
                                                <img data-unveil="<?php echo get_stylesheet_directory_uri(); ?>/images/sub/ingredients/ingredients-deepsea.jpg" src="<?php echo get_stylesheet_directory_uri(); ?>/images/layout/blank.gif" alt="" />
                                                <noscript><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/sub/ingredients/ingredients-deepsea.jpg" alt="" /></noscript>
                                            </figure>
                                        </div><!-- .ingredients-card__thumb-wrap -->
                                        <div class="ingredients-card__content">
                                            <span class="ingredients-card__subtitle jt-typo--13"><?php _e( 'Intensely Hydrating', 'jt' ); ?></span>
                                            <b class="ingredients-card__title jt-typo--06">
                                                <span><?php _e( 'Deep Sea Water', 'jt' ); ?></span>
                                                <div class="ingredients-card__title-circle">
                                                    <i class="jt-icon ingredients-card__title--default"><?php jt_icon('jt-chevron-right-tiny-2px-square'); ?></i>
                                                </div>
                                            </b>
                                        </div><!-- .ingredients-card__content -->
                                    </a><!-- .ingredients-card__item-inner -->
                                    <i class="ingredients-card__spotlight"></i>
                                </div><!-- .ingredients-card__item -->

                                <div class="ingredients-card__item ingredients-card--oats">
                                    <a class="ingredients-card__item-inner" href="<?php the_permalink( jt_is_lang('ko') ? 3212 : 5824); ?>">
                                        <div class="ingredients-card__thumb-wrap">
                                            <figure class="ingredients-card__thumb jt-lazyload">
                                                <img data-unveil="<?php echo get_stylesheet_directory_uri(); ?>/images/sub/ingredients/ingredients-oat.jpg" src="<?php echo get_stylesheet_directory_uri(); ?>/images/layout/blank.gif" alt="" />
                                                <noscript><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/sub/ingredients/ingredients-oat.jpg" alt="" /></noscript>
                                            </figure>
                                        </div><!-- .ingredients-card__thumb-wrap -->
                                        <div class="ingredients-card__content">
                                            <span class="ingredients-card__subtitle jt-typo--13"><?php _e( 'A Time-Honored Skincare Grain', 'jt' ); ?></span>
                                            <b class="ingredients-card__title jt-typo--06">
                                                <span><?php _e( 'Oat', 'jt' ); ?></span>
                                                <div class="ingredients-card__title-circle">
                                                    <i class="jt-icon ingredients-card__title--default"><?php jt_icon('jt-chevron-right-tiny-2px-square'); ?></i>
                                                </div>
                                            </b>
                                        </div><!-- .ingredients-card__content -->
                                    </a><!-- .ingredients-card__item-inner -->
                                    <i class="ingredients-card__spotlight"></i>
                                </div><!-- .ingredients-card__item -->

                                <div class="ingredients-card__item ingredients-card--bamboo">
                                    <a class="ingredients-card__item-inner" href="<?php the_permalink( jt_is_lang('ko') ? 2587 : 5038); ?>">
                                        <div class="ingredients-card__thumb-wrap">
                                            <figure class="ingredients-card__thumb jt-lazyload">
                                                <img data-unveil="<?php echo get_stylesheet_directory_uri(); ?>/images/sub/ingredients/ingredients-bamboo.jpg" src="<?php echo get_stylesheet_directory_uri(); ?>/images/layout/blank.gif" alt="" />
                                                <noscript><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/sub/ingredients/ingredients-bamboo.jpg" alt="" /></noscript>
                                            </figure>
                                        </div><!-- .ingredients-card__thumb-wrap -->
                                        <div class="ingredients-card__content">
                                            <span class="ingredients-card__subtitle jt-typo--13"><?php _e( 'Skin Barrier Strengthening', 'jt' ); ?></span>
                                            <b class="ingredients-card__title jt-typo--06">
                                                <span><?php _e( 'Bamboo', 'jt' ); ?></span>
                                                <div class="ingredients-card__title-circle">
                                                    <i class="jt-icon ingredients-card__title--default"><?php jt_icon('jt-chevron-right-tiny-2px-square'); ?></i>
                                                </div>
                                            </b>
                                        </div><!-- .ingredients-card__content -->
                                    </a><!-- .ingredients-card__item-inner -->
                                    <i class="ingredients-card__spotlight"></i>
                                </div><!-- .ingredients-card__item -->

                                <div class="ingredients-card__item ingredients-card--minari">
                                    <a class="ingredients-card__item-inner" href="<?php the_permalink( jt_is_lang('ko') ? 3129 : 5693); ?>">
                                        <div class="ingredients-card__thumb-wrap">
                                            <figure class="ingredients-card__thumb jt-lazyload">
                                                <img data-unveil="<?php echo get_stylesheet_directory_uri(); ?>/images/sub/ingredients/ingredients-minari.jpg" src="<?php echo get_stylesheet_directory_uri(); ?>/images/layout/blank.gif" alt="" />
                                                <noscript><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/sub/ingredients/ingredients-minari.jpg" alt="" /></noscript>
                                            </figure>
                                        </div><!-- .ingredients-card__thumb-wrap -->
                                        <div class="ingredients-card__content">
                                            <span class="ingredients-card__subtitle jt-typo--13"><?php _e( 'Vitalizing UV defender', 'jt' ); ?></span>
                                            <b class="ingredients-card__title jt-typo--06">
                                                <span><?php _e( 'Minari', 'jt' ); ?></span>
                                                <div class="ingredients-card__title-circle">
                                                    <i class="jt-icon ingredients-card__title--default"><?php jt_icon('jt-chevron-right-tiny-2px-square'); ?></i>
                                                </div>
                                            </b>
                                        </div><!-- .ingredients-card__content -->
                                    </a><!-- .ingredients-card__item-inner -->
                                    <i class="ingredients-card__spotlight"></i>
                                </div><!-- .ingredients-card__item -->

                                <div class="ingredients-card__item ingredients-card--hydrangea">
                                    <a class="ingredients-card__item-inner" href="<?php the_permalink( jt_is_lang('ko') ? 2031 : 4275); ?>">
                                        <div class="ingredients-card__thumb-wrap">
                                            <figure class="ingredients-card__thumb jt-lazyload">
                                                <img data-unveil="<?php echo get_stylesheet_directory_uri(); ?>/images/sub/ingredients/ingredients-hydrangea.jpg" src="<?php echo get_stylesheet_directory_uri(); ?>/images/layout/blank.gif" alt="" />
                                                <noscript><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/sub/ingredients/ingredients-hydrangea.jpg" alt="" /></noscript>
                                            </figure>
                                        </div><!-- .ingredients-card__thumb-wrap -->
                                        <div class="ingredients-card__content">
                                            <span class="ingredients-card__subtitle jt-typo--13"><?php _e( 'Elasticity Enhancement', 'jt' ); ?></span>
                                            <b class="ingredients-card__title jt-typo--06">
                                                <span><?php _e( 'Hydrangea', 'jt' ); ?></span>
                                                <div class="ingredients-card__title-circle">
                                                    <i class="jt-icon ingredients-card__title--default"><?php jt_icon('jt-chevron-right-tiny-2px-square'); ?></i>
                                                </div>
                                            </b>
                                        </div><!-- .ingredients-card__content -->
                                    </a><!-- .ingredients-card__item-inner -->
                                    <i class="ingredients-card__spotlight"></i>
                                </div><!-- .ingredients-card__item -->

                                <div class="ingredients-card__item ingredients-card--starflower">
                                    <a class="ingredients-card__item-inner" href="<?php the_permalink( jt_is_lang('ko') ? 2869 : 5320); ?>">
                                        <div class="ingredients-card__thumb-wrap">
                                            <figure class="ingredients-card__thumb jt-lazyload">
                                                <img data-unveil="<?php echo get_stylesheet_directory_uri(); ?>/images/sub/ingredients/ingredients-starflower.jpg" src="<?php echo get_stylesheet_directory_uri(); ?>/images/layout/blank.gif" alt="" />
                                                <noscript><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/sub/ingredients/ingredients-starflower.jpg" alt="" /></noscript>
                                            </figure>
                                        </div><!-- .ingredients-card__thumb-wrap -->
                                        <div class="ingredients-card__content">
                                            <span class="ingredients-card__subtitle jt-typo--13"><?php _e( 'Skin brightening moisture', 'jt' ); ?></span>
                                            <b class="ingredients-card__title jt-typo--06">
                                                <span><?php _e( 'Starflower', 'jt' ); ?></span>
                                                <div class="ingredients-card__title-circle">
                                                    <i class="jt-icon ingredients-card__title--default"><?php jt_icon('jt-chevron-right-tiny-2px-square'); ?></i>
                                                </div>
                                            </b>
                                        </div><!-- .ingredients-card__content -->
                                    </a><!-- .ingredients-card__item-inner -->
                                    <i class="ingredients-card__spotlight"></i>
                                </div><!-- .ingredients-card__item -->
                            </div><!-- .wrap -->

                            <div class="ingredients-card__pagination">
                                <span class="ingredients-card__pagination-num">
                                    <span class="ingredients-card__pagination-current">
                                        <span class="ingredietns-card__pagination-current-inner">
                                            <span>1</span>
                                            <span>2</span>
                                            <span>3</span>
                                            <span>4</span>
                                            <span>5</span>
                                            <span>6</span>
                                            <span>7</span>
                                        </span>
                                    </span>
                                    <span class="ingredients-card__pagination-slug">
                                        <svg width="4" height="16" viewBox="0 0 4 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M3 4H4L1 13H0L3 4Z" fill="#133E35"/>
                                        </svg>
                                    </span>
                                    <span class="ingredients-card__pagination-total">7</span>
                                </span>
                            </div><!-- .ingredients-card__pagination -->
                        </div><!-- .ingredients-card -->
                    </div><!-- .ingredients-view -->

                    <div class="ingredients-typo">
                        <div class="wrap">
                            <p class="ingredients-typo__txt jt-typo--05 jt-motion--appear"><?php _e( 'Our journey at Purito Seoul is a never ending exploration, <br />uncovering the secrets of Korean natural ingredients.', 'jt' ); ?></p>
                        </div><!-- .wrap -->
                    </div><!-- .ingredients-typo -->

                </div><!-- .ingredients-container -->

                <div class="ingredients-progress-bar"><i></i></div>

                <div class="ingredients-tutorial">
                    <div class="ingredietns-tutorial__content">
                        <div class="ingredients-tutorial__content-inner">
                            <i class="ingredients-tutorial__icon">
                                <span class="ingredients-tutorial__icon-front"><?php jt_svg('/images/layout/scroll-down-arrow.svg'); ?></span>
                                <span class="ingredients-tutorial__icon-back"><?php jt_svg('/images/layout/scroll-down-arrow.svg'); ?></span>
                            </i>
                            <p class="ingredietns-tutorial__txt jt-typo--11"><?php _e( 'Scroll through and experience <br />Purito&#39;s journey.', 'jt' ); ?></p>
                            <a class="ingredients-tutorial__close" href="#"><span class="jt-typo--15"><?php _e( 'OK, I got it', 'jt' ); ?></span></a>
                        </div><!-- .ingredients-tutorial__content-inner -->
                    </div><!-- .ingredietns-tutorial__content -->
                </div><!-- .ingredients-tutorial -->
                
			</div><!-- .article__body -->
		</div><!-- .article -->

	<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>
