
@foreach ($data as $element)
@php
    $image = $element['image'] ?? null;
    $title = $element['title'] ?? null;
    $content = $element['content'] ?? null;
    $buttons = $element['buttons'] ?? null;
@endphp
<div class="swiper-slide" data-aos="fade-up">
    <div class="row lg:grid flex flex-col lg:grid-cols-12 gap-5 grid-flow-col relative bg-white h-auto lg:min-h-[400px] 4xl:min-h-[600px]">
        <div class="col-span-4 flex flex-col items-start justify-center relative z-10">
            @if (!empty($image))
            <div class="text-h3 4xl:text-h1 4xl:mt-full mt-5 font-extrabold heading">
                {!! $title !!}
            </div>
            @endif
            @if (!empty($content))
            <div class="text-base lg:text-base 4xl:text-desc text-color6 mt-5 lg:mt-10"> 
                {!! $content !!}
                
            </div>
            @endif
            @if (!empty($buttons))
            <div class="buttons flex flex-col space-y-5 sm:space-y-0 mt-5 sm:flex-row lg:mt-auto lg:pt-5">
                @foreach ($buttons as $button)
                    @php 
                        $button_version = $button['button_version'] ?? null;
                        $button_link = $button['button_link'] ?? null;
                    @endphp
                @include('components.button')
                @endforeach
            </div>
            @endif
        </div>
        @if (!empty($image))
        <div class="col-span-9 hidden lg:block">

            <div class="triangle w-[calc((513.33/1600)*100%)] h-[600px] absolute -bottom-px bg-white z-[2] 
            left-[calc((400/1600)*100%)]">
            </div>
            <img class="-right-px  absolute w-[calc((1200/1600)*100%)] -bottom-0.5 lg:min-h-[400px] 4xl:min-h-[600px] object-cover object-right " src="{{ $image['url'] }}" alt="">

        </div>
        @endif
        <img class="lg:hidden" src="{{asset('images/hero-image-mobile-1.png')}}" alt="">
        
    </div>
</div>
@endforeach
