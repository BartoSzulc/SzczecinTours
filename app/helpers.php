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

// add date field to relationship field
add_filter('acf/fields/relationship/result/name=other_tours', 'my_custom_acf_fields_relationship_result', 10, 4);
function my_custom_acf_fields_relationship_result( $text, $post, $field, $post_id ) {
    $tour_date = get_post_meta( $post->ID, 'tour_date', true );
    if( $tour_date ) {
        try {
            $date = new DateTime($tour_date);
            $formatted_date = $date->format('d.m.Y');
            $text .= ' - ' . sprintf( '<strong style="display: inline-flex; gap: 5px; align-items:center; position: relative; top: 3px;"><svg width="15" height="15" fill="none" xmlns="http://www.w3.org/2000/svg"><defs><clipPath><path fill="#fff" fill-opacity="0" d="M0 0h15v15H0z"/></clipPath></defs><g clip-path="url(#a)" fill="#0296D8"><path d="M8.172 10.664c0 .646.523 1.172 1.172 1.172h1.375c.648 0 1.172-.526 1.172-1.172V9.287c0-.646-.524-1.172-1.172-1.172H9.344c-.649 0-1.172.526-1.172 1.172v1.377Zm1.172-1.377h1.375v1.377H9.344V9.287Z"/><path d="M11.89 6.152a.588.588 0 0 1-.585.586.588.588 0 0 1-.586-.586c0-.323.265-.586.586-.586.32 0 .586.263.586.586ZM9.344 6.152a.588.588 0 0 1-.586.586.588.588 0 0 1-.586-.586c0-.323.265-.586.586-.586.32 0 .586.263.586.586Z" fill-rule="evenodd"/><path d="M14.414 10.313c.32 0 .586-.263.586-.586V3.516a2.349 2.349 0 0 0-2.344-2.344h-.765V.586A.582.582 0 0 0 11.312 0a.59.59 0 0 0-.593.586v.586H8.055V.586A.583.583 0 0 0 7.469 0a.588.588 0 0 0-.586.586v.586H4.25V.586A.588.588 0 0 0 3.664 0a.583.583 0 0 0-.586.586v.586h-.734A2.349 2.349 0 0 0 0 3.516v9.14A2.349 2.349 0 0 0 2.344 15h10.312A2.349 2.349 0 0 0 15 12.656a.588.588 0 0 0-.586-.586.588.588 0 0 0-.586.586c0 .647-.523 1.172-1.172 1.172H2.344a1.172 1.172 0 0 1-1.172-1.172v-9.14c0-.647.523-1.172 1.172-1.172h.734v.586c0 .323.258.586.586.586.32 0 .586-.263.586-.586v-.586h2.633v.586c0 .323.265.586.586.586a.583.583 0 0 0 .586-.586v-.586h2.664v.586a.59.59 0 0 0 .594.586c.32 0 .578-.263.578-.586v-.586h.765c.649 0 1.172.525 1.172 1.172v6.21c0 .324.266.586.586.586Z"/><path d="M4.25 11.25a.588.588 0 0 1-.586.586.588.588 0 0 1-.586-.586c0-.323.266-.586.586-.586.32 0 .586.263.586.586ZM4.25 6.152a.588.588 0 0 1-.586.586.588.588 0 0 1-.586-.586c0-.323.266-.586.586-.586.32 0 .586.263.586.586ZM4.25 8.701a.588.588 0 0 1-.586.586.588.588 0 0 1-.586-.586c0-.323.266-.586.586-.586.32 0 .586.263.586.586ZM6.797 8.701a.588.588 0 0 1-.586.586.588.588 0 0 1-.586-.586c0-.323.266-.586.586-.586.32 0 .586.263.586.586ZM6.797 6.152a.588.588 0 0 1-.586.586.588.588 0 0 1-.586-.586c0-.323.266-.586.586-.586.32 0 .586.263.586.586ZM6.797 11.25a.588.588 0 0 1-.586.586.588.588 0 0 1-.586-.586c0-.323.266-.586.586-.586.32 0 .586.263.586.586Z" fill-rule="evenodd"/></g></svg> %s', $formatted_date . '</strong>' );
        } catch (Exception $e) {
            // Handle the exception if the date format is incorrect
            error_log('Error formatting date: ' . $e->getMessage());
        }
    }
    return $text;
}
// Exclude the current post from the query
add_filter('acf/fields/relationship/query/name=other_tours', 'my_custom_relationship_query', 10, 3);
function my_custom_relationship_query( $args, $field, $post_id ) {
    
    if( !isset($args['post__not_in']) ) {
        $args['post__not_in'] = array(); // Initialize if not set
    }
    $args['post__not_in'][] = $post_id; // Exclude the current post

    return $args;
}

