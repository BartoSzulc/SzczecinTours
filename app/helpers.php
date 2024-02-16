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
        echo $output; // Use: acf_link($link, $class, $default, $echo);
    } else {
        return $output; // Use: $output = acf_link($link, $class, $default, $echo);
    }
}

function admin_log($log, $name = '_')
{
    $date = new \DateTime();
    $date->setTimezone(new \DateTimeZone('Europe/Warsaw'));
    $log_date = $date->format('Y-m-d H:i:s');

    if (is_array($log)) {
        $log = http_build_query($log, '', ', ');
    }

    $log_msg =  $log_date . ' : ' . $log;
    $folder = dirname(__FILE__) . "/../../../logs/";

    if (!file_exists($folder)) {
        mkdir($folder, 0777, true);
    }

    $log_file_data = $folder . '/log' . $name . date('d-M-Y') . '_' . date('h') . '.log';
    file_put_contents($log_file_data, $log_msg . "\n", FILE_APPEND);
    // Use: admin_log($log, $name);
}

function placehold_img($size = '150x150', $format = 'png', $text_color = '#fff', $bg_color = '#6d6d6d', $text = false)
{
    $url = 'https://via.placeholder.com/' . $size . '.' . $format . '/' . $bg_color . '/' . $text_color ;
    if ($text) {
        $text = str_replace(' ', '+', $text);
        $url .= '?text=' . $text;
    }
    return $url; // Use: $url = placehold_img($size, $format, $text_color, $bg_color, $text);
}

function cc_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

require('helpers-partials/cpt-wycieczkownik.php');
require('helpers-partials/filter_posts.php');
require('helpers-partials/page_navi.php');

add_filter('acf/fields/relationship/result/name=other_tours', 'my_custom_acf_fields_relationship_result', 10, 4);
function my_custom_acf_fields_relationship_result( $text, $post, $field, $post_id ) {
    $tour_date = get_post_meta( $post->ID, 'tour_date', true );
    if( $tour_date ) {
        try {
            $date = new DateTime($tour_date);
            $formatted_date = $date->format('d.m.Y');
            $text .= ' - ' . sprintf( '<strong style="display: inline-flex; gap: 5px; align-items:center; position: relative; top: 3px;"><svg width="15" height="15" fill="none" xmlns="http://www.w3.org/2000/svg"><defs><clipPath id="a"><path fill="#fff" fill-opacity="0" d="M0 0h15v15H0z"/></clipPath></defs><g clip-path="url(#a)" fill="#0296D8"><path d="M8.172 10.664c0 .646.523 1.172 1.172 1.172h1.375c.648 0 1.172-.526 1.172-1.172V9.287c0-.646-.524-1.172-1.172-1.172H9.344c-.649 0-1.172.526-1.172 1.172v1.377Zm1.172-1.377h1.375v1.377H9.344V9.287Z"/><path d="M11.89 6.152a.588.588 0 0 1-.585.586.588.588 0 0 1-.586-.586c0-.323.265-.586.586-.586.32 0 .586.263.586.586ZM9.344 6.152a.588.588 0 0 1-.586.586.588.588 0 0 1-.586-.586c0-.323.265-.586.586-.586.32 0 .586.263.586.586Z" fill-rule="evenodd"/><path d="M14.414 10.313c.32 0 .586-.263.586-.586V3.516a2.349 2.349 0 0 0-2.344-2.344h-.765V.586A.582.582 0 0 0 11.312 0a.59.59 0 0 0-.593.586v.586H8.055V.586A.583.583 0 0 0 7.469 0a.588.588 0 0 0-.586.586v.586H4.25V.586A.588.588 0 0 0 3.664 0a.583.583 0 0 0-.586.586v.586h-.734A2.349 2.349 0 0 0 0 3.516v9.14A2.349 2.349 0 0 0 2.344 15h10.312A2.349 2.349 0 0 0 15 12.656a.588.588 0 0 0-.586-.586.588.588 0 0 0-.586.586c0 .647-.523 1.172-1.172 1.172H2.344a1.172 1.172 0 0 1-1.172-1.172v-9.14c0-.647.523-1.172 1.172-1.172h.734v.586c0 .323.258.586.586.586.32 0 .586-.263.586-.586v-.586h2.633v.586c0 .323.265.586.586.586a.583.583 0 0 0 .586-.586v-.586h2.664v.586a.59.59 0 0 0 .594.586c.32 0 .578-.263.578-.586v-.586h.765c.649 0 1.172.525 1.172 1.172v6.21c0 .324.266.586.586.586Z"/><path d="M4.25 11.25a.588.588 0 0 1-.586.586.588.588 0 0 1-.586-.586c0-.323.266-.586.586-.586.32 0 .586.263.586.586ZM4.25 6.152a.588.588 0 0 1-.586.586.588.588 0 0 1-.586-.586c0-.323.266-.586.586-.586.32 0 .586.263.586.586ZM4.25 8.701a.588.588 0 0 1-.586.586.588.588 0 0 1-.586-.586c0-.323.266-.586.586-.586.32 0 .586.263.586.586ZM6.797 8.701a.588.588 0 0 1-.586.586.588.588 0 0 1-.586-.586c0-.323.266-.586.586-.586.32 0 .586.263.586.586ZM6.797 6.152a.588.588 0 0 1-.586.586.588.588 0 0 1-.586-.586c0-.323.266-.586.586-.586.32 0 .586.263.586.586ZM6.797 11.25a.588.588 0 0 1-.586.586.588.588 0 0 1-.586-.586c0-.323.266-.586.586-.586.32 0 .586.263.586.586Z" fill-rule="evenodd"/></g></svg> %s', $formatted_date . '</strong>' );
        } catch (Exception $e) {
            // Handle the exception if the date format is incorrect
            error_log('Error formatting date: ' . $e->getMessage());
        }
    }
    return $text;
}
add_filter('acf/fields/relationship/query/name=other_tours', 'my_custom_relationship_query', 10, 3);
function my_custom_relationship_query( $args, $field, $post_id ) {
    // Exclude the current post from the query
    if( !isset($args['post__not_in']) ) {
        $args['post__not_in'] = array(); // Initialize if not set
    }
    $args['post__not_in'][] = $post_id; // Exclude the current post

    return $args;
}

