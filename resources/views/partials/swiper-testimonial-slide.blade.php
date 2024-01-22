@foreach ($elements as $element)
@php
$content = $element['content'] ?? null;
$image = $element['image'] ?? null;
$name = $element['name'] ?? null;
$position = $element['position'] ?? null;
@endphp
<div class="swiper-slide">
    <div class="bg-white relative p-half-mobile lg:p-half">
        <div class="bg-color7 absolute triangle-right -top-px -right-px w-60 h-60 lg:w-[calc((115/520)*100%)] lg:h-[120px] flex items-start justify-end z-0">
            @svg('images.quote')
        </div>
        <div class="flex flex-col relative z-10">
            <div class="stars"  data-aos="fade-up">
               @svg('images.stars')
            </div>
            @if (!empty($content))
            <div class="text-base lg:text-desc  text-color6 font-normal italic mt-5"  data-aos="fade-up">
                {!! $content !!}
            </div>
            @endif

            <div class="lg:mt-10 mt-5 author flex flex-col lg:flex-row items-center max-lg:space-y-2 lg:space-x-30">
                <div class="left text-center lg:text-left">
                    @if (!empty($name))
                    <div class="text-base lg:text-h6 font-semibold"  data-aos="fade-up">
                        <p>{{$name}}</p>
                    </div>
                    @endif
                    @if (!empty($position))
                    <div class="text-xs lg:text-base text-color6"  data-aos="fade-up">
                        <p>{{$position}}</p>
                    </div>
                    @endif
                </div>
                <div class="middle relative">
                    <div class="w-px h-30 lg:h-60 bg-color6/30"></div>
                </div>
                @if (!empty($image))
                <div class="right"  data-aos="fade-up">
                    <div class="flex ">
                        <img src="{{ $image['url'] }}" alt="{{ $image['alt'] }}" class="max-h-[30px] object-contain ">
                    </div>
                </div>
                @endif
            </div>
        </div>
            
    </div>
</div>
@endforeach