<?php 
function filter_posts() {
 
    $today = current_time('Y-m-d H:i:s'); // Get today's datetime in MySQL format
    $paged = isset($_POST['paged']) && is_numeric($_POST['paged']) ? $_POST['paged'] : 1;
    
    $args = array(
        'post_type' => 'wycieczki',
        'paged' => $paged,
        'posts_per_page' => 12,
        'lang' => array('pl', 'en', 'de'),
        'meta_key' => 'tour_datetime', // Changed to tour_datetime
        'orderby' => 'meta_value', // Changed to meta_value for datetime sorting
        'order' => 'ASC',
        'meta_query' => array(
            array(
                'key' => 'tour_datetime', // Changed to tour_datetime
                'value' => $today,
                'compare' => '>=',
                'type' => 'DATETIME' // Changed type to DATETIME
            )
        )
    );


    if (!empty($_POST['selected_date'])) {
        $dateObject = DateTime::createFromFormat('d.m.Y', $_POST['selected_date']);
        if ($dateObject !== false) {
            $startOfDay = $dateObject->format('Y-m-d 00:00:00');
            $endOfDay = clone $dateObject;
            $endOfDay->modify('+1 day');
            $startOfNextDay = $endOfDay->format('Y-m-d 00:00:00');
            $args['meta_query'][] = array(
                'relation' => 'AND',
                array(
                    'key' => 'tour_datetime',
                    'value' => $startOfDay,
                    'compare' => '>=',
                    'type' => 'DATETIME'
                ),
                array(
                    'key' => 'tour_datetime',
                    'value' => $startOfNextDay,
                    'compare' => '<',
                    'type' => 'DATETIME'
                )
            );
        }
    }
    
    
    if (!empty($_POST['kategoria_wycieczki'])) {
  
        $kategoria_wycieczki_array = array_map('intval', explode(',', $_POST['kategoria_wycieczki'][0]));
        //echo '<pre>' . var_export($kategoria_wycieczki_array, true) . '</pre>';

        $args['tax_query'][] = array(
            'taxonomy' => 'kategoria_wycieczki',
            'field'    => 'term_id',
            'terms'    => $kategoria_wycieczki_array, 
            'operator' => 'IN',
        );
       //echo '<pre>' . var_export($args, true) . '</pre>';
    }

    if (!empty($_POST['miejsce_wycieczki'])) {
        $args['tax_query'][] = array(
            'taxonomy' => 'miejsce_wycieczki',
            'field'    => 'slug',
            'terms'    => $_POST['miejsce_wycieczki'],
            'operator' => 'in',
        );
    }

    if (!empty($_POST['language'])) {
        $args['lang'] = $_POST['language'];
    }
    
    if (!empty($_POST['sorting'])) {
        if ($_POST['sorting'] === 'DATE') {
            $args['meta_key'] = 'tour_datetime';
            $args['orderby'] = 'meta_value';
            $args['order'] = 'DESC';
        } else if ($_POST['sorting'] === 'ASC') {
            $args['orderby'] = 'title';
            $args['order'] = 'ASC';
        } 
    }
    
    $query = new WP_Query($args);

    // echo '<pre>' . var_export($query, true) . '</pre>';
    // echo '<pre>' . var_export($args, true) . '</pre>';
    // echo '<pre>' . var_export($kategoria_wycieczki_array, true) . '</pre>';

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            echo view('partials/post/content')->render();
        }
        if ($query->max_num_pages > 1):
            page_navi($query, 12);
        endif;
    } else {
        echo view('partials/post/not-found')->render();
    }

    wp_die();
}

add_action('wp_ajax_filter_posts', __NAMESPACE__ . '\\filter_posts');
add_action('wp_ajax_nopriv_filter_posts', __NAMESPACE__ . '\\filter_posts');