// Add a new column to the posts list table
add_filter('manage_wycieczki_posts_columns', 'add_custom_columns_for_wycieczki');
function add_custom_columns_for_wycieczki($columns) {
    $columns['tour_details'] = '<p style="display: flex; align-items:center; gap: 5px; margin: 0;"><svg width="15" height="15" fill="none" xmlns="http://www.w3.org/2000/svg"><defs><clipPath><path fill="#fff" fill-opacity="0" d="M0 0h15v15H0z"/></clipPath></defs><g clip-path="url(#a)" fill="#0296D8"><path d="M8.172 10.664c0 .646.523 1.172 1.172 1.172h1.375c.648 0 1.172-.526 1.172-1.172V9.287c0-.646-.524-1.172-1.172-1.172H9.344c-.649 0-1.172.526-1.172 1.172v1.377Zm1.172-1.377h1.375v1.377H9.344V9.287Z"/><path d="M11.89 6.152a.588.588 0 0 1-.585.586.588.588 0 0 1-.586-.586c0-.323.265-.586.586-.586.32 0 .586.263.586.586ZM9.344 6.152a.588.588 0 0 1-.586.586.588.588 0 0 1-.586-.586c0-.323.265-.586.586-.586.32 0 .586.263.586.586Z" fill-rule="evenodd"/><path d="M14.414 10.313c.32 0 .586-.263.586-.586V3.516a2.349 2.349 0 0 0-2.344-2.344h-.765V.586A.582.582 0 0 0 11.312 0a.59.59 0 0 0-.593.586v.586H8.055V.586A.583.583 0 0 0 7.469 0a.588.588 0 0 0-.586.586v.586H4.25V.586A.588.588 0 0 0 3.664 0a.583.583 0 0 0-.586.586v.586h-.734A2.349 2.349 0 0 0 0 3.516v9.14A2.349 2.349 0 0 0 2.344 15h10.312A2.349 2.349 0 0 0 15 12.656a.588.588 0 0 0-.586-.586.588.588 0 0 0-.586.586c0 .647-.523 1.172-1.172 1.172H2.344a1.172 1.172 0 0 1-1.172-1.172v-9.14c0-.647.523-1.172 1.172-1.172h.734v.586c0 .323.258.586.586.586.32 0 .586-.263.586-.586v-.586h2.633v.586c0 .323.265.586.586.586a.583.583 0 0 0 .586-.586v-.586h2.664v.586a.59.59 0 0 0 .594.586c.32 0 .578-.263.578-.586v-.586h.765c.649 0 1.172.525 1.172 1.172v6.21c0 .324.266.586.586.586Z"/><path d="M4.25 11.25a.588.588 0 0 1-.586.586.588.588 0 0 1-.586-.586c0-.323.266-.586.586-.586.32 0 .586.263.586.586ZM4.25 6.152a.588.588 0 0 1-.586.586.588.588 0 0 1-.586-.586c0-.323.266-.586.586-.586.32 0 .586.263.586.586ZM4.25 8.701a.588.588 0 0 1-.586.586.588.588 0 0 1-.586-.586c0-.323.266-.586.586-.586.32 0 .586.263.586.586ZM6.797 8.701a.588.588 0 0 1-.586.586.588.588 0 0 1-.586-.586c0-.323.266-.586.586-.586.32 0 .586.263.586.586ZM6.797 6.152a.588.588 0 0 1-.586.586.588.588 0 0 1-.586-.586c0-.323.266-.586.586-.586.32 0 .586.263.586.586ZM6.797 11.25a.588.588 0 0 1-.586.586.588.588 0 0 1-.586-.586c0-.323.266-.586.586-.586.32 0 .586.263.586.586Z" fill-rule="evenodd"/></g></svg> <strong>Data wycieczki</strong></p>';
    
    unset($columns['date']);
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
            // Reformat the time to exclude seconds
            $tour_time_formatted = date('G:i', strtotime($tour_time));
        } else {
            $tour_time_formatted = 'Nie dodano godziny';
        }
        echo '<div class="custom-flex" style="display:flex; flex-direction:column; gap: 5px;"><span class="date" style="display:flex; align-items:center; gap: 5px;"><svg width="15" height="15" fill="none" xmlns="http://www.w3.org/2000/svg"><defs><clipPath><path fill="#fff" fill-opacity="0" d="M0 0h15v15H0z"/></clipPath></defs><g clip-path="url(#a)" fill="#0296D8"><path d="M8.172 10.664c0 .646.523 1.172 1.172 1.172h1.375c.648 0 1.172-.526 1.172-1.172V9.287c0-.646-.524-1.172-1.172-1.172H9.344c-.649 0-1.172.526-1.172 1.172v1.377Zm1.172-1.377h1.375v1.377H9.344V9.287Z"/><path d="M11.89 6.152a.588.588 0 0 1-.585.586.588.588 0 0 1-.586-.586c0-.323.265-.586.586-.586.32 0 .586.263.586.586ZM9.344 6.152a.588.588 0 0 1-.586.586.588.588 0 0 1-.586-.586c0-.323.265-.586.586-.586.32 0 .586.263.586.586Z" fill-rule="evenodd"/><path d="M14.414 10.313c.32 0 .586-.263.586-.586V3.516a2.349 2.349 0 0 0-2.344-2.344h-.765V.586A.582.582 0 0 0 11.312 0a.59.59 0 0 0-.593.586v.586H8.055V.586A.583.583 0 0 0 7.469 0a.588.588 0 0 0-.586.586v.586H4.25V.586A.588.588 0 0 0 3.664 0a.583.583 0 0 0-.586.586v.586h-.734A2.349 2.349 0 0 0 0 3.516v9.14A2.349 2.349 0 0 0 2.344 15h10.312A2.349 2.349 0 0 0 15 12.656a.588.588 0 0 0-.586-.586.588.588 0 0 0-.586.586c0 .647-.523 1.172-1.172 1.172H2.344a1.172 1.172 0 0 1-1.172-1.172v-9.14c0-.647.523-1.172 1.172-1.172h.734v.586c0 .323.258.586.586.586.32 0 .586-.263.586-.586v-.586h2.633v.586c0 .323.265.586.586.586a.583.583 0 0 0 .586-.586v-.586h2.664v.586a.59.59 0 0 0 .594.586c.32 0 .578-.263.578-.586v-.586h.765c.649 0 1.172.525 1.172 1.172v6.21c0 .324.266.586.586.586Z"/><path d="M4.25 11.25a.588.588 0 0 1-.586.586.588.588 0 0 1-.586-.586c0-.323.266-.586.586-.586.32 0 .586.263.586.586ZM4.25 6.152a.588.588 0 0 1-.586.586.588.588 0 0 1-.586-.586c0-.323.266-.586.586-.586.32 0 .586.263.586.586ZM4.25 8.701a.588.588 0 0 1-.586.586.588.588 0 0 1-.586-.586c0-.323.266-.586.586-.586.32 0 .586.263.586.586ZM6.797 8.701a.588.588 0 0 1-.586.586.588.588 0 0 1-.586-.586c0-.323.266-.586.586-.586.32 0 .586.263.586.586ZM6.797 6.152a.588.588 0 0 1-.586.586.588.588 0 0 1-.586-.586c0-.323.266-.586.586-.586.32 0 .586.263.586.586ZM6.797 11.25a.588.588 0 0 1-.586.586.588.588 0 0 1-.586-.586c0-.323.266-.586.586-.586.32 0 .586.263.586.586Z" fill-rule="evenodd"/></g></svg> ' . esc_html($tour_date_formatted) . '</span><span class="time" style="display:flex; align-items:center; gap: 5px;"><svg width="15" height="15" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8.18 7.217V3.41a.684.684 0 0 0-.688-.682.666.666 0 0 0-.476.2.665.665 0 0 0-.204.482V7.5c0 .18.07.354.204.482l2.039 2.045a.7.7 0 0 0 .484.192.678.678 0 0 0 .672-.676.682.682 0 0 0-.188-.48L8.18 7.217Z" fill="#0296D8"/><path d="M7.5 0A7.514 7.514 0 0 0 .57 4.63a7.482 7.482 0 0 0 1.625 8.173 7.48 7.48 0 0 0 3.844 2.053c1.453.29 2.961.14 4.328-.427a7.464 7.464 0 0 0 3.367-2.762A7.47 7.47 0 0 0 15 7.5a7.503 7.503 0 0 0-2.203-5.3A7.482 7.482 0 0 0 7.5 0Zm0 13.636a6.13 6.13 0 0 1-3.406-1.034 6.119 6.119 0 0 1-2.61-6.3 6.108 6.108 0 0 1 1.68-3.14 6.086 6.086 0 0 1 3.14-1.68 6.147 6.147 0 0 1 3.548.349A6.137 6.137 0 0 1 7.5 13.636Z" fill="#0296D8"/></svg>' . esc_html($tour_time_formatted) . '</span>';
        echo '</div>';
    }
}
//add quick edit custom boxes
add_action('quick_edit_custom_box', 'add_quick_edit_fields', 10, 2);
function add_quick_edit_fields($column_name, $post_type) {
    if ('wycieczki' !== $post_type || 'tour_details' !== $column_name) {
        return;
    }
    ?>
    <fieldset class="inline-edit-col-right">
        <div class="inline-edit-col">
            <label class="inline-edit-group">
                <span class="title">Data wycieczki</span>
                <input type="date" class="custom-date-picker" name="acf[tour_date]" value="">
            </label>
            <label class="inline-edit-group">
                <span class="title">Godzina wycieczki</span>
                <input type="time" name="acf[tour_time]" value="">
            </label>
        </div>
    </fieldset>
    <?php
}


