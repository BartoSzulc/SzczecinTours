@php
$data = get_field('contact');


$left = $data['left-col'] ?? null;

// left
$title = $left['title'] ?? null;
$subtitle = $left['subtitle'] ?? null;
$description = $left['description'] ?? null;
$nip_regon = $left['nip_regon'] ?? null;
$button_link_l = $left['button_link'] ?? null;
//middle
$map = $data['map'] ?? null;
// right
$right = $data['right-col'] ?? null;
$elements = $right['elements'] ?? null;
$button_link_r = $right['button_link'] ?? null;

@endphp

@if (!empty($data))
<section class="home__contact py-half lg:py-full mt-30" id="kontakt">
    <div class="container">
        <div class="grid grid-cols-12 gap-5">
            <div class="col-span-full lg:col-span-4 flex flex-col">
                @if (!empty($title))
                <div class="text-h4 lg:text-h3 font-bold mb-half-mobile lg:mb-half" data-aos="fade-up">
                    {!! $title !!}
                </div>
                @endif
                <div class="flex flex-col space-y-5" data-aos="fade-up">
                    @if (!empty($subtitle))
                    <div class="text-h5 lg:text-h4 font-bold">
                        {!! $subtitle !!}
                    </div>
                    @endif
                    @if (!empty($description))
                    <div class="text-h6 lg:text-h5 font-semibold">
                        {!! $description !!}
                    </div>
                    @endif
                    @if (!empty($nip_regon))
                    <div class="text-base lg:text-h6 text-color6 font-semibold">
                        {!! $nip_regon !!}
                    </div>
                    @endif
                </div>
                @if (!empty($button_link_l))
                <div class="lg:inline-flex flex max-lg:justify-center items-center mt-auto pt-5" data-aos="fade-up">
                    <a class="btn btn--primary" target="{{ $button_link_l['target'] }}" href="{{ $button_link_l['url'] }}"><span>{{ $button_link_l['title'] }}</span></a>
                </div>
                @endif
            </div>
            @if (!empty($map))
            <div class="col-span-full lg:col-span-4 relative" data-aos="fade-up">
                <div class="absolute triangle triangle-top -right-px -top-px z-10 w-60 h-60 lg:w-[calc((115/520)*100%)] lg:h-[120px] bg-white"></div>
                <iframe class="max-lg:h-[200px]"src="{{$map}}" width="100%" height="460" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                <div class="absolute triangle triangle-bottom -left-px -bottom-px z-10 w-60 h-60 lg:w-[calc((115/520)*100%)] lg:h-[120px] bg-white"></div>
            </div>
            @endif
            
            @if (!empty($elements))
            <div class="col-span-full lg:col-span-3 lg:col-start-10 flex flex-col justify-end">
                <div class="flex flex-col space-y-5 lg:mb-half mb-5">
                    @foreach ($elements as $element)
                    @php
                        $icon = $element['icon'] ?? null;
                        $text = $element['text'] ?? null;
                        $type = $element['type'] ?? null;
                        $prefix = ($type === 'phone') ? 'tel:' : 'mailto:';
                        
                    @endphp
                    <a class="item flex items-center justify-start lg:space-x-30 space-x-5" href="{{$prefix}}{{ removeSpaces($text) }}" data-aos="fade-up">
                        <img src="{{$icon['url']}}" alt="{{$icon['alt']}}">
                        <span>{{$text}}</span>
                    </a>
                    @endforeach
                </div>
                @if (!empty($button_link_r))
                <div class="lg:inline-flex flex max-lg:justify-center max-lg:items-center" data-aos="fade-up">
                    <a class="btn btn--primary" target="{{ $button_link_r['target'] }}" href="{{ $button_link_r['url'] }}"><span>{{ $button_link_r['title'] }}</span></a>
                </div>
                @endif
            </div>
            @endif
        </div>
    </div>
</section>
@endif;