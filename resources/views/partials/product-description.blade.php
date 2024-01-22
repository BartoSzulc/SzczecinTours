@php
    $elements = get_field('elements');
@endphp

<div class="bg-white p-half-mobile lg:p-half pt-0 lg:pt-0 flex flex-col space-y-half-mobile lg:space-y-half product-description max-lg:w-[calc(100%+40px)] max-lg:-left-5 relative">
   
        @foreach ($elements as $element)
        @php
            $heading = $element['heading'];
            $content = $element['content'];
        @endphp
        <div class="flex flex-col space-y-half-mobile lg:space-y-half">
            @if (!empty($heading))
                <div class="text-h5 lg:text-h4 font-bold"  data-aos="fade-up">
                    <h2>{{ $heading }}</h2>
                </div>
            @endif
            @if (!empty($content))
                <div class="text-xs md:text-base lg:text-desc text-color6"  data-aos="fade-up">
                    {!! $content !!}
                </div>
            @endif
        </div>
        @endforeach
        @include ('partials.product-form')
</div>

