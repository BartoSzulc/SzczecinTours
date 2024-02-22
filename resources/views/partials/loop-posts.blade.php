@php
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;


    $today = date('Ymd');
    $args = array(
        'lang' => 'all',
        'post_type' => 'wycieczki',
        'meta_key' => 'tour_date',
        'orderby' => 'meta_value_num',
        'order' => 'ASC',
        'paged' => $paged,
        'posts_per_page' => 10,
        'meta_query' => array(
            array(
                'key' => 'tour_date',
                'compare' => '>=',
                'value' => $today,
                'type' => 'DATE',
            )
        )
    );
    $query = new WP_Query($args);


@endphp
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