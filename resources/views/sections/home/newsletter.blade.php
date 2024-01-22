@php
$data = get_field('newsletter');

$title = $data['title'] ?? null;
$content = $data['content'] ?? null;
$shortcode = $data['shortcode'] ?? null;
@endphp

@if (!empty($data))
<section class="home__newsletter text-white bg-color7 relative">
    <div class="pointer-events-none bg-white absolute triangle__left bottom-0 left-0 h-20 w-20 lg:w-[160px] lg:h-[160px] z-0"></div>
    <div class="pointer-events-none bg-white absolute triangle__right bottom-0 right-0 h-20 w-20 lg:w-[160px] lg:h-[160px] z-0"></div>
    <div class="container">
        <div class="inside w-full py-half lg:py-full text-center relative">
            <div class="footer_bg--bg absolute bottom-0 w-[calc(100%+40px)] max-lg:-left-5 lg:w-full h-full bg-color1 flex">
                <img class="mix-blend-luminosity object-center object-cover w-full opacity-40" src="{{ asset('images/news-bg.jpeg') }}" alt="">
            </div>
            <div class="inside__content relative z-10">
                @if (!empty($title))
                <div class="text-h3 lg:text-h2 2xl:text-h1 mb-half" data-aos="fade-up">
                    {!! $title !!}
                </div>
                @endif
                @if (!empty($content))
                <div class="text-base lg:text-desc font-semibold mb-half" data-aos="fade-up">
                   {!! $content !!}
                </div>
                @endif
                @if (!empty($shortcode))
                    {!! do_shortcode($shortcode) !!}
                @endif
            </div>
        </div>
    </div>
</section>
@endif