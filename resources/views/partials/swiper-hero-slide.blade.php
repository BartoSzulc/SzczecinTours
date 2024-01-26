
@foreach ($data as $element)
@php
    $image = $element['image'] ?? null;
    $title = $element['title'] ?? null;
@endphp
<div class="swiper-slide">
    <div class="flex items-center justify-center relative h-[580px] rounded-[40px]">
        @if (!empty($title))
            <div class="text-h3 4xl:text-h1 font-extrabold heading relative z-10">
                {!! $title !!}
            </div>
        @endif
        @if (!empty($image))
        <div class="bg-color6/50 absolute w-full h-full top-0 rounded-[40px] mix-blend-luminosity">
            <img class="mix-blend-multiply rounded-[40px] object-cover object-center w-full h-full" src="{{ $image['url'] }}" alt="{{ $image['alt'] }}">
        </div>
        @endif
    </div>
</div>
@endforeach
