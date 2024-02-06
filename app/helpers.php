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