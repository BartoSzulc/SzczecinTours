@php
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
// Simple mobile detection
$is_mobile = preg_match('/Mobile|Android|Silk\/|Kindle|BlackBerry|Opera Mini|Opera Mobi/', $_SERVER['HTTP_USER_AGENT']);

$posts_per_page = $is_mobile ? 5 : 10;

$current_language = pll_current_language();
    $today = date('Ymd');
    $args = array(
        'lang' => 'all',
        'post_type' => 'wycieczki',
        'meta_key' => 'tour_date',
        'orderby' => 'meta_value_num',
        'order' => 'ASC',
        'paged' => $posts_per_page,
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
<div id="posts" class="posts grid gap-5 mb-60 card-grid" data-aos="fade-up">
    @if($query->have_posts())
        @while($query->have_posts()) @php $query->the_post() @endphp
            @include('partials.post.content')
        @endwhile
        @php page_navi($query, $posts_per_page); @endphp
        
        @php wp_reset_postdata() @endphp
    @endif
</div>