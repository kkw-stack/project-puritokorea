	</main><!-- .main_container -->

	<?php if ( is_home() ) { ?>
		<div id="custom-cursor"><div class="custom-cursor__inner"><div class="custom-hover-circle"></div></div></div>
		<div id="custom-cursor-text"><div class="custom-cursor__inner"><div lang="en" class="custom-hover-text"><span></span></div></div></div>
	<?php } ?>

	<footer id="footer">
		<div class="footer__inner">
			<div class="footer__top">
				<div class="footer__newsletter">
					<p class="footer__newsletter-desc jt-typo--06"><?php _e( 'Purito Seoul is a contemporary Korean <br />brand that draws inspiration from <br />Korean ingredients and culture.', 'jt' ); ?></p>
					<?php /*
					<a class="footer__newsletter-btn" href="#">
						<span><?php _e( 'News letter', 'jt' ); ?></span>
						<i class="jt-icon"><?php jt_icon('jt-arrow-up-right'); ?></i>
					</a>
					*/ ?>
				</div><!-- .footer__section -->

				<div class="footer__extend">
					<nav class="footer__menu-container">
						<ul class="footer__menu">
							<li class="footer__menu-group">
								<span class="footer__menu-title jt-typo--13" lang="en">We are Purito Seoul</span>
								<ul class="footer__menu-list">
									<li><a class="jt-typo--secondary" href="<?php jt_get_lang() == 'ko' ? the_permalink(471) : the_permalink(684) ?>"><span>About Us</span></a></li>
									<li><a class="jt-typo--secondary" href="<?php jt_get_lang() == 'ko' ? the_permalink(479) : the_permalink(693) ?>/?cate=press"><span>Blog</span></a></li>
									<li><a class="jt-typo--secondary" href="<?php jt_get_lang() == 'ko' ? the_permalink(479) : the_permalink(693) ?>/?cate=news"><span>News</span></a></li>
								</ul>
							</li>
							<li class="footer__menu-group">
								<span class="footer__menu-title jt-typo--13" lang="en">Products</span>
								<ul class="footer__menu-list">
									<li><a class="jt-typo--secondary" href="<?php echo get_bloginfo('url'); ?>/product-labels/best/"><span>Best Sellers</span></a></li>
									<li><a class="jt-typo--secondary" href="<?php echo get_bloginfo('url'); ?>/product-labels/new/"><span>New Arrivals</span></a></li>
									<li><a class="jt-typo--secondary" href="<?php echo get_bloginfo('url'); ?>/product/"><span>All Products</span></a></li>
								</ul>
							</li>
							<li class="footer__menu-group">
								<span class="footer__menu-title jt-typo--13" lang="en">Help</span>
								<ul class="footer__menu-list">
									<li><a class="jt-typo--secondary" href="<?php jt_get_lang() == 'ko' ? the_permalink(483) : the_permalink(697) ?>"><span>FAQ</span></a></li>
									<li><a class="jt-typo--secondary" href="<?php jt_get_lang() == 'ko' ? the_permalink(481) : the_permalink(688) ?>"><span>Contact Us</span></a></li>
									<li><a class="jt-typo--secondary" href="<?php jt_get_lang() == 'ko' ? the_permalink(488) : the_permalink(699) ?>"><span>Stores</span></a></li>
								</ul>
							</li>
						</ul>
					</nav><!-- .footer__menu-container -->

					<nav class="footer__sns-container">
						<ul class="footer__sns">
							<li class="footer__sns--tiktok">
								<a href="https://www.tiktok.com/@purito_official" target="_blank" rel="noopener">
									<span class="sr-only"><?php _e( 'Open tiktok', 'jt' ); ?></span>
									<div class="jt-icon"><?php jt_icon('jt-tiktok'); ?></div>
								</a>
							</li>
							<li class="footer__sns--instagram">
								<a href="https://www.instagram.com/purito_official/" target="_blank" rel="noopener">
									<span class="sr-only"><?php _e( 'Open instagram', 'jt' ); ?></span>
									<div class="jt-icon"><?php jt_icon('jt-instagram'); ?></div>
								</a>
							</li>
							<li class="footer__sns--youtube">
								<a href="https://www.youtube.com/@purito_official" target="_blank" rel="noopener">
									<span class="sr-only"><?php _e( 'Open youtube', 'jt' ); ?></span>
									<div class="jt-icon"><?php jt_icon('jt-youtube'); ?></div>
								</a>
							</li>
						</ul><!-- .footer__sns -->
					</nav><!-- .footer__sns-container -->

					<div class="footer__extend-parenthesis footer__extend-parenthesis--left"><?php jt_svg('/images/layout/parenthesis-left.svg'); ?></div>
					<div class="footer__extend-parenthesis footer__extend-parenthesis--right"><?php jt_svg('/images/layout/parenthesis-left.svg'); ?></div>
				</div><!-- .footer__extend -->
			</div><!-- .footer__top -->

			<p class="jt-typo--secondary footer__copyright"><?php _e( '&copy; 2024 Purito. All rights reserved.', 'jt' ); ?></p>
		</div><!-- .footer__inner -->

		<a href="#main" id="go-top" class="go-top go-top--hide">
			<i class="jt-icon go-top__parenthesis"><?php jt_svg('/images/layout/top-btn-parenthesis.svg'); ?></i>
			<i class="jt-icon go-top__logo"><?php jt_svg('/images/layout/top-btn-logo.svg'); ?></i>
			<i class="jt-icon go-top__arrow"><?php jt_svg('/images/layout/top-btn-arrow.svg'); ?></i>
		</a>
	</footer>

    <?php wp_footer(); ?>

</body>
</html>