// Add a new column to the posts list table
add_filter('manage_wycieczki_posts_columns', 'add_custom_columns_for_wycieczki');
function add_custom_columns_for_wycieczki($columns) {
    $columns['tour_details'] = '<p style="display: flex; align-items:center; gap: 5px; margin: 0;"><svg width="15" height="15" fill="none" xmlns="http://www.w3.org/2000/svg"><defs><clipPath id="a"><path fill="#fff" fill-opacity="0" d="M0 0h15v15H0z"/></clipPath></defs><g clip-path="url(#a)" fill="#0296D8"><path d="M8.172 10.664c0 .646.523 1.172 1.172 1.172h1.375c.648 0 1.172-.526 1.172-1.172V9.287c0-.646-.524-1.172-1.172-1.172H9.344c-.649 0-1.172.526-1.172 1.172v1.377Zm1.172-1.377h1.375v1.377H9.344V9.287Z"/><path d="M11.89 6.152a.588.588 0 0 1-.585.586.588.588 0 0 1-.586-.586c0-.323.265-.586.586-.586.32 0 .586.263.586.586ZM9.344 6.152a.588.588 0 0 1-.586.586.588.588 0 0 1-.586-.586c0-.323.265-.586.586-.586.32 0 .586.263.586.586Z" fill-rule="evenodd"/><path d="M14.414 10.313c.32 0 .586-.263.586-.586V3.516a2.349 2.349 0 0 0-2.344-2.344h-.765V.586A.582.582 0 0 0 11.312 0a.59.59 0 0 0-.593.586v.586H8.055V.586A.583.583 0 0 0 7.469 0a.588.588 0 0 0-.586.586v.586H4.25V.586A.588.588 0 0 0 3.664 0a.583.583 0 0 0-.586.586v.586h-.734A2.349 2.349 0 0 0 0 3.516v9.14A2.349 2.349 0 0 0 2.344 15h10.312A2.349 2.349 0 0 0 15 12.656a.588.588 0 0 0-.586-.586.588.588 0 0 0-.586.586c0 .647-.523 1.172-1.172 1.172H2.344a1.172 1.172 0 0 1-1.172-1.172v-9.14c0-.647.523-1.172 1.172-1.172h.734v.586c0 .323.258.586.586.586.32 0 .586-.263.586-.586v-.586h2.633v.586c0 .323.265.586.586.586a.583.583 0 0 0 .586-.586v-.586h2.664v.586a.59.59 0 0 0 .594.586c.32 0 .578-.263.578-.586v-.586h.765c.649 0 1.172.525 1.172 1.172v6.21c0 .324.266.586.586.586Z"/><path d="M4.25 11.25a.588.588 0 0 1-.586.586.588.588 0 0 1-.586-.586c0-.323.266-.586.586-.586.32 0 .586.263.586.586ZM4.25 6.152a.588.588 0 0 1-.586.586.588.588 0 0 1-.586-.586c0-.323.266-.586.586-.586.32 0 .586.263.586.586ZM4.25 8.701a.588.588 0 0 1-.586.586.588.588 0 0 1-.586-.586c0-.323.266-.586.586-.586.32 0 .586.263.586.586ZM6.797 8.701a.588.588 0 0 1-.586.586.588.588 0 0 1-.586-.586c0-.323.266-.586.586-.586.32 0 .586.263.586.586ZM6.797 6.152a.588.588 0 0 1-.586.586.588.588 0 0 1-.586-.586c0-.323.266-.586.586-.586.32 0 .586.263.586.586ZM6.797 11.25a.588.588 0 0 1-.586.586.588.588 0 0 1-.586-.586c0-.323.266-.586.586-.586.32 0 .586.263.586.586Z" fill-rule="evenodd"/></g></svg> <strong>Data wycieczki</strong></p>';
    return $columns;
}

