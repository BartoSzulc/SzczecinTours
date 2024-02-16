
@foreach ($data as $element)
@php
    $image = $element['image'] ?? null;
    $title = $element['title'] ?? null;
@endphp
<div class="swiper-slide">
    <div class="flex items-center justify-center relative xl:h-[580px] lg:h-[450px] xl:rounded-[40px] lg:rounded-[20px] rounded-lg h-[250px]">
        @if (!empty($title))
            <div class="text-h4 lg:text-h3 4xl:text-h1 font-extrabold heading relative z-10 text-center">
                {!! $title !!}
            </div>
        @endif
        @if (!empty($image))
        <div class="bg-color6/50 absolute w-full h-full top-0  xl:rounded-[40px] lg:rounded-[20px] rounded-lg mix-blend-luminosity">
            <img class="mix-blend-multiply  xl:rounded-[40px] lg:rounded-[20px] rounded-lg object-cover object-center w-full h-full" src="{{ $image['url'] }}" alt="{{ $image['alt'] }}">
        </div>
        @endif
    </div>
</div>
@endforeach
