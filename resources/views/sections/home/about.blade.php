@php

$data = get_field('about');
$left = $data['left-col'] ?? null;
$image = $data['image'] ?? null;
$right = $data['right-col'] ?? null;

//left
$title = $left['title'] ?? null;
$subtitle = $left['subtitle'] ?? null;
$content = $left['content'] ?? null;
//right
$right_title = $right['title'] ?? null;
$right_content = $right['content'] ?? null;
$button_version = $right['button_version'] ?? null;
$button_link = $right['button_link'] ?? null;

@endphp
@if (!empty($data))
<section class="home__about lg:py-full py-half">
    <div class="container">
        <div class="grid grid-cols-12 gap-5">
            @if (!empty($left))
            <div class="col-span-full lg:col-span-3" >
                @if (!empty($title))
                <div class="text-h4 lg:text-h2" data-aos="fade-up">
                    {!! $title !!}
                </div>
                @endif
                @if (!empty($subtitle))
                <div class="text-h5 lg:text-h4 py-half-mobile lg:py-half" data-aos="fade-up">
                  {!! $subtitle !!}
                </div>
                @endif
                @if (!empty($content))
                <div class="text-base text-color6" data-aos="fade-up">
                    {!! $content !!}
                </div>
                @endif
            </div>
            @endif
            @if (!empty($image))
            <div class="col-span-full lg:col-span-6 relative flex items-center justify-center" data-aos="fade-up">
                <img class="" src="{{ $image['url'] }}" alt="{{ $image['alt'] }}">
            </div>
            @endif
            @if (!empty($right))
            <div class="col-span-full lg:col-span-3 flex flex-col"> 
                @if (!empty($right_title))
                <div class="text-h5 lg:text-h4 mb-half-mobile lg:mb-half"  data-aos="fade-up">
                    {!! $right_title !!}
                </div>
                @endif
                @if (!empty($right_content))
                <div class="text-base text-color6"  data-aos="fade-up">
                    {!! $right_content !!}
                </div>
                @endif
                @if (!empty($button_link))
                <div class="mt-half-mobile lg:mt-auto flex flex-col items-center justify-center"  data-aos="fade-up">
                    @include('components.button')
                </div>
                @endif
            </div>
            @endif
        </div>
    </div>
</section>
@endif