// Populate the new column with the tour_date and tour_time meta values
add_action('manage_wycieczki_posts_custom_column', 'custom_columns_content_for_wycieczki', 10, 2);
function custom_columns_content_for_wycieczki($column_name, $post_id) {
    if ('tour_details' === $column_name) {
        $tour_date = get_post_meta($post_id, 'tour_date', true);
        $tour_time = get_post_meta($post_id, 'tour_time', true);

        // Format the date if not empty
        if (!empty($tour_date)) {
            // Assuming the date is already in the correct format, but if you need to reformat:
            $tour_date_formatted = !empty($tour_date) ? date('d.m.Y', strtotime($tour_date)) : 'Nie dodano daty';
        } else {
            $tour_date_formatted = 'Nie dodano daty';
        }

        // Format the time if not empty and to exclude seconds
        if (!empty($tour_time)) {
            // Assuming the time is in 'H:i:s' format and you want to convert it to 'H:i'
            $timeObj = DateTime::createFromFormat('H:i:s', $tour_time);
            $tour_time_formatted = $timeObj ? $timeObj->format('H:i') : 'Nie dodano godziny';
        } else {
            $tour_time_formatted = 'Nie dodano godziny';
        }

        echo '<div class="custom-flex" style="display:flex; flex-direction:column; gap: 5px;"><span class="date" style="display:flex; align-items:center; gap: 5px;"><svg width="15" height="15" fill="none" xmlns="http://www.w3.org/2000/svg"><defs><clipPath id="a"><path fill="#fff" fill-opacity="0" d="M0 0h15v15H0z"/></clipPath></defs><g clip-path="url(#a)" fill="#0296D8"><path d="M8.172 10.664c0 .646.523 1.172 1.172 1.172h1.375c.648 0 1.172-.526 1.172-1.172V9.287c0-.646-.524-1.172-1.172-1.172H9.344c-.649 0-1.172.526-1.172 1.172v1.377Zm1.172-1.377h1.375v1.377H9.344V9.287Z"/><path d="M11.89 6.152a.588.588 0 0 1-.585.586.588.588 0 0 1-.586-.586c0-.323.265-.586.586-.586.32 0 .586.263.586.586ZM9.344 6.152a.588.588 0 0 1-.586.586.588.588 0 0 1-.586-.586c0-.323.265-.586.586-.586.32 0 .586.263.586.586Z" fill-rule="evenodd"/><path d="M14.414 10.313c.32 0 .586-.263.586-.586V3.516a2.349 2.349 0 0 0-2.344-2.344h-.765V.586A.582.582 0 0 0 11.312 0a.59.59 0 0 0-.593.586v.586H8.055V.586A.583.583 0 0 0 7.469 0a.588.588 0 0 0-.586.586v.586H4.25V.586A.588.588 0 0 0 3.664 0a.583.583 0 0 0-.586.586v.586h-.734A2.349 2.349 0 0 0 0 3.516v9.14A2.349 2.349 0 0 0 2.344 15h10.312A2.349 2.349 0 0 0 15 12.656a.588.588 0 0 0-.586-.586.588.588 0 0 0-.586.586c0 .647-.523 1.172-1.172 1.172H2.344a1.172 1.172 0 0 1-1.172-1.172v-9.14c0-.647.523-1.172 1.172-1.172h.734v.586c0 .323.258.586.586.586.32 0 .586-.263.586-.586v-.586h2.633v.586c0 .323.265.586.586.586a.583.583 0 0 0 .586-.586v-.586h2.664v.586a.59.59 0 0 0 .594.586c.32 0 .578-.263.578-.586v-.586h.765c.649 0 1.172.525 1.172 1.172v6.21c0 .324.266.586.586.586Z"/><path d="M4.25 11.25a.588.588 0 0 1-.586.586.588.588 0 0 1-.586-.586c0-.323.266-.586.586-.586.32 0 .586.263.586.586ZM4.25 6.152a.588.588 0 0 1-.586.586.588.588 0 0 1-.586-.586c0-.323.266-.586.586-.586.32 0 .586.263.586.586ZM4.25 8.701a.588.588 0 0 1-.586.586.588.588 0 0 1-.586-.586c0-.323.266-.586.586-.586.32 0 .586.263.586.586ZM6.797 8.701a.588.588 0 0 1-.586.586.588.588 0 0 1-.586-.586c0-.323.266-.586.586-.586.32 0 .586.263.586.586ZM6.797 6.152a.588.588 0 0 1-.586.586.588.588 0 0 1-.586-.586c0-.323.266-.586.586-.586.32 0 .586.263.586.586ZM6.797 11.25a.588.588 0 0 1-.586.586.588.588 0 0 1-.586-.586c0-.323.266-.586.586-.586.32 0 .586.263.586.586Z" fill-rule="evenodd"/></g></svg> ' . esc_html($tour_date_formatted) . '</span><span class="time" style="display:flex; align-items:center; gap: 5px;"><svg width="15" height="15" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8.18 7.217V3.41a.684.684 0 0 0-.688-.682.666.666 0 0 0-.476.2.665.665 0 0 0-.204.482V7.5c0 .18.07.354.204.482l2.039 2.045a.7.7 0 0 0 .484.192.678.678 0 0 0 .672-.676.682.682 0 0 0-.188-.48L8.18 7.217Z" fill="#0296D8"/><path d="M7.5 0A7.514 7.514 0 0 0 .57 4.63a7.482 7.482 0 0 0 1.625 8.173 7.48 7.48 0 0 0 3.844 2.053c1.453.29 2.961.14 4.328-.427a7.464 7.464 0 0 0 3.367-2.762A7.47 7.47 0 0 0 15 7.5a7.503 7.503 0 0 0-2.203-5.3A7.482 7.482 0 0 0 7.5 0Zm0 13.636a6.13 6.13 0 0 1-3.406-1.034 6.119 6.119 0 0 1-2.61-6.3 6.108 6.108 0 0 1 1.68-3.14 6.086 6.086 0 0 1 3.14-1.68 6.147 6.147 0 0 1 3.548.349A6.137 6.137 0 0 1 7.5 13.636Z" fill="#0296D8"/></svg>' . esc_html($tour_time_formatted) . '</span>';
        echo '</div>';
    }
}




