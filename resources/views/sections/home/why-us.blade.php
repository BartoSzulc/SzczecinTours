@php
    
$data = get_field('whyus');
$title = $data['title'] ?? null;
$subtitle = $data['subtitle'] ?? null;
$content = $data['content'] ?? null;
$elements = $data['elements'] ?? null;

$button_version = $data['button_version'] ?? null;
$button_link = $data['button_link'] ?? null;

@endphp

@if (!empty($data))
<section class="home__why-us pt-half lg:pt-full lg:pb-[130px] pb-20 text-white relative">
    <div class="hidden lg:block absolute triangle bg-white right-0 -top-[0.5px] w-[calc((680/1920)*100%)] h-full z-[2]"></div>
    <div class="home__why-us--bg absolute bottom-0 w-full h-full bg-color1 flex z-[1]">
        <img class="mix-blend-luminosity object-bottom object-cover w-full pointer-events-none" src="{{ asset('images/why-us-bg.png') }}" alt="">
    </div>
    <div class="container">
        <div class="grid grid-cols-12 gap-5 relative z-10">
            <div class="lg:col-span-9 col-span-full">
                <div class="flex flex-col space-y-half-mobile lg:space-y-half">
                    @if (!empty($title))
                    <div class="text-h5 md:text-h4 lg:text-h3 text-color4 font-bold"  data-aos="fade-up">
                        {!! $title !!}
                    </div>
                    @endif
                    @if (!empty($subtitle))
                    <div class="text-h5 md:text-h3 lg:text-h2 font-bold"  data-aos="fade-up">
                        {!! $subtitle !!}
                    </div>
                    @endif
                    @if (!empty($content))
                    <div class="text-xs md:text-desc font-medium opacity-70"  data-aos="fade-up">
                        {!! $content !!}
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @if (!empty($elements))
        <div class="grid grid-cols-2 xl:grid-cols-4 gap-5 relative z-10 mt-half-mobile lg:mt-half">
            @foreach ($elements as $element)
            @php
                $image = $element['image'] ?? null;
                $content = $element['content'] ?? null;
            @endphp
            <div class="col-span-1 flex items-center justify-start space-x-2.5 sm:space-x-5"  data-aos="fade-up">

                @if (!empty($image))
                    <img class="max-sm:h-10 "src="{{ $image['url'] }}" alt="{{ $image['alt'] }}">
                @endif

                @if (!empty($content))
                <div class="text-xs sm:text-base lg:text-desc font-semibold">
                    {!! $content !!}
                </div>
                @endif

            </div>
            @endforeach

        </div>
        @endif
        @if (!empty($button_link))
        <div class="text-color1 absolute bottom-0 left-1/2 -translate-x-1/2 z-50 translate-y-1/2" >
            @include ('components.button')
        </div>
        @endif
    </div>
</section>
@endif



