{{--
  Template Name: Custom Template
--}}

@extends('layouts.app')

@section('content')
@php
// Specify the term ID
$term_id = 40; // Replace this with your term ID

// Get term translations
$term_translations = pll_get_term_translations($term_id);
$term_ids = array_values($term_translations);

// Get all languages
$languages = pll_languages_list();

$all_posts = [];

// Loop through each language
foreach ($languages as $lang) {
    // Create a new query for the current language
    $args = array(
        'post_type' => 'wycieczki',
        'lang' => $lang,
        'tax_query' => array(
            array(
                'taxonomy' => 'kategoria_wycieczki',
                'field'    => 'term_id',
                'terms'    => $term_ids,
                'operator' => 'IN',
            ),
        ),
    );

    $query = new WP_Query($args);

    // If the query returned posts, merge them with the all_posts array
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $all_posts[] = $query->post;
        }
    }

    // Reset post data
    wp_reset_postdata();
}

// Loop through the all_posts array and display the posts
foreach ($all_posts as $post) {
    setup_postdata($post);
    
    // Display the post title
    echo $post->post_title;
    
    // Get the terms associated with the post
    $terms = get_the_terms($post->ID, 'kategoria_wycieczki');
    
    // Check if any terms were found
    if (!empty($terms)) {
        echo '<ul>';
        
        // Loop through each term and display it
        foreach ($terms as $term) {
            echo '<li>' . $term->name . '</li>';
        }
        
        echo '</ul>';
    }
}

// Reset post data
wp_reset_postdata();
@endphp
@endsection
