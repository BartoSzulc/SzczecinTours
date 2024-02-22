@extends('layouts.app')
@php
    $kategoria_wycieczki_terms = get_terms('kategoria_wycieczki', array('hide_empty' => true));
    $miejsce_wycieczki_terms = get_terms('miejsce_wycieczki', array('hide_empty' => true));
@endphp
@section('content')

    @include('sections.home.hero')
    
    <section class="home__travels ">
        <div class="container">
            <div class="w-full text-center py-30 lg:py-60 text-color6 text-h3 lg:text-h2 dark:text-colorContrast transition-all duration-500 ease-in-out">
                <h2>{{ pll__('Lista wycieczek') }}</h2>
            </div>
            <div id="search-tours" class="max-lg:mb-10 flex max-xl:flex-wrap gap-5 items-center justify-between bg-white dark:bg-black py-5 px-5 3xl:px-30 rounded-md transition-all duration-500 ease-in-out">
                
                <div class="max-md:gap-y-5 left flex max-md:flex-wrap items-center justify-center max-xl:w-full">
                    @include('partials.search.left')
                </div>
                <div class="right flex flex-wrap max-lg:gap-5 items-center justify-center max-xl:w-full">
                    <div class="lg:hidden flex-item text-h5 font-semibold text-color2 dark:text-colorContrast h-fit max-sm:w-full max-sm:text-center">
                        <p>{{ pll__('Wybór kategorii') }}</p>
                    </div>
                    <div class="flex flex-wrap lg:hidden items-center max-sm:w-full">
                        @include('partials.search.category-picker--mobile')
                    </div>
                    @include('partials.search.right')
                </div>
            </div>
            <div class="max-lg:hidden 2xl:flex items-center justify-stretch py-10 category-picker gap-y-5 2xl:gap-x-10 gap-x-5 flex-wrap max-2xl:grid max-2xl:grid-cols-4">
                @include('partials.search.category-picker')
            </div>
            @include('partials.loop-posts')
        </div>
    </section>
    @include('sections.home.seo')


@endsection