<?php 

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
?>