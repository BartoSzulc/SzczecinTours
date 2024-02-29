@php
$thumbnail_id = get_post_thumbnail_id();
$kategoria_terms = get_the_terms(get_the_ID(), 'kategoria_wycieczki');
$post_language_slug = pll_get_post_language(get_the_ID(), 'slug');
$post_language_url = pll_get_post_language(get_the_ID(), 'custom_flag_url'); // Get the slug of the post's language

@endphp

<div class="post bg-white h-full rounded-lg transition-all duration-500 ease-in-out dark:bg-black dark:border dark:border-colorContrast " data-aos="fade-up">
    <div class="post-image">
        @if ( has_post_thumbnail() ) 
        <a href="{{ get_permalink() }}">
            {!! wp_get_attachment_image($thumbnail_id, 'full', false, array('class' => 'object-cover object-center mx-auto', 'loading' => 'lazy')); !!}
        </a>
        @endif
    </div>
    <div class="post-content grow">
        <div class="post-info  w-full">
            <div class="post-date flex md:gap-2.5 gap-1 items-center">
                @svg('images.kalendarz')
                <p>{{ date('d.m.Y', strtotime(get_post_meta(get_the_ID(), 'tour_date', true))) }}</p>
               
            </div>
            <div class="post-time flex md:gap-2.5 gap-1 items-center">
                @svg('images.godzina')
                <p>{{get_field('tour_time')}}</p>
            </div>
            <div class="post-price flex md:gap-2.5 gap-1 items-center">
                @svg('images.koszt')
                <p>{{get_field('tour_price')}}</p>
            </div>
            <div class="post-language  flex md:gap-2.5 gap-1 items-center">
                <img class=" text-color1" src="{{ $post_language_url }}" title="{{ $post_language_slug }}" alt="{{ $post_language_slug }}">
                @if (get_field('tour_language'))
                <div class="tour_language_grid">
                    <p class="text-xs max-[992px]:hidden">{{ get_field('tour_language') }}</p>
                </div>
                @endif
            </div>
            
        </div>
        <div class="post-desc flex flex-col grow">
            <div class="post-title text-color6  transition-all duration-500 ease-in-out dark:text-colorContrast">
                <a href="{{ get_permalink() }}">
                    <h2>{!! get_the_title() !!}</h2>
                </a>
            </div>
            <div class="post-excerpt text-base mt-5">
                @if (has_excerpt())
                    {!! get_the_excerpt() !!}
                @else
                    @if (get_field('tour_location_link'))
                    <a href="{{ get_field('tour_location_link') }}" target="_blank" class="underline transition-all duration-500 ease-in-out hover:text-color3" rel="noopene r noreferrer">
                        @if(get_field('tour_location'))
                        <div class="post-location flex md:gap-2.5 gap-1 items-center">
                            <div class="icon flex">
                            @svg('images.enter', '')
                            </div>
                            <p>{{ get_field('tour_location') }}</p>
                        </div>
                        @endif
                    </a>
                    @else
                        @if(get_field('tour_location'))
                        <div class="post-location flex md:gap-2.5 gap-1 items-center">
                            <div class="icon flex">
                            @svg('images.enter', '')
                            </div>
                            <p>{{ get_field('tour_location') }}</p>
                        </div>
                        @endif
                    @endif
                @endif
            </div>
            <div class="post-permalink">
                
                @if ($kategoria_terms && is_array($kategoria_terms))
                    @foreach($kategoria_terms as $term)
                        @php
                            $categoryImage = get_field('category_image', $term);
                        @endphp
                        @if($categoryImage)
                            @php
                            $url = $categoryImage['url'];
                            $ext = pathinfo($url, PATHINFO_EXTENSION);
                            @endphp
                            @if ($ext == 'svg')

                            {!! file_get_contents($url) !!}
                            @else
                                <img src="{{ $url }}" alt="{{ $term->name }}">
                            @endif
                        @endif
               
                    @endforeach
                @endif
                <a href="{{ get_permalink() }}" class="btn btn--primary uppercase"><span>{{ pll__('Zobacz więcej') }}</span></a>
            </div>
        </div>
    </div>
</div>  



