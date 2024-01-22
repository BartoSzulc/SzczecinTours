{{--
  Template Name: Serwis
--}}
@extends('layouts.app')

@php

$data = get_field('service');
$title = $data['title'] ?? null;
$subtitle = $data['subtitle'] ?? null;
$form_title = $data['form_title'] ?? null;
$shortcode = $data['shortcode'] ?? null;

@endphp

@section('content')

@if (!empty($data))
  <section class="hero__template bg-color7 relative py-half lg:py-full overflow-hidden">
    <div class="pointer-events-none bg-white absolute triangle-right -top-px -right-px h-20 w-20 lg:w-[160px] lg:h-[160px] z-10"></div>
    <div class="container">
        <div class="w-full mb-half-mobile lg:mb-half">
          @if (!empty($title))
            <div class="text-h3 font-bold" data-aos="fade-up">
                {!! $title !!}
            </div>
          @endif
        </div>
        <div class="bg-white pt-half-mobile lg:p-half relative">
          <div class="absolute bg-white w-[calc(100%+40px)] h-full z-0 inset-0 -left-5 lg:hidden"></div>
            <div class="relative z-10">
              @if (!empty($subtitle))
                <div class="text-xs md:text-base lg:text-desc text-color6 mb-half-mobile lg:mb-half relative"  data-aos="fade-up">
                  {!! $subtitle !!}
                </div>
              @endif
              <div class="h-auto lg:h-[480px] relative lg:overflow-hidden flex">
                  @if (get_the_post_thumbnail_url())
                  <img class="max-lg:h-[350px] max-lg:w-full max-sm:h-[250px] relative lg:absolute object-center object-cover lg:top-1/2 lg:-translate-y-1/2" src="{{ get_the_post_thumbnail_url() }}" alt="">
                  @endif
              </div>
              <div class="bg-color7 pb-0 pt-half-mobile lg:py-half relative">
                <div class="absolute bg-color7 w-[calc(100%+40px)] h-full z-0 inset-0 -left-5 lg:hidden"></div>
                @if (!empty($form_title))
                  <div class="text-h5 lg:text-h4 mb-half-mobile lg:mb-half text-center relative z-10"  data-aos="fade-up">
                    <h2>{!! $form_title !!}</h2>
                  </div>
                @endif
                @if (!empty($shortcode))
                {!! do_shortcode($shortcode) !!}
                @endif
                
              </div>
            </div>
        </div>
    </div>
  </section>
@endif
@endsection







