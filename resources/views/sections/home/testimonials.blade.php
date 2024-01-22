@php
    $data = get_field('testimonial');
    $title = $data['title'] ?? null;
    $content = $data['content'] ?? null;
    $elements = $data['elements'] ?? null;
    $button_version = $data['button_version'] ?? null;
    $button_link = $data['button_link'] ?? null;
@endphp

@if (!empty($data))
<section class="home__testimonials bg-color7 pb-half lg:pb-full">
    <div class="container">
        <div class="w-full">
            @if (!empty($title))
            <div class="text-h3 lg:text-h2"  data-aos="fade-up">
                {!! $title !!}
            </div>
            @endif
            @if (!empty($content))
            <div class="text-base lg:text-desc my-half-mobile lg:my-half text-color6"  data-aos="fade-up">
               {!! $content !!}
            </div>
            @endif
        </div>
        @if (!empty($elements))
        <div class="swiper testimonialsSwiper">
            <div class="swiper-wrapper">
               @include('partials.swiper-testimonial-slide')
            </div>
            <div class="grid grid-cols-12 gap-5 mt-half-mobile lg:mt-half">
                <div class="xl:col-start-4 xl:col-span-6 col-span-full lg:col-span-8 lg:col-start-3">
                    <div class="testimonialsSwiper__nav flex items-center justify-center lg:justify-between w-full  lg:space-x-5">

                        <div class="testimonialsSwiper__nav--prev ">
                            @include('partials.swiper-arrow-left')
                        </div>
                        @if (!empty($button_link))
                        <div class="testimonialsSwiper__nav--middle hidden lg:block"  data-aos="fade-up">
                            @include ('components.button')
                        </div>
                        @endif
                        <div class="testimonialsSwiper__nav--next">
                            @include('partials.swiper-arrow-right')
                        </div>
                        
                    </div>
                    @if (!empty($button_link))
                    <div class="testimonialsSwiper__nav--middle lg:hidden flex items-center justify-center mt-half-mobile"  data-aos="fade-up">
                        @include ('components.button')
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @endif
    </div>
</section>
@endif