// pll_register_string('motyw', 'Wycieczka w polskiej wersji językowej');
pll_register_string('motyw', 'Wejście:');
pll_register_string('motyw', 'Czas trwania:');
pll_register_string('motyw', 'Szczegółowe informacje');
pll_register_string('motyw', 'Więcej informacji');
pll_register_string('motyw', 'Wróć do listy');
pll_register_string('motyw', 'Ta sama wycieczka w innym terminie');
pll_register_string('motyw', 'Ta sama wycieczka w innym języku');
pll_register_string('motyw', 'Wybór kategorii');
pll_register_string('motyw', 'Wszystkie');
pll_register_string('motyw', 'Zobacz szczegóły');
pll_register_string('motyw', 'Zobacz więcej');
pll_register_string('motyw', 'Nie znaleziono wycieczek');
pll_register_string('motyw', 'Dzisiaj');
pll_register_string('motyw', 'Jutro');
pll_register_string('motyw', 'Wybierz datę');
pll_register_string('motyw', '- język wycieczki -');
pll_register_string('motyw', '- sortuj wg -');
pll_register_string('motyw', 'Data wydarzenia');
pll_register_string('motyw', 'Alfabetycznie');
pll_register_string('motyw', 'Strona nie istnieje');
pll_register_string('motyw', 'Powrót');
pll_register_string('motyw', 'Strona internetowa powstała w ramach projektu Szczecin Tours Planner dofinansowanego ze środków UE.');


// pll_register_string('Brikol', 'zł');
// pll_register_string('Brikol', 'Cena:');
// pll_register_string('Brikol', 'Zapytaj o produkt');
// pll_register_string('Brikol', 'Zobacz więcej');
// pll_register_string('Brikol', 'Wszelkie prawa zastrzeżone © 2024');
// pll_register_string('Brikol', 'Realizacja:');
// pll_register_string('Brikol', 'Zapytaj o produkt / złóż zamówienie:');