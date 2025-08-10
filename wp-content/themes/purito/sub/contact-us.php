<?php
  /*
    Template Name: Contact Us
  */
?>
<?php get_header(); ?>

<?php if(have_posts()) : ?>
	<?php while( have_posts()) : the_post(); ?>
        <?php
        $contactus_data = get_field( 'contactus', 'options' );
        ?>
		<div class="article contact-us">
			<div class="article__header">
				<div class="wrap">
					<h1 class="article__title jt-typo--02 jt-motion--appear" lang="en"><?php _e( 'Get In Touch <br />With Us', 'jt' ); ?></h1>
                    <?php if ( jt_is_lang('en') ): ?>
                    <p class="article__desc jt-typo--13 jt-motion--appear"><?php _e( 'Contact us or visit us', 'jt' ); ?></p>
                    <?php endif; ?>
				</div><!-- .wrap -->
			</div><!-- .article__header -->

			<div class="article__body">
				<div class="wrap">
					<div class="contact-email">
                        <ul class="contact-email__list jt-motion--stagger">
                            <?php foreach ( $contactus_data['contact'] as $row ) : ?>
                                <li class="contact-email__item jt-motion--stagger-item">
                                    <div class="contact-email__box">
                                        <div class="contact-email__title">
                                            <b class="jt-typo--06"><?php echo $row['title']; ?></b>
                                            <p class="jt-typo--14"><?php echo $row['explanation']; ?></p>
                                        </div><!-- .contact-email__title -->
                                        
                                        <a class="contact-email__address" href="mailto:<?php echo antispambot($row['email']);?>">
                                            <span class="jt-typo--13" lang="en"><?php echo antispambot($row['email']);?></span>
                                            <i class="jt-icon"><?php jt_icon('jt-arrow-up-right'); ?></i>
                                        </a><!-- .contact-email__address -->
                                    </ㅇ><!-- .contact-email__box -->
                                </li><!-- .contact-email__item -->
                            <?php endforeach; ?>
                        </ul><!-- .contact-email__list -->
                    </div><!-- .contact-email -->

					<div class="contact-about jt-motion--rise">
                        <div class="contact-about__bg">
                            <div class="jt-fullvid-container jt-autoplay-inview">
                                <span class="jt-fullvid__poster">
                                    <span class="jt-fullvid__poster-bg" style="background-image: url(<?php echo  jt_get_image_src( $contactus_data['background'], 'jt_thumbnail_1820x1100' ); ?>);"></span>
                                </span><!-- .jt-fullvid__poster -->
                            </div><!-- .jt-fullvid-container -->
                        </div><!-- .contact-about__bg -->

                        <div class="contact-about__contents jt-motion--stagger">
                            <h2 class="contact-about__title jt-typo--02 jt-motion--stagger-item" lang="en"><?php echo $contactus_data['title']; ?></h2>
                            
                            <p class="contact-about__desc jt-typo--13 jt-motion--stagger-item">
                                <?php echo $contactus_data['description']; ?>
                            </p>

                            <a class="jt-btn__basic jt-btn--type-02 jt-btn--small jt-motion--stagger-item" href="<?php echo $contactus_data['link']; ?>" lang="en">
                                <span><?php _e( 'Learn more', 'jt' ); ?></span>
                                <i class="jt-icon"><?php jt_icon('jt-chevron-right-mini-2px-square'); ?></i>
                            </a>
                        </div><!-- .contact-about__contents -->
                    </div><!-- .contact-about -->

					<div class="contact-koffice jt-motion--rise">
                        <div class="contact-koffice__contents jt-motion--stagger">
                            <h2 class="contact-koffice__title jt-typo--04 jt-motion--stagger-item"><?php _e( 'Purito Seoul Korea Office', 'jt' ); ?></h2>
                            
                            <p class="contact-koffice__desc jt-typo--13 jt-motion--stagger-item">
                                <?php _e( 'Songdo TechnoPark IT Center S-Dong 2501~3-ho <br />Songdogwahak-ro 32 Yeonsu-gu, Incheon, Republic of Korea <br />Postal Code: 21984', 'jt' ); ?>
                            </p>
                        </div><!-- .contact-koffice__contents -->
                    </div><!-- .contact-koffice -->
				</div><!-- .wrap -->
			</div><!-- .article__body -->
		</div><!-- .article -->
	<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>