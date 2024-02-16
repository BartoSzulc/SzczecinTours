@php


$kategoria_terms = get_the_terms(get_the_ID(), 'kategoria_wycieczki');
$post_language_slug = pll_get_post_language(get_the_ID(), 'slug');
$post_language_url = pll_get_post_language(get_the_ID(), 'custom_flag_url'); // Get the slug of the post's language
$thumbnail_id = get_post_thumbnail_id();

$content = get_field('tour_description');
$gallery = get_field('tour_gallery');

$buttons = get_field('add_button_tour');


@endphp

<article class="single__content">
  <div class="container">
    <div class="transition-all duration-500 ease-in-out  bg-white dark:bg-black dark:shadow-cien-1 dark:text-colorContrast dark:border dark:border-colorContrast p-5 lg:p-10 max-lg:w-[calc(100%+40px)] max-lg:-left-5 relative rounded-lg mt-60"  data-aos="fade-up">
      <div class="w-full mb-5 lg:mb-10 flex flex-col">
        <a href="{{ pll_home_url() }}" class="btn--grey self-center lg:self-end lg:-mt-10 relative -mt-5 -translate-y-1/2">
          {{ pll__('Wróć do listy') }}
        </a>
        <div class="text-h4 lg:text-h3 font-bold"  data-aos="fade-up">
          <h1>{{ the_title()}}</h1>
        </div>
      </div>
      <div class="grid grid-cols-12 gap-5 2xl:gap-10 mb-10">
        <div class="3xl:col-span-8 lg:col-span-7 col-span-full">
          <div class="swiper singleSwiper h-full">
            <div class="swiper-wrapper">
              @if ( has_post_thumbnail() ) 
              <div class="swiper-slide">
              
                <a class="glightbox" href="{{ wp_get_attachment_image_url($thumbnail_id, 'full') }}">
                    {!! wp_get_attachment_image($thumbnail_id, 'full', false, array('class' => 'w-full h-full object-cover object-center rounded-lg', 'loading' => 'lazy')); !!}
                </a>
                
              </div>
              @endif
              @if (!empty($gallery))
                @foreach ($gallery as $image)
                <div class="swiper-slide">
                  @if (!empty($image['url']))
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
        <div class="3xl:col-span-4 lg:col-span-5 col-span-full">
          <div class="bg-color4 dark:bg-black flex flex-col gap-10 p-10 rounded-lg h-full dark:border dark:border-colorContrast">
            <div class="post-info w-full flex flex-col gap-10 ">
              <div class="post-title text-h5 lg:text-h4 text-color6 dark:text-colorContrast">
                <h2>{{ pll__('Szczegółowe informacje') }}</h2>
              </div>
              <div class="post-language flex gap-5 items-center">
                <img src="{{ $post_language_url }}" title="{{ $post_language_slug }}" alt="{{ $post_language_slug }}">
                @if (get_field('tour_language'))
                <p>{{ get_field('tour_language') }}</p>
                @endif
              </div>
              @if(get_field('tour_date'))
              <div class="post-date flex gap-5 items-center">
                  <div class="icon">
                    @svg('images.kalendarz', 'w-30 h-30')
                  </div>
                  <p>{{ date('d.m.Y', strtotime(get_post_meta(get_the_ID(), 'tour_date', true))) }}</p>
              </div>
              @endif
              @if(get_field('tour_time'))
              <div class="post-time flex gap-5 items-center">
                  <div class="icon">
                    @svg('images.godzina', 'w-30 h-30')
                  </div>
                  <p>{{ pll__('Wejście:') }} {{ get_field('tour_time') }}</p>
              </div>
              @endif
              @if(get_field('tour_duration'))
              <div class="post-time flex gap-5 items-center">
                <div class="icon">
                  @svg('images.godzina', 'w-30 h-30')
                </div>
                <p>{{ pll__('Czas trwania:') }} {{ get_field('tour_duration') }}</p>
              </div>
              @endif
              @if(get_field('tour_location'))
              <div class="post-location flex gap-5 items-center">
                <div class="icon">
                  @svg('images.enter', 'w-30 h-30  basis-30 min-w-30 min-h-30 grow-0')
                </div>
                @if (get_field('tour_location_link'))
                <a href="{{ get_field('tour_location_link') }}" target="_blank" class="underline transition-all duration-500 ease-in-out hover:text-color3" rel="noopener noreferrer">{{ get_field('tour_location') }}</a>
                @else
                <p>{{ get_field('tour_location') }}</p>
                @endif
              </div>
              @endif
              @if(get_field('tour_price'))
              <div class="post-price flex gap-5 items-center">
                  <div class="icon">
                    @svg('images.koszt', 'w-30 h-30')
                  </div>
                  <p>{{get_field('tour_price')}}</p>
              </div>
              @endif
              
              
            </div>
            <div class="post-permalink flex items-center mt-auto gap-5 max-xl:flex-wrap justify-between">
                
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

                          <div class="icon">
                            {!! file_get_contents($url) !!}
                          </div>
                          @else
                              <img src="{{ $url }}" alt="{{ $term->name }}">
                          @endif
                      @endif
             
                  @endforeach
              @endif
              @if ($buttons)
              <div class="buttons flex flex-col gap-2.5 grow">
                @foreach ($buttons as $button)
                  @php
                    $tour_button_version = $button['tour_button_version'];
                    $tour_paid = $button['tour_paid'];
                    $tour_free = $button['tour_free'];
                    $tour_tip = $button['tour_tip'];
                  @endphp
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
                @endforeach
                
              </div>
              @endif
            </div>
          </div>
        </div>
      </div>
      @php ($builder = get_field('flexeditor')) @endphp
      @if(!empty($builder))
      <div class="flex flex-col gap-5 after:relative relative after:content-[''] after:w-full after:h-px  after:mt-10 after:bottom-0 after:bg-color2/30 " >
        <div class="text-h5 lg:text-h4 font-bold mb-5" data-aos="fade-up">
          <h2>{{ pll__('Więcej informacji') }}</h2>
        </div>
        <div class="builder flex flex-col gap-5 lg:gap-10">
          @foreach ($builder as $section)
          @php
            $data = $section['acf_fc_layout'];
            $wysiwyg = $section['content'];
          @endphp

          @if($data == 'wysiwyg')
          <div class="wysiwyg">
              {!! $wysiwyg !!}
          </div>
          @endif

          @if($data == 'big-text')
          <div class="lg:text-desc text-base text-color2 dark:text-colorContrast">
              {!! $wysiwyg !!}
          </div>
          @endif

          @if($data == 'small-text')
          <div class="text-base text-color7 dark:text-colorContrast">
              {!! $wysiwyg !!}
          </div>
          @endif

         {{-- @dump($section) --}}
        @endforeach
        </div>
       
        
      </div>
      @endif
      @include('partials.post.diff-date-post')
      @include('partials.post.diff-language-post')
      
    </div>
  </div>
 
  @include('partials.recent-products')
</article>