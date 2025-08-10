<?php get_header(); ?>

<?php if(have_posts()) : ?>
	<?php while( have_posts()) : the_post(); ?>

        <?php 
            $data               = get_field( 'ingredient' );
            $top_image          = $data['top_image'] ?? array();
		    $benefit            = $data['benefit'] ?? array();
            $characteristic     = $data['characteristic'] ?? array();
            $introduction       = $data['introduction'] ?? array();
            $maximizing         = $data['maximizing'] ?? array();
            $recommend          = $data['recommend'] ?? array();
            
            $top_thumb = ( wp_is_mobile() ) ? $top_image['background']['mobile'] : $top_image['background']['pc'];
            $top_pc_image     = jt_get_image_src( $top_image['background']['pc'], 'jt_thumbnail_1903x660' );
            $top_mobile_image = jt_get_image_src( $top_image['background']['mobile'], 'jt_thumbnail_780x1294' );
        ?>
		<div class="article ingredients-detail">
			<div class="article__header article__header--visual">
                <div class="article__visual">
                    <div class="article__visual-bg article__visual-bg--large" style="background-image: url(<?php echo $top_pc_image; ?>)"></div>
                    <div class="article__visual-bg article__visual-bg--small" style="background-image: url(<?php echo ( ! empty ( $top_mobile_image ) ? $top_mobile_image : $top_pc_image ); ?>)"></div>
                    
                    <div class="article__visual-content">
                        <div class="wrap">
                            <span class="article__visual-cat jt-typo--05" lang="en"><?php echo $top_image['subtitle']; ?></span>
                            <h1 class="article__visual-title jt-typo--02"><?php echo $top_image['title']; ?></h1>
                        </div><!-- .wrap -->
                    </div><!-- .article__visual-content -->
                </div><!-- .article__visual -->
			</div><!-- .article__header -->

			<div class="article__body">
                <div class="wrap">
                    <div class="ingredients-detail-colgroup col-type--image col-type--right">
                        <div class="ingredients-detail-colgroup__contents">
                            <span class="ingredients-detail-colgroup__sub jt-typo--06" lang="en"><?php echo $benefit['subtitle']; ?></span>
                            <h2 class="ingredients-detail-colgroup__title jt-typo--03"><?php echo $benefit['title']; ?></h2>

                            <p class="ingredients-detail-colgroup__desc jt-typo--13">
                                <?php echo $benefit['desc']; ?>
                            </p><!-- .ingredients-detail-colgroup__desc -->
                        </div><!-- .ingredients-detail-colgroup__contents -->

                        <div class="ingredients-detail-colgroup__figure jt-img-motion--appear">
                            <figure class="jt-lazyload">
                                <img width="749" height="749" data-unveil="<?php echo jt_get_image_src( $benefit['background'], 'jt_thumbnail_749x749' ); ?>" src="<?php echo get_stylesheet_directory_uri(); ?>/images/layout/blank.gif" alt="<?php echo $benefit['title']; ?>" />
                                <noscript><img src="<?php echo jt_get_image_src( $benefit['background'], 'jt_thumbnail_749x749' ); ?>" alt="<?php echo $benefit['title']; ?>" /></noscript>
                            </figure><!-- .jt-lazyload -->
                        </div><!-- .ingredients-detail-colgroup__figure -->
                    </div><!-- .ingredients-detail-colgroup -->

                    <div class="ingredients-detail-colgroup <?php echo ( $characteristic['type'] == 'four' ? 'col-type--gallery' : 'col-type--image col-type--left' ); ?>">
                        <?php if ( $characteristic['type'] == 'four' ) : ?>
                            <div class="ingredients-detail-colgroup__gallery">
                                <div class="ingredients-detail-colgroup__gallery-figure jt-img-motion--appear">
                                    <figure class="jt-lazyload">
                                        <img width="619" height="486" data-unveil="<?php echo jt_get_image_src( $characteristic['multiple_image']['first_image'], 'jt_thumbnail_1238x912' ); ?>" src="<?php echo get_stylesheet_directory_uri(); ?>/images/layout/blank.gif" alt="" />
                                        <noscript><img src="<?php echo jt_get_image_src( $characteristic['multiple_image']['first_image'], 'jt_thumbnail_1238x912' ); ?>" alt="" /></noscript>
                                    </figure><!-- .jt-lazyload -->
                                </div><!-- .ingredients-detail-colgroup__gallery-figure -->

                                <div class="ingredients-detail-colgroup__gallery-figure jt-img-motion--appear">
                                    <figure class="jt-lazyload">
                                        <img width="402" height="402" data-unveil="<?php echo jt_get_image_src( $characteristic['multiple_image']['second_image'], 'jt_thumbnail_804x804' ); ?>" src="<?php echo get_stylesheet_directory_uri(); ?>/images/layout/blank.gif" alt="" />
                                        <noscript><img src="<?php echo jt_get_image_src( $characteristic['multiple_image']['second_image'], 'jt_thumbnail_804x804' ); ?>" alt="" /></noscript>
                                    </figure><!-- .jt-lazyload -->
                                </div><!-- .ingredients-detail-colgroup__gallery-figure -->

                                <div class="ingredients-detail-colgroup__gallery-figure jt-img-motion--appear">
                                    <figure class="jt-lazyload">
                                        <img width="673" height="515" data-unveil="<?php echo jt_get_image_src( $characteristic['multiple_image']['third_image'], 'jt_thumbnail_1346x1030' ); ?>" src="<?php echo get_stylesheet_directory_uri(); ?>/images/layout/blank.gif" alt="" />
                                        <noscript><img src="<?php echo jt_get_image_src( $characteristic['multiple_image']['third_image'], 'jt_thumbnail_1346x1030' ); ?>" alt="" /></noscript>
                                    </figure><!-- .jt-lazyload -->
                                </div><!-- .ingredients-detail-colgroup__gallery-figure -->

                                <div class="ingredients-detail-colgroup__gallery-figure jt-img-motion--appear">
                                    <figure class="jt-lazyload">
                                        <img width="495" height="380" data-unveil="<?php echo jt_get_image_src( $characteristic['multiple_image']['fourth_image'], 'jt_thumbnail_990x760' ); ?>" src="<?php echo get_stylesheet_directory_uri(); ?>/images/layout/blank.gif" alt="" />
                                        <noscript><img src="<?php echo jt_get_image_src( $characteristic['multiple_image']['fourth_image'], 'jt_thumbnail_990x760' ); ?>" alt="" /></noscript>
                                    </figure><!-- .jt-lazyload -->
                                </div><!-- .ingredients-detail-colgroup__gallery-figure -->
                            </div><!-- .ingredients-detail-colgroup__gallery -->
                        <?php else : // 1종이미지 ?>
                            <div class="ingredients-detail-colgroup__figure jt-img-motion--appear">
                                <figure class="jt-lazyload">
                                    <img width="749" height="980" data-unveil="<?php echo jt_get_image_src( $characteristic['image'], 'jt_thumbnail_749x980' ); ?>" src="<?php echo get_stylesheet_directory_uri(); ?>/images/layout/blank.gif" alt="" />
                                    <noscript><img src="<?php echo jt_get_image_src( $characteristic['image'], 'jt_thumbnail_749x980' ); ?>" alt="" /></noscript>
                                </figure><!-- .jt-lazyload -->
                            </div><!-- .ingredients-detail-colgroup__figure -->
                            
                        <?php endif; ?>
                        <div class="ingredients-detail-colgroup__contents">
                            <span class="ingredients-detail-colgroup__sub jt-typo--06"><?php echo $characteristic['subtitle']; ?></span>
                            <h2 class="ingredients-detail-colgroup__title jt-typo--03"><?php echo $characteristic['title']; ?></h2>

                            <p class="ingredients-detail-colgroup__desc jt-typo--13">
                                <?php echo $characteristic['desc']; ?>
                            </p><!-- .ingredients-detail-colgroup__desc -->
                        </div><!-- .ingredients-detail-colgroup__contents -->
                    </div><!-- .ingredients-detail-colgroup -->

                    <div class="ingredients-detail-topography">
                        <div class="ingredients-detail-topography__bg-wrap">
                            <?php 
                            $introduction_pc_image     = jt_get_image_src($introduction['background']['pc'], 'jt_thumbnail_1820x1100' );
                            $introduction_mobile_image = jt_get_image_src($introduction['background']['mobile'], 'jt_thumbnail_358x550' );
                            ?>
                            <div class="ingredients-detail-topography__bg ingredients-detail-topography__bg--large" style="background-image: url(<?php echo $introduction_pc_image; ?>)"></div>
                            <div class="ingredients-detail-topography__bg ingredients-detail-topography__bg--small" style="background-image: url(<?php echo ( ! empty ( $introduction_mobile_image ) ? $introduction_mobile_image : $introduction_pc_image ); ?>)"></div>
                        </div><!-- .ingredients-detail-topography__bg-wrap -->

                        <div class="ingredients-detail-topography__contents jt-motion--stagger">
                            <h2 class="ingredients-detail-topography__title jt-typo--03 jt-motion--stagger-item"><?php echo $introduction['title']; ?></h2>
                            
                            <p class="ingredients-detail-topography__desc jt-typo--13 jt-motion--stagger-item">
                                <?php echo $introduction['desc']; ?>
                            </p><!-- .ingredients-detail-topography__desc -->
                        </div><!-- .ingredients-detail-topography__contents -->
                    </div><!-- .ingredients-detail-topography -->

                    <div class="ingredients-detail-process">
                        <div class="ingredients-detail-process__contents">
                            <h2 class="ingredients-detail-process__title jt-typo--04"><?php echo $maximizing['title']; ?></h2>

                            <p class="ingredients-detail-process__desc jt-typo--13">
                                <?php echo $maximizing['desc']; ?>
                            </p><!-- .ingredients-detail-process__desc -->
                        </div><!-- .ingredients-detail-process__contents -->

                        <ul class="ingredients-detail-process__list">
                            <?php foreach( $maximizing['procedure'] as $idx => $item ) : ?>
                                <li class="ingredients-detail-process__card">
                                    <div class="ingredients-detail-process__card-contents">
                                        <span class="ingredients-detail-process__card-num jt-typo--07"><?php echo $idx+1; ?></span>
                                        <h3 class="ingredients-detail-process__card-title jt-typo--07"><?php echo $item['text']; ?></h3>
                                    </div><!-- .ingredients-detail-process__card-contents -->
                                    
                                    <figure class="ingredients-detail-process__card-thumb jt-lazyload">
                                        <img width="556" height="556" data-unveil="<?php echo jt_get_image_src( $item['image'], 'jt_thumbnail_556x556' ); ?>" src="<?php echo get_stylesheet_directory_uri(); ?>/images/layout/blank.gif" alt="" />
                                        <noscript><img src="<?php echo jt_get_image_src( $item['image'], 'jt_thumbnail_556x556' ); ?>" alt="" /></noscript>
                                    </figure><!-- .ingredients-detail-process__card-thumb -->
                                </li><!-- .ingredients-detail-process__card -->
                            <?php endforeach; ?>
                        </ul><!-- .ingredients-detail-process__list -->

                        <p class="ingredients-detail-process__comment jt-typo--14">
                            <?php echo $maximizing['bottom_description']; ?>
                        </p><!-- .ingredients-detail-process__comment -->
                    </div><!-- .ingredients-detail-process -->
                    
                    <div class="ingredients-detail-product">
                        <h2 class="ingredients-detail-product__title jt-typo--04" lang="en"><?php echo do_shortcode($recommend['title']); ?></h2>

                        <div class="global-product-list-wrap jt-motion--rise">
                            <div class="global-product-list col-4 swiper">
                                <div class="swiper-wrapper">
                                    
                                    <?php foreach( $recommend['list'] as $product_id ) : ?>
                                        <?php
                                            $product_data = get_field( 'product_data', $product_id )['basic'];
                                            $product_image = $product_data['thumbnail'];
                                            $product_price = ( $product_data['use_outlink'] ) ? $product_data['price'] : $product_data['options'][0]['price'];
                                            $product_background = get_field('common_settings_product_background' , 'option'); 
                                            $product_url = ( $product_data['use_outlink'] ) ? $product_data['outlink'] : get_the_permalink($product_id);
                                        ?>
                                        
                                        <div class="global-product-list__item swiper-slide" style ="<?php echo ( ! empty ( $product_background ) ? 'background:' . $product_background : '' ); ?>">
                                            <a class="global-product-list__link" href="<?php echo $product_url ?>" <?php if( $product_data['use_outlink'] ) { ?> target="_blank" rel="noopener" <?php } ?>>
                                                <div class="global-product-list__bg" data-unveil="<?php echo jt_get_image_src($product_image['hover'], 'jt_thumbnail_596x840' ); ?>"></div>
                                                
                                                <div class="global-product-list__bg--mo"></div>
                                                
                                                <div class="global-product-list__img-wrap jt-lazyload">
                                                    <img width="1192" height="1192" data-unveil="<?php echo jt_get_image_src($product_image['list'], 'jt_thumbnail_1192x1192' ); ?>" src="<?php echo get_stylesheet_directory_uri(); ?>/images/layout/blank.gif" alt="" />
                                                    <noscript><img src="<?php echo jt_get_image_src($product_image['list'], 'jt_thumbnail_1192x1192' ); ?>" alt="" /></noscript>
                                                </div>
                    
                                                <div class="global-product-list__content">
                                                    <h4 class="global-product-list__title jt-typo--14"><?php echo $product_data['title']; ?></h4>
                                                    <span class="global-product-list__detail jt-typo--16"><?php echo $product_price; ?></span>
                                                </div>

                                                <?php if ( $product_data['use_outlink'] ) : ?>
                                                    <i class="global-product-list__outlink-icon"><?php jt_svg( '/images/icon/jt-outlink.svg' ); ?></i>
                                                <?php endif; ?>
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

                                <div class="swiper-pagination"></div>
                            </div><!-- global-product-list -->
                        </div><!-- global-product-list-wrap -->
                    </div><!-- .ingredients-detail-product -->
                </div><!-- .wrap -->
			</div><!-- .article__body -->
		</div><!-- .article -->

	<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>
