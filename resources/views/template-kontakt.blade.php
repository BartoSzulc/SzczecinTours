{{--
  Template Name: Kontakt
--}}

@extends('layouts.app')
@php

$data = get_field('contact');

$left = $data['left-col'] ?? null;
// left
$subtitle = $left['subtitle'] ?? null;
$description = $left['description'] ?? null;
$nip_regon = $left['nip_regon'] ?? null;
$button_version = $left['button_version'] ?? null;
$button_link = $left['button_link'] ?? null;
$elements = $left['elements'] ?? null;
//middle
$map = $data['map'] ?? null;
$form = $data['form'] ?? null;
$title = $form['title'] ?? null;
$shortcode = $form['shortcode'] ?? null;

@endphp
@section('content')


<section class="hero__template bg-color7 relative py-half lg:py-full overflow-hidden">
  <div class="pointer-events-none bg-white absolute triangle-right -top-px -right-px h-20 w-20 lg:w-[160px] lg:h-[160px] z-10"></div>
  <div class="container">
    <div class="w-full">
        <div class="text-h3 font-bold"  data-aos="fade-up">
            <h1>{{ the_title() }}</h1>
        </div>
    </div>
  </div>
</section>
@if (!empty($data))
<section class="contact__main py-half lg:py-full" id="kontakt">
  <div class="container">
      <div class="grid grid-cols-12 gap-5">
          <div class="col-span-full lg:col-span-6 flex flex-col">
 
              <div class="flex flex-col space-y-5">
                @if (!empty($subtitle))
                <div class="text-h5 lg:text-h4 font-bold"  data-aos="fade-up">
                    {!! $subtitle !!}
                </div>
                @endif
                @if (!empty($description))
                <div class="text-h6 lg:text-h5  font-semibold"  data-aos="fade-up">
                    {!! $description !!}
                </div>
                @endif
                @if (!empty($nip_regon))
                <div class="text-base lg:text-h6 text-color6 font-semibold"  data-aos="fade-up">
                    {!! $nip_regon !!}
                </div>
                @endif
              </div>
              @if (!empty($button_link))
              <div class="inline-flex my-half-mobile lg:my-half"  data-aos="fade-up">
                @include('components.button')
              </div>
             @endif
             @if (!empty($elements))
             <div class="flex flex-col space-y-5 lg:mb-half mb-5">
                @foreach ($elements as $element)
                @php
                    $icon = $element['icon'] ?? null;
                    $text = $element['text'] ?? null;
                    $type = $element['type'] ?? null;
                    $prefix = ($type === 'phone') ? 'tel:' : 'mailto:';
                    
                @endphp
                <a class="item flex items-center justify-start lg:space-x-30 space-x-5" href="{{$prefix}}{{ removeSpaces($text) }}"  data-aos="fade-up">
                    <img src="{{$icon['url']}}" alt="{{$icon['alt']}}">
                    <span>{{$text}}</span>
                </a>
                @endforeach
            </div>
            @endif
          </div>
          @if (!empty($map))
          <div class="col-span-full lg:col-span-6 relative"  data-aos="fade-up">
              <div class="absolute triangle triangle-top -right-px -top-px z-10 lg:w-[calc((115/790)*100%)] lg:h-[120px] w-60 h-60 bg-white"></div>
              <iframe src="{{ $map }}" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
              <div class="absolute triangle triangle-bottom -left-px -bottom-px z-10 lg:w-[calc((115/790)*100%)] lg:h-[120px] w-60 h-60 bg-white"></div>
          </div>
            @endif

      </div>
      <div class="bg-color7 p-half-mobile lg:p-half mt-half-mobile lg:mt-half max-lg:w-[calc(100%+40px)] max-lg:-left-5 relative">
        <div class="w-full mb-half-mobile lg:mb-half">
            @if (!empty($title))
            <div class="text-h5 lg:text-h4 font-bold text-center"  data-aos="fade-up">
                <h2>{!! $title !!}</h2>
            </div>
            @endif
        </div>
        @if (!empty($shortcode))
        {!! do_shortcode($shortcode) !!}
        @endif
    </div>
  </div>
  
</section>
@endif
@endsection
