<?php
/*
 * Name       : PAGINATION
 * File       : /functions/pagination.php
 * Author     : STUDIO-JT
 * Guideline  : JTstyle.1.1
 * Guideline  : https://codex.studio-jt.co.kr/dev/?p=2109
 *
 * SUMMARY:
 * 1) PAGINATION
 * 2) CUSTOM PAGINATION MADE IN KOREA
 */



/* **************************************** *
 * PAGINATION
 * **************************************** */
function jt_pagination( $loop, $echo = true, $page_cnt = 5 ) {

    $current_url  = str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) );
    $total_page   = $loop->max_num_pages ?: intVal( $loop );
    $current_page = max( 1, get_query_var( 'paged' ) );

    if ( wp_is_mobile() ) {

        $page_cnt = 3;

    }

    if ( 1 ) { // + 1

        $separater    = floor( $page_cnt / 2 );
		if ( $current_page == 1 ) { $separater += 1; } // 2019-08-13 JJW page = 1 이고, 페이지가 4까지만 있을때 5가 나오는 문제
        $end_page   = ( $current_page + $separater < $total_page ? ( $current_page + $separater > $page_cnt ? $current_page + $separater : $page_cnt ) : $total_page ) + 1;
        $start_page = $end_page - $page_cnt > 0 ? $end_page - $page_cnt : 1;
        $paging     = '';

        if ( $current_page > 1 ) {

            $paging .= '<a data-barba-prevent class="jt-pagination__numbers jt-pagination--first" href="' . str_replace( '%#%', 1, $current_url ) . '"><span class="sr-only">첫 페이지</span><i class="jt-icon">' . jt_get_icon('jt-first') . '</i></a>' . "\n";
            $paging .= '<a data-barba-prevent class="jt-pagination__numbers jt-pagination--prev" href="' . str_replace( '%#%', ( $current_page - 1 > 1 ? $current_page - 1 : 1 ), $current_url ) . '"><span class="sr-only">이전 페이지</span><i class="jt-icon">' . jt_get_icon('jt-prev') . '</i></a>' . "\n";

        }

        for ( $i = $start_page; $i < $end_page; $i++ ) {

            if ($i == $current_page) {

                $paging .= '<span class="jt-pagination__numbers jt-pagination--current">' . $i . '</span>' . "\n";

            } else {

                $paging .= '<a data-barba-prevent class="jt-pagination__numbers" href="' . str_replace( '%#%', $i, $current_url ) . '">' . $i . '</a>' . "\n";

            }

        }

        if ( $current_page < $total_page ) {

            $paging .= '<a data-barba-prevent class="jt-pagination__numbers jt-pagination--next" href="' . str_replace( '%#%', ( $current_page + 1 < $total_page ? $current_page + 1 : $total_page ), $current_url ) . '"><span class="sr-only">다음 페이지</span><i class="jt-icon">' . jt_get_icon('jt-next') . '</i></a>' . "\n";
            $paging .= '<a data-barba-prevent class="jt-pagination__numbers jt-pagination--last" href="' . str_replace( '%#%', $total_page, $current_url ) . '"><span class="sr-only">마지막 페이지</span><i class="jt-icon">' . jt_get_icon('jt-last') . '</i></a>' . "\n";

        }

    } else { // + $page_cnt

        $start_page   = floor( ( $current_page - 1 ) / $page_cnt ) * $page_cnt + 1;
        $end_page     = $start_page + $page_cnt < $total_page ? $start_page + $page_cnt : $total_page + 1;

        $first_pager  = 1;
        $prev_pager   = ( ( $start_page - 1 ) / $page_cnt ) * $page_cnt > 1 ? ( ( $start_page - 1 ) / $page_cnt ) * $page_cnt : 1;
        $next_pager   = ( $end_page /$page_cnt ) * $page_cnt < $total_page ? ( $end_page /$page_cnt ) * $page_cnt : $total_page;
        $last_pager   = $total_page;

        $paging .= '<a data-barba-prevent class="jt-pagination__numbers jt-pagination--first" href="' . str_replace( '%#%', $first_pager, $current_url ) . '"><span class="sr-only">첫 페이지</span><i class="jt-icon">' . jt_get_icon('jt-first') . '</i></a>' . "\n";
        $paging .= '<a data-barba-prevent class="jt-pagination__numbers jt-pagination--prev" href="' . str_replace( '%#%', $prev_pager, $current_url ) . '"><span class="sr-only">이전 페이지</span><i class="jt-icon">' . jt_get_icon('jt-prev') . '</i></a>' . "\n";

        for ( $i = $start_page; $i < $end_page; $i++ ) {

            if ($i == $current_page) {

                $paging .= '<span class="jt-pagination__numbers jt-pagination--current">' . $i . '</span>' . "\n";

            } else {

                $paging .= '<a data-barba-prevent class="jt-pagination__numbers" href="' . str_replace( '%#%', $i, $current_url ) . '">' . $i . '</a>' . "\n";

            }

        }

        $paging .= '<a data-barba-prevent class="jt-pagination__numbers jt-pagination--next" href="' . str_replace( '%#%', $next_pager, $current_url ) . '"><span class="sr-only">다음 페이지</span><i class="jt-icon">' . jt_get_icon('jt-next') . '</i></a>' . "\n";
        $paging .= '<a data-barba-prevent class="jt-pagination__numbers jt-pagination--last" href="' . str_replace( '%#%', $last_pager, $current_url ) . '"><span class="sr-only">마지막 페이지</span><i class="jt-icon">' . jt_get_icon('jt-last') . '</i></a>' . "\n";

    }

    $paging = '<div class="jt-pagination">' . $paging . '</div>';

    if ( $echo ) {

        echo $paging;

    } else {

        return $paging;

    }

}



