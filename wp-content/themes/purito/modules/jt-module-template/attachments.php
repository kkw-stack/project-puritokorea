<?php if ( count( $jt_download ) > 0 ) : ?>

    <div class="jt-download-files">
        <b><span class="jt-typo--09"><?php _e( '첨부파일', 'jt' ); ?></span></b>

        <?php foreach ( $jt_download as $idx => $attachment_id ) : $file_info = $this->jt_download_get_info( $attachment_id ); ?>

            <?php if ( $idx > 0 ) : ?>
                <i class="jt-download-files__comma jt-typo--10">,</i>
            <?php endif; ?>

            <a class="jt-typo--10" href="<?php echo $file_info->download_url; ?>" download><?php echo $file_info->file_name; ?></a>

        <?php endforeach; unset( $idx, $row, $file_info ); ?>
    </div><!-- .jt-download-files -->

<?php endif; ?>
