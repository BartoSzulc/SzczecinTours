@php
$post_type = 'wycieczki'; 
$args = [
    'post_type' => $post_type,
    'posts_per_page' => 4,
    'orderby' => 'rand',
    'order' => 'DESC',
];
$query = new WP_Query($args);

$data = get_field('recent', 'option');
$title = $data['title'] ?? null;
$subtitle = $data['subtitle'] ?? null;

@endphp

<section class="relative single__recent py-30 lg:py-60">
    <div class="container">
        <div class="w-full mb-30 lg:mb-60 text-center">
            @if ($title)
            <div class="text-h3 lg:text-h2 font-bold  mb-half-mobile lg:mb-half">
               {!! $title !!}
            </div>
            @endif
          
        </div>
        <div class="grid gap-5 posts card-grid" >
            @while ($query->have_posts())
                @php $query->the_post() @endphp
                @include('partials.post.content')
            @endwhile
        </div>
   
</section>