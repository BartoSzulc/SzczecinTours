@php
    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;


    $current_datetime = current_time('Y-m-d H:i:s'); // Get current datetime in MySQL's DATETIME format.

    $args = array(
        'lang' => 'all',
        'post_type' => 'wycieczki',
        'orderby' => 'meta_value',
        'order' => 'ASC',
        'paged' => $paged,
        'posts_per_page' => 10,
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
<div id="posts" class="posts grid gap-5 mb-60 card-grid" data-aos="fade-up">
    @if($query->have_posts())
        @while($query->have_posts()) @php $query->the_post() @endphp
            @include('partials.post.content')
        @endwhile
        @php page_navi($query, 10); @endphp
        
        @php wp_reset_postdata() @endphp
    @endif
</div>