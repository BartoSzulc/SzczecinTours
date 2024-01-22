@extends('layouts.app')
@php

$gallery = get_field('gallery') ?? null;
$year = get_field('year') ?? null;
@endphp


@section('content')
  @while(have_posts()) @php(the_post())
  <section class="hero__template bg-color7 relative py-half lg:py-full overflow-hidden">
    <div class="pointer-events-none bg-white absolute triangle-right -top-px -right-px h-20 w-20 lg:w-[160px] lg:h-[160px] z-10"></div>
    <div class="container">
        <div class="w-full mb-half-mobile lg:mb-half flex justify-between">
            <div class="text-h4 lg:text-h3 font-bold"  data-aos="fade-up">
                <h1>{!! the_title() !!}</h1>
            </div>
            @if (!empty($year))
            <div class="text-base lg:text-h6 text-color2 font-semibold relative z-10"  data-aos="fade-up">
                <p>{{ $year }}</p>
            </div>
            @endif
        </div>
        <div class="bg-white p-half-mobile lg:p-half max-lg:w-[calc(100%+40px)] max-lg:-left-5 relative" >
            <div class="h-auto lg:h-[480px] relative lg:overflow-hidden flex"  data-aos="fade-up">
                <img class="max-lg:h-[350px] max-lg:w-full max-sm:h-[250px] relative lg:absolute object-center object-cover lg:top-1/2 lg:-translate-y-1/2" src="{{get_the_post_thumbnail_url()}}" alt="">
            </div>
            <div class="text-xs md:text-base lg:text-desc text-color6 mt-half-mobile lg:mt-half wysiwyg"  data-aos="fade-up">
                {{ the_content() }}
            </div>
            @if (!empty($gallery))
            <div class="w-full relative mt-half-mobile lg:mt-half text-center">
                <div class="text-h3 lg:text-h2 font-bold"  data-aos="fade-up">
                    <h2>{{ __('Galeria') }}</h2>
                </div>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-5 mt-half-mobile lg:mt-half">
                @foreach ($gallery as $image)
                <div class="col-span-1"  data-aos="fade-up">
                    
                    <a class="h-[150px] sm:h-[200px] lg:h-[250px] object-cover object-center flex glightbox" href="{{ wp_get_attachment_image_url( $image, 'full') }}">
                        {!! wp_get_attachment_image($image, 'full', false, array('class' => 'object-cover object-center mx-auto', 'loading' => 'lazy')); !!}
                    </a>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
  </section>
  @endwhile
@endsection




