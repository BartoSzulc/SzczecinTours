@php

$data = $product_simple;
$elements = $data['elements'] ?? null;
$image = $elements['image'] ?? null;    
$price = $elements['price'] ?? null;

@endphp
<div class="bg-white p-half-mobile lg:p-half max-lg:w-[calc(100%+40px)] max-lg:-left-5 relative">
    <div class="text-h4 lg:text-h2 font-bold mb-half-mobile lg:mb-half"  data-aos="fade-up">
        <h2>{{ $title }}</h2>
    </div>
    <div class="text-xs md:text-base lg:text-desc text-color6 mb-half-mobile lg:mb-half"  data-aos="fade-up">
        <p>{{ the_content() }}</p>
    </div>
    <div class="swiper productSwiper" data-aos="fade-up">
        <div class="swiper-wrapper">
            <div class="swiper-slide w-full" data-slide="0">
                @if (!empty($image))
                <img src="{{ $image['url'] }}" alt="{{ $image['alt'] }}">
                @else
                <img src="{{ get_the_post_thumbnail_url() }}" alt="">
                @endif
            </div>
        </div>
    </div>
    <div class="order flex flex-col lg:flex-row items-center justify-center lg:justify-between bg-color7 px-30 py-30 mt-half-mobile lg:mt-half"  data-aos="fade-up">
        <div class="left text-desc lg:text-h4 font-bold">
            <p>{{ pll__('Sprawdź cenę i zamów') }}</p>
        </div>
        <div class="right items-center flex gap-5 flex-wrap justify-center lg:justify-between lg:w-[calc((575/1500)*100%)]">
            <div class="flex price gap-5 items-end">
                <div class="text-h6 font-bold">
                   <p>{{ pll__('Cena:')}}</p>
                </div>
                @if (!empty($price))
                <div class="text-desc lg:text-h4 font-bold text-color2">
                    <p id="priceInsert">{{ $price }}<span> {{ pll__('zł') }}</span></p>
                </div>
                @endif
            </div>
            <a href="#form" class="btn btn--primary "><span>{{ pll__('Zapytaj o produkt')}}</span></a>
        </div>
    </div>
</div>