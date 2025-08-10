<form class="jt-search" action="<?php the_permalink(); ?>" autocomplete="off">
    <div class="jt-search__bundle">
        <div class="jt-search__field">
            <input id="jt-search__input" class="jt-search__input" name="search" type="text" value="<?php echo $s_val; ?>" />
            <label for="jt-search__input" class="jt-search__label"><?php _e( '검색어를 입력해주세요.', 'jt' ); ?></label>
        </div><!-- .jt-search__field -->

        <button type="submit" class="jt-search__submit">
            <span class="sr-only"><?php _e( '검색', 'jt' ); ?></span>
            <i class="jt-icon"><?php jt_icon('jt-search'); ?></i>
        </button><!-- .jt-search__submit -->

        <button type="reset" class="jt-search__reset">
            <span class="sr-only"><?php _e( '검색어 지우기', 'jt' ); ?></span>
            <i class="jt-icon"><?php jt_icon('jt-reset'); ?></i>
        </button><!-- .jt-search__reset -->
    </div><!-- .jt-search__bundle -->
</form><!-- .jt-search -->
