@extends('layouts.app')

@php
$post_type = 'produkty'; 
$term_id = get_queried_object_id();
$term_obj = get_term($term_id);
$taxonomy_name = $term_obj->taxonomy;
@endphp

@php
$args = [
      'post_type' => $post_type,
      'posts_per_page' => -1,
      'tax_query' => [
          [
              'taxonomy' => $taxonomy_name,
              'field'    => 'term_id',
              'terms'    => $term_id,
          ],
      ],
];
$query = new WP_Query($args);
@endphp

@section('content')
<section class="hero__template bg-color7 relative py-half lg:py-full overflow-hidden">
   <div class="pointer-events-none bg-white absolute triangle-right -top-px -right-px h-20 w-20 lg:w-[160px] lg:h-[160px] z-10"></div>
   <div class="container">
      <div class="w-full mb-half-mobile lg:mb-half">
         <div class="text-h4 lg:text-h3 font-bold mb-half-mobile lg:mb-half"  data-aos="fade-up">
            <h2>{{ $term_obj->name }}</h2>
         </div>
         <div class="text-base lg:text-desc text-color6"  data-aos="fade-up">
            <p>{{ $term_obj->description }}</p>
         </div>
      </div>
      <div class="flex flex-col gap-half-mobile lg:gap-half">
            <div class="bg-white p-half-mobile lg:p-half max-lg:w-[calc(100%+40px)] max-lg:-left-5 relative">
            @if ($query->have_posts())
            <div class="grid md:grid-cols-2 grid-cols-1 lg:grid-cols-4 gap-5 xl:gap-half">
               @while ($query->have_posts())
               @php $query->the_post() @endphp
                  @include('partials.post-card-' . $post_type, ['class' => 'bg-white'])
               @endwhile
            </div>
            @else
            <div class="col-span-full mb-half lg:mb-full">
               <div class="text-h4 lg:text-h3 font-bold"  data-aos="fade-up">
                  <h2>{{_('Brak produktów')}}</h2>
               </div>
            </div>
            @endif
         </div>
         @php wp_reset_postdata() @endphp
      </div>
   </div>
</section>
@endsection