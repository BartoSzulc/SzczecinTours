@extends('layouts.app')
@php
    $today = date('Ymd');
    $args = array(
        'lang' => pll_current_language('slug'),
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
@section('content')

    @include('sections.home.hero')
    
    <section class="home__travels">
        <div class="container">
            <div class="w-full text-center py-30 lg:py-60 text-color6 text-h2">
                <h2>Lista wycieczek</h2>
            </div>
            <div class="flex items-center bg-white py-5 px-30 rounded-md">
                <div class="flex  items-center filter-button">
                    <a id="selectToday" class="pr-30">Dzisiaj</a>
                </div>
                <div class="flex border-custom items-center filter-button">
                    <a id="selectTomorrow" class="px-30">Jutro</a>
                </div>
                <div class="wrap border-custom datepicker-show flex w-fit relative cursor-pointer">
                    <input class="absolute opacity-0 w-full h-full flex cursor-pointer" id="minMaxExample" >
                    <div class="flex items-center gap-2.5 px-30">
                        @svg('images.kalendarz-big') 
                        <span id="selectedDate" class="flex items-center gap-2.5">Wybierz datę</span>
                    </div>
                </div>
                <div class="pl-30 flex justify-center gap-30">
                    @foreach($miejsce_wycieczki_terms as $term)
                        <div class="relative miejsce-radio">
                            <input type="radio" id="{{ $term->slug }}" name="miejsce_wycieczki" class="hidden-radio miejsce_wycieczki-radio" value="{{ $term->slug }}">
                            <label for="{{ $term->slug }}" class="">{{ $term->name }}</label>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="flex justify-between py-10 category-picker">
                <div class="text-h4 font-bold text-color2">
                    <p>Wybór kategorii</p>
                </div>
                <div class="relative kategoria-radio">
                    <input type="radio" id="all" name="kategoria_wycieczki" class="hidden-radio kategoria_wycieczki-radio" value="all">
                    <label for="all" class="font-button">All</label>
                </div>
                @foreach($kategoria_wycieczki_terms as $term)
                <div class="relative kategoria-radio">
                    <input type="radio" id="{{ $term->slug }}" name="kategoria_wycieczki" class="hidden-radio kategoria_wycieczki-radio" value="{{ $term->slug }}">
                    <label for="{{ $term->slug }}" class="font-button">{{ $term->name }}</label>
                </div>
                @endforeach
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
            
