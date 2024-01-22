@php

$data = get_field('offer');
$title = $data['title'] ?? null;
$content = $data['content'] ?? null;
$elements = $data['elements'] ?? null;
$button_version_m = $data['button_version'] ?? null;
$button_link_m = $data['button_link'] ?? null;

@endphp
@if (!empty($data))
<section class="home__offer bg-color7 py-half lg:py-full relative overflow-hidden">
    <div class="pointer-events-none bg-white absolute triangle__right -top-px -right-px h-20 w-20 lg:w-[160px] lg:h-[160px] z-10"></div>

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
        <div class="grid grid-cols-12 gap-5">
            @if (!empty($elements))
            <div class="col-span-full lg:col-span-6">
                {{-- kategoria relacja acf --}}
                
                @php
                    $firstElement = $elements[0] ?? null;
                    $image_0 = $firstElement['image'] ?? null;
                    $title_0 = $firstElement['title'] ?? null;
                    $content_0 = $firstElement['content'] ?? null;
                    $button_version_0 = $firstElement['button_version'] ?? null;
                    $button_link_0 = $firstElement['button_link'] ?? null;
                @endphp
                <div class="bg-white w-full h-full relative flex flex-col">
                    <div class="absolute triangle -right-px -top-px z-10 w-60 h-60 lg:w-[calc((115/790)*100%)] lg:h-[120px] bg-color7">
                        
                    </div>
                    <div class="lg:p-half p-half-mobile flex flex-col relative z-10">
                        @if (!empty($title_0))
                        <div class="text-h4 lg:text-h2 mb-half-mobile lg:mb-half"  data-aos="fade-up">
                            {!! $title_0 !!}
                        </div>
                        @endif
                        @if (!empty($content_0))
                        <div class="text-xs lg:text-base text-color6"  data-aos="fade-up">
                            {!! $content_0 !!}
                        </div>
                        @endif
                        @if (!empty($button_link_0))
                        <div class="lg:mt-auto lg:pt-half mt-half-mobile"  data-aos="fade-up">
                            @if ($button_version_0 == 'v1')
                            <a class="btn btn--primary" href="{{ $button_link_0['url'] }}"><span>{{ $button_link_0['title'] }}</span></a>
                            @else
                            <a class="btn btn--secondary" href="{{ $button_link_0['url'] }}"><span>{{ $button_link_0['title'] }}</span></a>
                            @endif
                        </div>
                        @endif
                    </div>
                    @if (!empty($image_0))
                    <img class="w-full h-[150px] lg:h-[400px] object-center mt-auto block object-cover" src="{{ $image_0['url'] }}" alt="">
                    @endif
                </div>
                
            </div>
            @endif
            @if (!empty($elements))
            <div class="col-span-full lg:col-span-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    @foreach (array_slice($elements, 1) as $element)
                    @php
                        $image = $element['image'] ?? null;
                        $title = $element['title'] ?? null;
                        $content = $element['content'] ?? null;
                        $button_version = $element['button_version'] ?? null;
                        $button_link = $element['button_link'] ?? null;
                    @endphp
                    <div class="col-span-1">
                        <div class="bg-white w-full h-full relative  flex flex-col">
                            <div class="absolute triangle -right-px -top-px z-10 w-60 h-60 lg:w-[calc((115/385)*100%)] lg:h-[120px] bg-color7">
                            </div>
                            <div class="lg:p-30 p-5 flex flex-col space-y-5 lg:space-y-30 relative z-10" >
                                @if (!empty($title))
                                <div class="text-h4 lg:text-h4"  data-aos="fade-up">
                                    {!! $title !!}
                                </div>
                                @endif
                                @if (!empty($content))
                                <div class="text-xs lg:text-base text-color6"  data-aos="fade-up">
                                    {!! $content !!}
                                </div>
                                @endif
                                @if (!empty($button_link))
                                <div class="lg:mt-auto"  data-aos="fade-up">
                                    @include('components.button')
                                </div>
                                @endif
                            </div>
                            @if (!empty($image))
                            <img class="h-[150px] lg:h-[134px] w-full object-center object-cover" src="{{ $image['url'] }}" alt="">
                            @endif
                        </div>
                    </div>
                    @endforeach
                    
                </div>
            </div>
            @endif
        </div>
        @if (!empty($button_link_m))
        <div class="w-full flex justify-center mt-half-mobile lg:mt-half">
            @if ($button_version_m == 'v1')
            <a class="btn btn--primary" href="{{ $button_link_m['url'] }}"><span>{{ $button_link_m['title'] }}</span></a>
            @else
            <a class="btn btn--secondary" href="{{ $button_link_m['url'] }}"><span>{{ $button_link_m['title'] }}</span></a>
            @endif
        </div>
        @endif
    </div>
</section>
@endif