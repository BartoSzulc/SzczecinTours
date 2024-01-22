@extends('layouts.app')
{{--
Template Name: Oferta
--}}
@php
$post_type = 'produkty'; 
$taxonomies = get_object_taxonomies($post_type, 'names');
$taxonomy_name = !empty($taxonomies) ? $taxonomies[0] : null;

$data = get_field('offer');
$title = $data['title'] ?? null;
$subtitle = $data['subtitle'] ?? null;
@endphp
@section('content')
<section class="hero__template bg-color7 relative py-half lg:py-full overflow-hidden">
   <div class="pointer-events-none bg-white absolute triangle-right -top-px -right-px h-20 w-20 lg:w-[160px] lg:h-[160px] z-10"></div>
   <div class="container">
      <div class="w-full mb-half-mobile lg:mb-half">
         @if (!empty($title))
         <div class="text-h4 lg:text-h3 font-bold mb-half-mobile lg:mb-half"  data-aos="fade-up">
            {!! $title !!}
         </div>
         @endif
         @if (!empty($subtitle))
         <div class="text-base lg:text-desc text-color6"  data-aos="fade-up">
          {!! $subtitle !!}
         </div>
         @endif
      </div>
      <div class="flex flex-col gap-half-mobile lg:gap-half" >
         @php
         $terms = get_terms([
              'taxonomy' => $taxonomy_name,
              'hide_empty' => false,
         ]);
         @endphp
         @if (!empty($terms) && !is_wp_error($terms))
         @foreach ($terms as $term)
         @php
         $args = [
              'post_type' => $post_type,
              'posts_per_page' => -1,
              'tax_query' => [
                  [
                      'taxonomy' => $taxonomy_name,
                      'field'    => 'term_id',
                      'terms'    => $term->term_id,
                  ],
              ],
         ];
         $query = new WP_Query($args);
         @endphp
         <div class="bg-white p-half-mobile lg:p-half max-lg:w-[calc(100%+40px)] max-lg:-left-5 relative">
            @if ($query->have_posts())
            @php
            $term_obj = get_term($term->term_id, $taxonomy_name);
            @endphp
            <div class="flex flex-col gap-half-mobile lg:gap-half mb-half-mobile lg:mb-half">
               <div class="text-h4 lg:text-h2 font-bol"  data-aos="fade-up">
                  <h2>{{ $term_obj->name }}</h2>
               </div>
               <div class="text-xs lg:text-desc text-color6"  data-aos="fade-up">
                  <p>{{ $term_obj->description }}</p>
               </div>
            </div>
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
         @endforeach
         @endif
      </div>
   </div>
</section>
@endsection