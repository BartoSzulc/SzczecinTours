@php
    
    $data = get_field('seo');
    $title = $data['seo_title'] ?? null;
    $desc = $data['seo_desc'] ?? null;
    $icons = $data['seo_icons'] ?? null;
@endphp

@if ($data)
<section class="home__seo">
    <div class="container">
        @if($title)
        <div class="w-full text-center my-30 lg:my-60 text-color6 dark:text-colorContrast text-h3 lg:text-h2 transition-all duration-500 ease-in-out">
            <h2>{{ $title }}</h2>
        </div>
        @endif
        @if($desc)
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
            @foreach($desc as $item)
            <div class="col-span-1 border border-colorObramowanie p-5 lg:p-10 rounded-lg transition-all duration-500 ease-in-out dark:border-colorContrast">
                <div class="flex flex-col gap-5">
                    @if ($item['title'])
                    <div class="text-h5 font-semibold text-color6 transition-all duration-500 ease-in-out dark:text-colorContrast">
                        <h3>{{ $item['title'] }}</h3>
                    </div>
                    @endif
                    @if ($item['desc'])
                    <div class="text-desc font-normal text-color6 transition-all duration-500 ease-in-out dark:text-colorContrast">
                        {!! $item['desc'] !!}
                    </div>
                    @endif
                </div>
            </div>
            @endforeach

        </div>
        @endif
        @if ($icons)
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 my-30 lg:my-60">
            @foreach($icons as $icon)
            <div class="col-span-1 flex gap-5 lg:gap-10 items-center lg:justify-start justify-center text-center lg:text-left">
                @if($icon['icon'])
                    @php
                    $url = $icon['icon']['url'];
                    $ext = pathinfo($url, PATHINFO_EXTENSION);
                    @endphp
                    @if ($ext == 'svg')

                    {!! file_get_contents($url) !!}
                    @else
                        <img src="{{ $url }}" alt="{{ $icon['icon']['alt'] }}">
                    @endif
                @endif
                @if($icon['desc'])
                <div class="text-h5 text-color2 transition-all duration-500 ease-in-out dark:text-colorContrast">
                    {!! $icon['desc'] !!}
                </div>
                @endif
            </div>
            @endforeach
            
        </div>
        @endif
    </div>
</section>
@endif
