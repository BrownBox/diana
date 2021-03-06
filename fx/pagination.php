<?php
// Borrowed from https://gist.github.com/veelen/408f09528d163008a1ef

/**
 *
 * @param int $p The number of page items to display before and after the current page
 * @param bool $return Whether to return or echo the page
 * @return null|string
 */
function foundation_pagination($p = 2, $return = false) {
    $output = '';
    if (is_singular()) {
        return null;
    }
    global $wp_query, $paged;
    $max_page = $wp_query->max_num_pages;
    if ($max_page == 1) {
        return null;
    }
    if (empty($paged)) {
        $paged = 1;
    }
    if ($paged > 1) {
        $output .= p_link($paged - 1, 'previous');
    }
    if ($paged > $p + 1) {
        $output .= p_link(1, 'first');
    }
    if ($paged > $p + 2) {
        $output .= '<li class="unavailable" aria-disabled="true"><a href="#">&hellip;</a></li>';
    }
    for($i = $paged - $p; $i <= $paged + $p; $i++) { // Middle pages
        if ($i == 1) {
            $rel = 'rel="first"';
        } elseif ($i == $max_page) {
            $rel = 'rel="last"';
        } else {
            $rel = '';
        }
        if ($i > 0 && $i <= $max_page) {
            $i == $paged ? $output .= "<li class='current' {$rel}><a href='#'>{$i}</a></li> " : $output .= p_link($i);
        }
    }
    if ($paged < $max_page - $p - 1) {
        $output .= '<li class="unavailable" aria-disabled="true"><a href="#">&hellip;</a></li>';
    }
    if ($paged < $max_page - $p) {
        $output .= p_link($max_page, 'last');
    }
    if ($paged < $max_page) {
        $output .= p_link($paged + 1, 'next');
    }
    if (!empty($output)) {
        $output = '<ul class="pagination" role="navigation" aria-label="Pagination">'.$output.'</ul>';
    }
    if ($return) {
        return $output;
    } else {
        echo $output;
    }
}

/**
 *
 * @param int $i
 * @param string $title
 * @return string
 */
function p_link($i, $title = '') {
    global $wp_query;
    $max_page = $wp_query->max_num_pages;
    if ($i == 1 || $title == 'first') {
        $rel = 'rel="first"';
    } elseif ($title == 'last' || $i == $max_page) {
        $rel = 'rel="last"';
    } else {
        $rel = '';
    }
    $linktext = $i;
    switch ($title) {
        case 'first':
            $readabletitle = _x('First', 'pagination first page', 'theme_textdomain');
            break;
        case 'last':
            $readabletitle = _x('Last', 'pagination last page', 'theme_textdomain');
            break;
        case 'previous':
            $readabletitle = $linktext = _x('&laquo; Previous', 'pagination previous page', 'theme_textdomain');
            $rel = 'rel="prev"';
            break;
        case 'next':
            $readabletitle = $linktext = _x('Next &raquo;', 'pagination next page', 'theme_textdomain');
            $rel = 'rel="next"';
            break;
        default:
            $readabletitle = sprintf(_x("Page %d", 'pagination page number', 'theme_textdomain'), $i);
    }
    return "<li><a href='" . esc_html(get_pagenum_link($i)) . "' {$rel} title='{$readabletitle}'>{$linktext}</a></li> ";
}