// Hook into the admin notices action to display custom messages
add_action('admin_notices', 'display_custom_admin_notices');
function display_custom_admin_notices() {
    $message = get_transient('custom_admin_notice');
    if ($message) {
        echo '<div class="notice notice-success is-dismissible"><p>' . esc_html($message) . '</p></div>';
        delete_transient('custom_admin_notice');
    }
}

// Hook into the save_post action to process and save ACF fields
add_action('save_post', 'save_acf_fields_quick_edit', 10, 2);
function save_acf_fields_quick_edit($post_id, $post) {
    if ('wycieczki' === $post->post_type && isset($_REQUEST['acf'])) {
        
        $date_value = '';
        $time_value = '';

        // Loop through each expected field to capture its value
        foreach ($_REQUEST['acf'] as $field_key => $value) {
            $field_object = get_field_object($field_key, $post_id);
            if ($field_object) {
                if ('tour_date' === $field_object['name']) {
                    $date_value = sanitize_text_field($value);
                    $formatted_date = date('Ymd', strtotime($date_value));
                    update_field($field_key, $formatted_date, $post_id);
                }
                elseif ('tour_time' === $field_object['name']) {
                    $time_value = sanitize_text_field($value);
                    update_field($field_key, $time_value, $post_id);
                }
            }
        }

        if (!empty($date_value) && !empty($time_value)) {
            $combinedDateTime = $date_value . ' ' . $time_value;
            $datetime = DateTime::createFromFormat('Y-m-d H:i', $combinedDateTime);
            if ($datetime) {
                $formatted_datetime = $datetime->format('Y-m-d H:i:s');
                if (update_field('tour_datetime', $formatted_datetime, $post_id)) {
                    $successMessage = 'Formatowana data i czas: ' . $formatted_datetime . ' została zapisana pomyślnie.';
                } else {
                    $successMessage = 'Błąd zapisu daty i czasu wycieczki.';
                }
                
                //set_transient('custom_admin_notice', $successMessage, 45); // 45 seconds should be enough for the transient to persist until it's displayed
            } else {
                $errorMessage = 'Failed to create DateTime from: ' . $combinedDateTime;
                //set_transient('custom_admin_notice', $errorMessage, 45);
            }
        }

    }
}

