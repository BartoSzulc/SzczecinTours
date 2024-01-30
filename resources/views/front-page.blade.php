@extends('layouts.app')
@php
    $today = date('Ymd');
    $args = array(
        'lang' => 'all',
        'post_type' => 'wycieczki',
        'meta_key' => 'tour_date',
        'orderby' => 'meta_value_num',
        'order' => 'ASC',
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
    $kategoria_wycieczki_terms = get_terms('kategoria_wycieczki', array('hide_empty' => false));
    $miejsce_wycieczki_terms = get_terms('miejsce_wycieczki', array('hide_empty' => false));

@endphp
{{-- @dump($args) --}}
@section('content')

    @include('sections.home.hero')
    
    <section class="home__travels">
        <div class="container">
            <div class="w-full text-center py-30 lg:py-60 text-color6 text-h2">
                <h2>Lista wycieczek</h2>
            </div>
            <div class="flex items-center justify-between bg-white py-5 px-30 rounded-md">
                <div class="left flex items-center">
                    @include('partials.search.left')
                </div>
                <div class="right flex items-center">
                    @include('partials.search.right')
                </div>
            </div>
            <div class="flex items-center justify-between py-10 category-picker">
                @include('partials.search.category-picker')
            </div>
     
            <div id="posts" class="grid grid-cols-4 gap-5" data-aos="fade-up">
                @if($query->have_posts())
                    @while($query->have_posts()) @php $query->the_post() @endphp
                        @include('partials.post.content')
                    @endwhile
                    @php wp_reset_postdata() @endphp
                @endif
            </div>
        </div>
    </section>

@endsection
            