/* **************************************** *
 * CUSTOM PAGINATION MADE IN KOREA
 * source JJW(studio-JT) implant in wp by SPIDOCHE (studio-JT)
 * **************************************** */
function jt_korean_paginate($strFile, $szBlock=10, $whlPgCount, $reqPage, $strTrans="", $return=0){

    $hfSzBlock = intVal( $szBlock / 2 );

    $sPage;
    $ePage;
    $iCount;
    $value;

    if ( $reqPage - ( $hfSzBlock + 1 ) > 0 && $reqPage + $hfSzBlock <= $whlPgCount ) {
        $sPage = $reqPage - $hfSzBlock;
        $ePage = $reqPage + ( $hfSzBlock - 1 );
    } else {
        $sPage = ( $reqPage - ( $hfSzBlock + 1 ) ) < 1 ? 1 : $whlPgCount - ( $szBlock - 1 );
        $ePage = ( $reqPage - ( $hfSzBlock + 1 ) ) < 1 ? ( $szBlock <= $whlPgCount ? $szBlock : $whlPgCount ) : $whlPgCount;
    }

    if ( $sPage < 1 ) $sPage = 1; // 마이너스 페이지가 나오는것 예방.

    if ( $reqPage > 1 ) {
        $value .= "<a data-barba-prevent class='jt-pagination__numbers jt-pagination--first' href = '".$strFile."1".$strTrans."'> &lt&lt </a>\n";
        $value .= "<a data-barba-prevent class='jt-pagination__numbers jt-pagination--prev' href = '$strFile".(string)($reqPage - 10 > 0 ? $reqPage - 10 : 1)."$strTrans'> &lt; </a>\n";
    } else {
        $value .= " \n";
        $value .= " \n";
    }

    for($iCount = $sPage; $iCount <= $ePage; $iCount++){
        if ($reqPage == $iCount) $value .= "<span class='jt-pagination__numbers jt-pagination--current'>$iCount</span>\n";
        else $value .= "<a data-barba-prevent class='jt-pagination__numbers' href = '$strFile$iCount$strTrans'>$iCount</a>\n";
    }

    if($reqPage < $whlPgCount){
        $value .= "<a data-barba-prevent class='jt-pagination__numbers jt-pagination--next' href = '$strFile".(string)($reqPage + 10 < $whlPgCount ? ($reqPage + 10) : $whlPgCount )."$strTrans'>&gt </a>\n";
        $value .= "<a data-barba-prevent class='jt-pagination__numbers jt-pagination--last' href = '$strFile$whlPgCount$strTrans'> &gt&gt </a>\n";
    }else{
        $value .= " \n";
        $value .= " \n";
    }

    if($return){
        return($value);
    }else{
        echo($value);
    }	// if()
}
