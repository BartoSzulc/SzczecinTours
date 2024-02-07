@php


$kategoria_terms = get_the_terms(get_the_ID(), 'kategoria_wycieczki');
$post_language_slug = pll_get_post_language(get_the_ID(), 'slug');
$post_language_url = pll_get_post_language(get_the_ID(), 'custom_flag_url'); // Get the slug of the post's language


$content = get_field('tour_description');
$gallery = get_field('tour_gallery');


$tour_button_version = get_field('tour_button_version');
$tour_paid = get_field('tour_paid');
$tour_free = get_field('tour_free');
$tour_tip = get_field('tour_tip');

@endphp

<article class="single__content">
  <div class="container">
    <div class="transition-all duration-500 ease-in-out  bg-white dark:bg-black dark:shadow-cien-1 dark:text-colorContrast dark:border dark:border-colorContrast p-5 lg:p-10 max-lg:w-[calc(100%+40px)] max-lg:-left-5 relative rounded-lg mt-60"  data-aos="fade-up">
      <div class="w-full mb-5 lg:mb-10 flex flex-col">
        <a href="" class="btn--grey self-center lg:self-end lg:-mt-10 relative -mt-5 -translate-y-1/2">
          {{ pll__('Wróć do listy') }}
        </a>
        <div class="text-h4 lg:text-h3 font-bold"  data-aos="fade-up">
          <h1>{{ the_title()}}</h1>
        </div>
      </div>
      <div class="grid grid-cols-12 gap-5 lg:gap-10 mb-10">
        <div class="col-span-8">
          <div class="swiper singleSwiper h-full">
            <div class="swiper-wrapper">
              @if ($gallery)
                @foreach ($gallery as $image)
                <div class="swiper-slide">
                  @if ($image)
                  <a href="{{ $image['url'] }}" class="glightbox">
                    <img src="{{ $image['url'] }}" alt="{{ $image['alt'] }}" class="w-full h-full object-cover object-center rounded-lg" loading="lazy">
                  </a>
                  @endif
                </div>
                @endforeach
              @endif
            </div>
            <div class="swiper-pagination"></div>
          </div>
         
        </div>
        <div class="col-span-4">
          <div class="bg-color4 flex flex-col gap-10 p-10 rounded-lg h-full">
            <div class="post-info w-full flex flex-col gap-10 ">
              <div class="post-title text-h5 lg:text-h4 text-color6">
                <h2>{{ pll__('Szczegółowe informacje') }}</h2>
              </div>
              <div class="post-language flex gap-5 items-center">
                <img src="{{ $post_language_url }}" title="{{ $post_language_slug }}" alt="{{ $post_language_slug }}">
                <p>{{ pll__('Wycieczka w polskiej wersji językowej') }}</p>
              </div>
              @if(get_field('tour_date'))
              <div class="post-date flex gap-5 items-center">
                  @svg('images.kalendarz', 'w-30 h-30')
                  <p>{{ date('d.m.Y', strtotime(get_post_meta(get_the_ID(), 'tour_date', true))) }}</p>
              </div>
              @endif
              @if(get_field('tour_time'))
              <div class="post-time flex gap-5 items-center">
                  @svg('images.godzina', 'w-30 h-30')
                  <p>{{ pll__('Wejście:') }} {{ get_field('tour_time') }}</p>
              </div>
              @endif
              @if(get_field('tour_duration'))
              <div class="post-time flex gap-5 items-center">
                @svg('images.godzina', 'w-30 h-30')
                <p>{{ pll__('Czas trwania:') }} {{ get_field('tour_duration') }}</p>
              </div>
              @endif
              @if(get_field('tour_location'))
              <div class="post-location flex gap-5 items-center">
                @svg('images.enter', 'w-30 h-30')
                <p>{{ get_field('tour_location') }}</p>
              </div>
              @endif
              @if(get_field('tour_persons'))
              <div class="post-persons flex gap-5 items-center">
                @svg('images.osob', 'w-30 h-30')
                <p>{{ get_field('tour_persons') }}</p>
              </div>
              @endif
              {{-- @if(get_field('tour_price'))
              <div class="post-price flex gap-5 items-center">
                  @svg('images.koszt')
                  <p>{{get_field('tour_price')}}</p>
              </div>
              @endif --}}
              
              
            </div>
            <div class="post-permalink flex items-center mt-auto gap-5">
                
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
              @switch($tour_button_version)
                @case('v1')
                 <a @if($tour_paid['tour_link']) href="{{ $tour_paid['tour_link'] }}" @else disabled @endif class="btn btn--primary grow">
                  @if(isset($tour_paid['tour_text']))
                    <span> {{ $tour_paid['tour_text']}}</span>
                  @endif
                 </a>
                @break

                @case('v2')
                 <a @if($tour_free['tour_link']) href="{{ $tour_free['tour_link'] }}"@else disabled @endif class="btn btn--secondary grow">
                  @if(isset($tour_free['tour_text']))
                   <span> {{ $tour_free['tour_text']}}</span>
                  @endif
                 </a>
                @break

                @case('v3')
                 <a @if($tour_tip['tour_link']) href="{{ $tour_top['tour_link'] }}"@else disabled @endif class="btn btn--primary grow">
                  @if(isset($tour_tip['tour_text']))
                    <span>{{ $tour_tip['tour_text']}}</span>
                  @endif
                 </a>
                @break

                @default
              @endswitch
            </div>
          </div>
        </div>
      </div>
      <div class="flex flex-col gap-5" >
        <div class="text-h5 lg:text-h4 font-bold mb-5" data-aos="fade-up">
          <h2>{{ pll__('Więcej informacji') }}</h2>
        </div>
        @if ($content)
        {!! $content !!}
        @endif
      </div>
    </div>
  </div>
</article>