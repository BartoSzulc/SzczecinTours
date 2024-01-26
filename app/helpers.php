<?php

/**
 * Theme helpers.
 */

function removeSpaces($text) {
    return str_replace(' ', '', $text);
}

function acf_link($link, $class = '', $default = 'Learn More', $echo = true)
{
    if (empty($link) && !is_array($link)) {
        return false;
    }

    $link_title = !empty($link['title']) ? $link['title'] : $default;

    $output = "<a ";
    $output .= !empty($class) ? "class='{$class}'" : null;
    $output .= "href='{$link['url']}'";
    $output .= !empty($link['target']) ? "target='_blank'" : null;
    $output .= ">{$link_title}</a>";

    if ($echo) {
        echo $output;
    } else {
        return $output;
    }
}

function admin_log($log, $name = '_')
{
    $date = new \DateTime();
    $date->setTimezone(new \DateTimeZone('Europe/Warsaw'));
    $log_time = $date->format('Y-m-d H:i:s');

    if (is_array($log)) {
        $log = http_build_query($log, '', ', ');
    }

    $log_msg =  $log_time . ' : ' . $log;
    $folder = dirname(__FILE__) . "/../../../logs/";

    if (!file_exists($folder)) {
        mkdir($folder, 0777, true);
    }

    $log_file_data = $folder . '/log' . $name . date('d-M-Y') . '_' . date('h') . '.log';
    file_put_contents($log_file_data, $log_msg . "\n", FILE_APPEND);
}

function placehold_img($size = '150x150', $format = 'png', $text_color = '#fff', $bg_color = '#6d6d6d', $text = false)
{
    $url = 'https://via.placeholder.com/' . $size . '.' . $format . '/' . $bg_color . '/' . $text_color ;
    if ($text) {
        $text = str_replace(' ', '+', $text);
        $url .= '?text=' . $text;
    }
    return $url;
}

function register_custom_post_type_wycieczki() {  
    $labels = array(
        'name' => 'Wycieczkownik',
        'singular_name' => 'Wycieczka',
        'add_new' => 'Dodaj nową wycieczkę',
        'add_new_item' => 'Dodaj nową wycieczkę',
        'edit_item' => 'Edytuj wycieczkę',
        'new_item' => 'Nowa wycieczka',
        'view_item' => 'Zobacz wycieczkę',
        'search_items' => 'Szukaj wycieczek',
        'not_found' => 'Nie znaleziono wycieczek',
        'not_found_in_trash' => 'Nie znaleziono wycieczek w koszu'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_icon' => 'dashicons-location-alt',
    );

    register_post_type('wycieczki', $args);

    // Dodaj taksonomię dla niestandardowego typu wpisu wycieczki
    $taxonomy_labels = array(
        'name' => 'Kategorie wycieczek',
        'singular_name' => 'Kategoria wycieczki',
        'search_items' => 'Szukaj kategorii',
        'all_items' => 'Wszystkie kategorie',
        'parent_item' => 'Kategoria nadrzędna',
        'parent_item_colon' => 'Kategoria nadrzędna:',
        'edit_item' => 'Edytuj kategorię',
        'update_item' => 'Zaktualizuj kategorię',
        'add_new_item' => 'Dodaj nową kategorię',
        'new_item_name' => 'Nowa nazwa kategorii',
        'menu_name' => 'Kategorie',
    );

    $taxonomy_args = array(
        'hierarchical' => true,
        'labels' => $taxonomy_labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
    );

    register_taxonomy('kategoria_wycieczki', 'wycieczki', $taxonomy_args);

    $taxonomy_labels_miejsce = array(
        'name' => 'Miejsca wycieczek',
        'singular_name' => 'Miejsce wycieczki',
        'search_items' => 'Szukaj miejsc',
        'all_items' => 'Wszystkie miejsca',
        'parent_item' => 'Miejsce nadrzędne',
        'parent_item_colon' => 'Miejsce nadrzędne:',
        'edit_item' => 'Edytuj miejsce',
        'update_item' => 'Zaktualizuj miejsce',
        'add_new_item' => 'Dodaj nowe miejsce',
        'new_item_name' => 'Nowa nazwa miejsca',
        'menu_name' => 'Miejsca',
    );

    $taxonomy_args_miejsce = array(
        'hierarchical' => true,
        'labels' => $taxonomy_labels_miejsce,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
    );

    register_taxonomy('miejsce_wycieczki', 'wycieczki', $taxonomy_args_miejsce);
}
add_action('init', 'register_custom_post_type_wycieczki');


function cc_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
  }
add_filter('upload_mimes', 'cc_mime_types');


function filter_posts() {
    $today = date('Ymd'); // Get today's date
    $args = array(
        'post_type' => 'wycieczki',
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
        $selected_date = DateTime::createFromFormat('d.m.Y', $_POST['selected_date'])->format('Y-m-d');
        $args['meta_query'] = array(
            array(
                'key' => 'tour_date',
                'value' => $selected_date,
                'compare' => '=',
                'type' => 'DATE'
            )
        );
    }

    $args['tax_query'] = array();

    if (!empty($_POST['kategoria_wycieczki'])) {
        $args['tax_query'][] = array(
            'taxonomy' => 'kategoria_wycieczki',
            'field'    => 'slug',
            'terms'    => $_POST['kategoria_wycieczki'],
            'operator' => 'AND',
        );
    }

    if (!empty($_POST['miejsce_wycieczki'])) {
        $args['tax_query'][] = array(
            'taxonomy' => 'miejsce_wycieczki',
            'field'    => 'slug',
            'terms'    => $_POST['miejsce_wycieczki'],
            'operator' => 'AND',
        );
    }

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            echo view('partials/post/content')->render();
        }
    } else {
        echo view('partials/post/not-found')->render();
    }

    wp_die();
}
add_action('wp_ajax_filter_posts', __NAMESPACE__ . '\\filter_posts');
add_action('wp_ajax_nopriv_filter_posts', __NAMESPACE__ . '\\filter_posts');

// pll_register_string('Brikol', 'Sprawdź cenę i zamów');
// pll_register_string('Brikol', 'zł');
// pll_register_string('Brikol', 'Cena:');
// pll_register_string('Brikol', 'Zapytaj o produkt');
// pll_register_string('Brikol', 'Zobacz więcej');
// pll_register_string('Brikol', 'Wszelkie prawa zastrzeżone © 2024');
// pll_register_string('Brikol', 'Realizacja:');
// pll_register_string('Brikol', 'Strona nie istnieje');
// pll_register_string('Brikol', 'Powrót');
// pll_register_string('Brikol', 'Zapytaj o produkt / złóż zamówienie:');