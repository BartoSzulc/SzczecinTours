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
        <div class="w-full mb-30 lg:mb-60">
            @if (!empty($title))
            <div class="text-h3 lg:text-h2 font-bold  mb-half-mobile lg:mb-half">
               {!! $title !!}
            </div>
            @endif
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:gap-20 gap-5">
            @while ($query->have_posts())
                @php $query->the_post() @endphp
                @include('partials.post-card-' . get_post_type(), ['class' => 'bg-white'])
            @endwhile
        </div>
   
</section>