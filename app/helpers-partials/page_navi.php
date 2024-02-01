<?php 
function page_navi($query, $posts_per_page = 8, $before = '', $after = '') {
    $request        = $query->request;
    $paged          = intval($query->query_vars['paged']);
    $numposts       = $query->found_posts;
    $max_page       = ceil($numposts / $posts_per_page); // Calculate the total number of pages based on fixed posts_per_page

    if ($numposts <= $posts_per_page) {
        return;
    }
    if (empty($paged) || $paged == 0) {
        $paged = 1;
    }
    $pages_to_show         = 4;
    $pages_to_show_minus_1 = $pages_to_show - 1;
    $half_page_start       = floor($pages_to_show_minus_1 / 2);
    $half_page_end         = ceil($pages_to_show_minus_1 / 2);
    $start_page            = $paged - $half_page_start;
    if ($start_page <= 0) {
        $start_page = 1;
    }
    $end_page = $paged + $half_page_end;
    if (($end_page - $start_page) != $pages_to_show_minus_1) {
        $end_page = $start_page + $pages_to_show_minus_1;
    }
    if ($end_page > $max_page) {
        $start_page = $max_page - $pages_to_show_minus_1;
        $end_page   = $max_page;
    }
    if ($start_page <= 0) {
        $start_page = 1;
    }

    echo $before . '<nav class="w-full col-span-full mt-10 posts-navigation" aria-label="RealizationNavigation"><ul class="pagination">' . "";

    if ($paged > 1) {
        $prev_page = $paged - 1;
        if ($prev_page > 0) {
            echo '<li class="page-item prev"><a data-page="' . $prev_page . '" class="page-link">';
            ?>
            <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 60 60" fill="none">
            <rect y="-0.00488281" width="60" height="60" rx="8" fill="#F7F7F7"/>
            <rect x="0.5" y="0.495117" width="59" height="59" rx="7.5" stroke="#0F1425" stroke-opacity="0.2"/>
            <path d="M33 23.9951L27 29.9951L33 35.9951" stroke="#0296D8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <?php
            echo '<span class="sr-only">Previous</span></a></li>';
        }
    }

    for ($i = $start_page; $i <= $end_page; $i++) {
        if ($i == $paged) {
            echo '<li class="active page-item"><a class="page-link">' . $i . '</a></li>';
        } else {
            echo '<li class="page-item"><a data-page="' . $i . '" class="page-link">' . $i . '</a></li>';
        }
    }

  
    if ($paged < $max_page) {
        $next_page = $paged + 1;
        echo '<li class="page-item next"><a data-page="' . $next_page . '" class="page-link">';
        ?>
        <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 60 60" fill="none">
        <rect x="60" y="60" width="60" height="60" rx="8" transform="rotate(-180 60 60)" fill="#F7F7F7"/>
        <rect x="59.5" y="59.5" width="59" height="59" rx="7.5" transform="rotate(-180 59.5 59.5)" stroke="#0F1425" stroke-opacity="0.2"/>
        <path d="M27 36L33 30L27 24" stroke="#0296D8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <?php
        echo '<span class="sr-only">Next</span></a></li>';
    }
    echo '</ul></nav>' . $after . "";
}
 ?>