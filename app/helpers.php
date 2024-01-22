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

function register_custom_post_type_realizacje() {  
    $labels = array(
        'name' => 'Realizacje',
        'singular_name' => 'Realizacja',
        'add_new' => 'Dodaj nową realizacje',
        'add_new_item' => 'Dodaj nową realizacje',
        'edit_item' => 'Edytuj realizacje',
        'new_item' => 'Nowa realizacja',
        'view_item' => 'Zobacz realizacje',
        'search_items' => 'Szukaj realizacji',
        'not_found' => 'Nie znaleziono realizacji',
        'not_found_in_trash' => 'Nie znaleziono realizacji w koszu'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_icon' => 'dashicons-format-gallery',

    );

    register_post_type('realizacje', $args);
}
add_action('init', __NAMESPACE__ . '\\register_custom_post_type_realizacje');

function register_custom_post_type_produkty() {  
    $labels = array(
        'name' => 'Produkty',
        'singular_name' => 'Produkt',
        'add_new' => 'Dodaj nowy produkt',
        'add_new_item' => 'Dodaj nowy produkt',
        'edit_item' => 'Edytuj produkt',
        'new_item' => 'Nowy produkt',
        'view_item' => 'Zobacz produkt',
        'search_items' => 'Szukaj produktów',
        'not_found' => 'Nie znaleziono produktów',
        'not_found_in_trash' => 'Nie znaleziono produktów w koszu'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_icon' => 'dashicons-products',
    );

    register_post_type('produkty', $args);

    // Dodaj taksonomię dla niestandardowego typu wpisu produkty
    $taxonomy_labels = array(
        'name' => 'Kategorie produktów',
        'singular_name' => 'Kategoria produktu',
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
        'rewrite' => array('slug' => 'oferta'),
    );

    register_taxonomy('kategoria_produktu', 'produkty', $taxonomy_args);
}
add_action('init', 'register_custom_post_type_produkty');


function cc_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
  }
add_filter('upload_mimes', 'cc_mime_types');

pll_register_string('Brikol', 'Sprawdź cenę i zamów');
pll_register_string('Brikol', 'zł');
pll_register_string('Brikol', 'Cena:');
pll_register_string('Brikol', 'Zapytaj o produkt');
pll_register_string('Brikol', 'Zobacz więcej');
pll_register_string('Brikol', 'Wszelkie prawa zastrzeżone © 2024');
pll_register_string('Brikol', 'Realizacja:');
pll_register_string('Brikol', 'Strona nie istnieje');
pll_register_string('Brikol', 'Powrót');
pll_register_string('Brikol', 'Zapytaj o produkt / złóż zamówienie:');