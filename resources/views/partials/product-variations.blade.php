@php

$data = $product_variations;
$price_default = $data['price_default'] ?? null;
$configurator_name = $data['configurator_name'] ?? null;
$elements = $data['elements'] ?? null;
$show_additional = $data['show_additional'] ?? null;
$additional_name = $data['additional_name'] ?? null;
$elements_additional = $data['elements_additional'] ?? null;

@endphp

<div class="bg-white p-half-mobile lg:p-half max-lg:w-[calc(100%+40px)] max-lg:-left-5 relative">
    <div class="text-h4 lg:text-h2 font-bold mb-half-mobile lg:mb-half"  data-aos="fade-up">
        <h2>{{ $title }}</h2>
    </div>
    @if (!empty(the_content()))
    <div class="text-xs md:text-base lg:text-desc text-color6 mb-half-mobile lg:mb-half"  data-aos="fade-up">
        <p>{{ the_content() }}</p>
    </div>
    @endif
    @if (!empty($configurator_name))
    <div class="text-h6 lg:text-h4 font-bold my-half-mobile lg:my-half"  data-aos="fade-up">
        <h3>{{ $configurator_name }}</h3>
    </div>
    @endif
    @if (!empty($elements))
    <div class="lg:flex checkboxes grid grid-cols-1 md:grid-cols-2 gap-2 md:gap-5"  data-aos="fade-up">
        @php $i = 1; @endphp
        @foreach ($elements as $element)
            @php
            $name = $element['name'] ?? null;
            @endphp
            <div class="item" data-name="variation-{{ $i }}" data-slide="{{ $i }}" >
                <input type="checkbox" id="variation-{{ $i }}">
                <label class="relative z-10" for="variation-{{ $i }}">{{ $name }}</label>
                <div class="absolute bg-white triangle h-full -top-px -right-px w-60 lg:w-[calc((90/335)*100%)] pointer-events-none"></div>
            </div>
            @php $i++; @endphp
        @endforeach
    </div>
    @endif
    @if ($show_additional)
    <div class="flex additional-checkbox mt-2 md:mt-5"  data-aos="fade-up">
        <div class="item-additional" >
            <input type="checkbox" id="additional-checkbox" data-slide="filtrowymiennik">
            @if (!empty($additional_name))
            <label class="relative z-10" for="additional-checkbox">
                {{ $additional_name }}
            </label>
            @endif
            <div class="absolute bg-white triangle h-full -top-px -right-px w-60 lg:w-[calc((90/335)*100%)] pointer-events-none"></div>
        </div>
    </div>
    @endif
    @if (!empty($elements))
    <div class="swiper productSwiper"  data-aos="fade-up">
        <div class="swiper-wrapper">
            
            <div class="swiper-slide w-full" data-slide="0" data-price="{{ $price_default }}" >
                0
                <img src="{{ get_the_post_thumbnail_url() }}" alt="">
            </div>
            @php $i = 1; @endphp
                @foreach ($elements as $element)
                @php
                $image = $element['image'] ?? null;
                $price = $element['price'] ?? null;
            @endphp
            <div class="swiper-slide w-full" data-slide="{{ $i }}" data-price="{{ $price }}"  >
                {{ $i }}
                <img src="{{ $image['url'] }}" alt="{{ $image['alt'] }}">
            </div>
            @php $i++; @endphp
            @endforeach
            
            @if (!empty($elements_additional))
                @php $j = 1; @endphp
                @foreach ($elements_additional as $element_additional)
                @php
                $image_additional = $element_additional['image'] ?? null;
                $price_additional = $element_additional['price'] ?? null;
                @endphp
                    <div class="swiper-slide w-full" data-slide="filtrowymiennik {{ $j }}" data-price="{{ $price_additional }}">
                        {{ $j }}-filtro
                        <img src="{{ $image_additional['url'] }}" alt="{{ $image_additional['alt'] }}">
                    </div>
                
                @php $j++; @endphp
                @endforeach
            @endif
        </div>
    </div>
    @endif
    <div class="order flex flex-col lg:flex-row items-center justify-center lg:justify-between bg-color7 px-30 py-30 mt-half-mobile lg:mt-half"  data-aos="fade-up">
        <div class="left text-desc lg:text-h4 font-bold" >
            <p>{{ pll__('Sprawdź cenę i zamów')}}</p>
        </div>
        <div class="right items-center flex gap-5 flex-wrap justify-center lg:justify-between lg:w-[calc((575/1500)*100%)]">
            <div class="flex price gap-5 items-end">
                <div class="text-base lg:text-h6 font-bold">
                   <p>{{ pll__('Cena:')}}</p>
                </div>
                @if (!empty($price_default))
                <div class="text-desc lg:text-h4 font-bold text-color2">
                    <p id="priceInsert">
                        {{ $price_default }}<span> {{ pll__('zł') }}</span>
                    </p>
                </div>
                @endif
            </div>
            <a href="#form" class="btn btn--primary "><span>{{ pll__('Zapytaj o produkt')}}</span></a>
        </div>
    </div>
</div>