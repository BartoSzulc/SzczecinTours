@extends('layouts.app')

@php
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
     
            @include('partials.loop-posts')
        </div>
    </section>
    <section class="home__seo">
        <div class="container">
            <div class="w-full text-center my-30 lg:my-60 text-color6 text-h2">
                <h2>Sekcja pod SEO / Nagłówek / Dlaczego warto??</h2>
            </div>
            <div class="grid grid-cols-2 gap-5">
                <div class="col-span-1 border border-colorObramowanie p-5 lg:p-10 rounded-lg">
                    <div class="flex flex-col gap-5">
                        <div class="text-h5 font-semibold text-color6">
                            <h3>Lorem ipsum dolor sit amet consectetur.
                            Cras pharetra nec nec nisl facilisis morbi aliquet.</h3>
                        </div>
                        <div class="text-desc font-normal text-color6">
                            <p>Et nulla venenatis senectus hac scelerisque elit vitae nibh vitae. Auctor et blandit vestibulum et in eget ullamcorper libero ante. Porttitor ornare quam hendrerit gravida ipsum. Vel eu commodo posuere cursus molestie libero. Amet ut risus.</p>
                        </div>
                    </div>
                </div>
                <div class="col-span-1 border border-colorObramowanie p-5 lg:p-10 rounded-lg">
                    <div class="flex flex-col gap-5">
                        <div class="text-h5 font-semibold text-color6">
                            <h3>Lorem ipsum dolor sit amet consectetur.
                            Cras pharetra nec nec nisl facilisis morbi aliquet.</h3>
                        </div>
                        <div class="text-desc font-normal text-color6">
                            <p>Et nulla venenatis senectus hac scelerisque elit vitae nibh vitae. Auctor et blandit vestibulum et in eget ullamcorper libero ante. Porttitor ornare quam hendrerit gravida ipsum. Vel eu commodo posuere cursus molestie libero. Amet ut risus.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-3 gap-5 my-30 lg:my-60">
                <div class="col-span-1 flex gap-10 items-center justify-start">
                    @svg('images.check')
                    <div class="text-h5 text-color2">
                        <p>Z nami zwiedzisz więcej<br/>
                        i dowiesz się więcej</p>
                    </div>
                </div>
                <div class="col-span-1 flex gap-10 items-center justify-start">
                    @svg('images.check')
                    <div class="text-h5 text-color2">
                        <p>Z nami zwiedzisz więcej</br>
                        i dowiesz się więcej</p>
                    </div>
                </div>
                <div class="col-span-1 flex gap-10 items-center justify-start">
                    @svg('images.check')
                    <div class="text-h5 text-color2">
                        <p>Z nami zwiedzisz więcej</br>
                        i dowiesz się więcej</p>
                    </div>
                </div>
            </div>

        </div>
    </section>
    
@endsection
            