// Hook into 'pre_get_posts' to modify the query for sorting.
function sort_wycieczki_by_tour_date($query) {
    if (is_admin() && $query->is_main_query()) {
        $post_type = $query->get('post_type');
        if ('wycieczki' === $post_type) {
            // Check if 'orderby' is not already set by the user
            $orderby = $query->get('orderby');
            if (empty($orderby)) {
                // Set default sorting by 'tour_date' ACF field
                $query->set('meta_key', 'tour_date');
                $query->set('orderby', 'meta_value');
                $query->set('order', 'ASC'); // or 'DESC' depending on your needs
            }
        }
    }
}
add_action('pre_get_posts', 'sort_wycieczki_by_tour_date');


//sortable custom column
function make_tour_details_column_sortable($columns) {
    $columns['tour_details'] = 'tour_date';
    return $columns;
}
add_filter('manage_edit-wycieczki_sortable_columns', 'make_tour_details_column_sortable');


function fetch_acf_values() {

    $post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;

    $tour_date = get_field('tour_date', $post_id);
    $tour_time = get_field('tour_time', $post_id);

    wp_send_json_success(array(
        'tour_date' => $tour_date,
        'tour_time' => $tour_time
    ));
}
add_action('wp_ajax_fetch_acf_values', 'fetch_acf_values');


