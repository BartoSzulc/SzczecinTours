@php
    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

    $current_datetime = current_time('Y-m-d H:i:s'); // Get current datetime in MySQL's DATETIME format.

    $args = array(
        'lang' => 'all',
        'post_type' => 'wycieczki',
        'orderby' => 'meta_value',
        'order' => 'ASC',
        'paged' => $paged,
        'posts_per_page' => 12,
        'meta_query' => array(
            'relation' => 'AND',
            array(
                'key' => 'tour_datetime', // Assuming you have a combined datetime field or you've managed to create one.
                'compare' => '>=',
                'value' => $current_datetime,
                'type' => 'DATETIME', // Make sure the type is set to DATETIME.
            )
        )
    );
    $query = new WP_Query($args);

@endphp
{{-- @dump($current_datetime) --}}
{{-- @dump ($query) --}}
<?php
$current_user = wp_get_current_user();
if ($current_user->user_login == 'gregoradmin' || $current_user->ID == '1') {
    echo '<pre>Znaleziono postów: ' . $query->found_posts . '</pre>';
}
?>
<div id="posts" class="posts grid gap-5 mb-60 card-grid" data-aos="fade-up">
    
    @if($query->have_posts())
       
    

        
        

        @while($query->have_posts()) @php $query->the_post() @endphp

        
            @include('partials.post.content')
        @endwhile
        @php page_navi($query, 12); @endphp
        
        @php wp_reset_postdata() @endphp
    @endif
</div>