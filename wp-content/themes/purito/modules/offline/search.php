<form class="jt-search" action="<?php the_permalink(); ?>#offline_search" autocomplete="off">
    <div class="jt-search__bundle">
        <div class="jt-search__field">
            <input id="jt-search__input" class="jt-search__input" name="search" type="text" value="<?php echo $s_val; ?>" />
            <label for="jt-search__input" class="jt-search__label"><?php _e( 'Type a postcode or address', 'jt' ); ?></label>
        </div><!-- .jt-search__field -->

        <button type="submit" class="jt-search__submit">
            <span class="sr-only"><?php _e( 'Search', 'jt' ); ?></span>
            <i class="jt-icon"><?php jt_icon('jt-search'); ?></i>
        </button><!-- .jt-search__submit -->

        <button type="reset" class="jt-search__reset">
            <span class="sr-only"><?php _e( 'Clear', 'jt' ); ?></span>
            <i class="jt-icon"><?php jt_icon('jt-reset'); ?></i>
        </button><!-- .jt-search__reset -->
    </div><!-- .jt-search__bundle -->
</form><!-- .jt-search -->