function update_dateandtime_field($post_id) {
    if (get_post_type($post_id) !== 'wycieczki') {
        return;
    }
  
    $tour_date = get_field('tour_date', $post_id); 
    $tour_time = get_field('tour_time', $post_id); 

    $datetimeObject = DateTime::createFromFormat('d.m.Y G:i', $tour_date . ' ' . $tour_time);
    
   
    if ($datetimeObject !== false) {
        $formatted_datetime = $datetimeObject->format('Y-m-d H:i:s');
        update_field('tour_datetime', $formatted_datetime, $post_id);
    } else {

    }
}
add_action('acf/save_post', 'update_dateandtime_field', 20);


add_filter('acf/load_field/name=tour_datetime', 'hide_acf_field_for_non_admin_user');
function hide_acf_field_for_non_admin_user($field) {
    
    $current_user = wp_get_current_user();
    
    if ($current_user->user_login !== 'gregoradmin' && $current_user->ID !== 1) {
    
        $field['disabled'] = true;

    }

    return $field;
}

function add_custom_post_class( $classes, $class, $post_id ) {
    if (is_admin() && get_post_type($post_id) === 'wycieczki') {
        $tour_datetime = get_post_meta($post_id, 'tour_datetime', true);
        $today = current_time('Y-m-d H:i:s');
        if (!empty($tour_datetime) && $tour_datetime < $today) {
            $classes[] = 'past-tour-date'; // Add your custom class
        }
    }

    return $classes;
}
add_filter( 'post_class', 'add_custom_post_class', 10, 3 );
function enqueue_custom_admin_style() {
    $css = '.post-type-wycieczki .past-tour-date { background-color: #ffdddd !important; }'; // Custom CSS
    wp_add_inline_style( 'wp-admin', $css );
}
add_action( 'admin_enqueue_scripts', 'enqueue_custom_admin_style' );
function wycieczki_admin_notice_for_outdated_posts() {
    $screen = get_current_screen();
    
    // Check if we're on the 'wycieczki' post type list page
    if ($screen->id === 'edit-wycieczki') {
        echo '<div class="notice is-dismissible">
            <p>Posty, które mają <span style="background-color: #ffdddd !important; padding: 3px;">czerwone</span> tło są przedawnione.</p>
        </div>';
    }
}
add_action('admin_notices', 'wycieczki_admin_notice_for_outdated_posts');


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
pll_register_string('motyw', 'Lista wycieczek');


// pll_register_string('Brikol', 'zł');
// pll_register_string('Brikol', 'Cena:');
// pll_register_string('Brikol', 'Zapytaj o produkt');
// pll_register_string('Brikol', 'Zobacz więcej');
// pll_register_string('Brikol', 'Wszelkie prawa zastrzeżone © 2024');
// pll_register_string('Brikol', 'Realizacja:');
// pll_register_string('Brikol', 'Zapytaj o produkt / złóż zamówienie:');