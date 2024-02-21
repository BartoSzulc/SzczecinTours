@php 
$data = get_field('hero');
@endphp

@if (!empty($data))
<section class="home__hero overflow-hidden text-color5">
    <div class="container relative">
        <div class="swiper heroSwiper">
            <div class="swiper-wrapper">
                @include('partials.swiper-hero-slide')
            </div>
            <div class="heroSwiper__pagination swiper-pagination"></div>
        </div>
    </div>
</section>
@endif