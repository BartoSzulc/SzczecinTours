<?php 
function filter_posts() {
 
    $today = date('Ymd'); // Get today's date
    $paged = isset($_POST['paged']) && is_numeric($_POST['paged']) ? $_POST['paged'] : 1;
    
    $args = array(
        'post_type' => 'wycieczki',
        'paged' => $paged,
        'posts_per_page' => 10,
        'lang' => array('pl', 'en', 'de'),
        'meta_key' => 'tour_date',
        'orderby' => 'meta_value_num',
        'order' => 'ASC',
        'meta_query' => array(
            array(
                'key' => 'tour_date',
                'value' => $today,
                'compare' => '>=',
                'type' => 'DATE'
            )
        )
    );

    if (!empty($_POST['selected_date'])) {
    
        $dateObject = DateTime::createFromFormat('d.m.Y', $_POST['selected_date']);
        if ($dateObject !== false) {
            $selected_date = $dateObject->format('Y-m-d');
            $args['meta_query'][] = array(
                'relation' => 'AND',
                array(
                    'key' => 'tour_date',
                    'value' => $selected_date,
                    'compare' => '=',
                    'type' => 'DATE'
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
            $args['meta_key'] = 'tour_date';
            $args['orderby'] = 'meta_value';
            $args['order'] = 'DESC';
        } else if ($_POST['sorting'] === 'ASC') {
            $args['orderby'] = 'title';
            $args['order'] = 'ASC';
        } 
    }
    
   

    $query = new WP_Query($args);

    // echo '<pre>' . var_export($query, true) . '</pre>';

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            echo view('partials/post/content')->render();
        }
        if ($query->max_num_pages > 1):
            page_navi($query, 10);
        endif;
    } else {
        echo view('partials/post/not-found')->render();
    }

    wp_die();
}

add_action('wp_ajax_filter_posts', __NAMESPACE__ . '\\filter_posts');
add_action('wp_ajax_nopriv_filter_posts', __NAMESPACE__ . '\\filter_posts');
