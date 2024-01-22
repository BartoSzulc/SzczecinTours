
@php
    $class = 'bg-white';
    $class1 = 'bg-color7';
@endphp

<footer class="footer relative overflow-hidden">
    <div class="pointer-events-none  @if (is_page_template('template-serwis.blade.php') || (is_singular('realizacje')) || (is_archive('realizacje')))  {{ $class1 }} @else {{ $class }} @endif absolute triangle__right -top-px -right-px h-20 w-20 lg:w-[160px] lg:h-[160px] z-10"></div>
    <div class="footer_bg--bg absolute bottom-0 w-full h-full bg-color1 flex">
        <img class="mix-blend-luminosity object-bottom object-cover w-full opacity-40" src="{{ asset('images/footer-bg.jpeg') }}" alt="">
    </div>
    <div class="container relative z-10">
        <div class="flex items-center justify-center sm:py-half-mobile lg:py-half">
            <a class="brand max-sm:self-start flex w-20 sm:w-[120px] lg:w-auto" href="{{ home_url('/') }}">
                @svg('images.logo-footer')
            </a>
        </div>
        @if (has_nav_menu('footer_navigation'))
          <nav class="nav-footer relative pb-half-mobile lg:pb-half after:content-[''] after:absolute after:bg-color6 after:w-full after:h-px after:bottom-0" aria-label="{{ wp_get_nav_menu_name('footer_navigation') }}">
            {!! wp_nav_menu(['theme_location' => 'footer_navigation', 'menu_class' => 'flex-col lg:flex-row nav uppercase text-white justify-center text-menu flex items-center xl:space-x-60 lg:space-x-30 lg:space-y-0 space-y-5', 'echo' => false]) !!}
          </nav>
        @endif
        <div class="flex flex-col max-sm:text-center sm:flex-row space-y-5 sm:space-y-0 items-center justify-between text-white py-half-mobile lg:py-half">
            <div class="text-base">
                <p>{{ pll__('Wszelkie prawa zastrzeżone © 2024') }} <span class="text-color6"> {{ pll__('BRIKOL') }}</span></p>
            </div>
            <div class="text-base">
                <p>{{ pll__('Realizacja:') }}<a class="text-color6 transition-colors duration-500 hover:text-color4" target="_blank" href="http://gregormedia.com.pl/"> gregormedia.com.pl</a></p>
            </div>
        </div>
    </div>
</footer>
<aside class="absolute -translate-y-full mobile-menu flex flex-col p-5  after:content-[''] after:absolute after:bg-color2 after:w-full after:h-1 after:top-0 after:left-0">
    <div class="js-button flex items-center justify-end mb-5">
        <svg class="sm:w-12" width="32" height="33" viewBox="0 0 32 33" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M28.378 0.590241L0.09375 28.8745L3.62928 32.41L31.9136 4.12577L28.378 0.590241Z" fill="#080808"/>
            <path d="M31.8233 29.2843L3.53906 1L0.00352865 4.53553L28.2878 32.8198L31.8233 29.2843Z" fill="#080808"/>
        </svg>
      </div>
    @if (has_nav_menu('primary_navigation'))
    <nav class="nav-primary grow" aria-label="{{ wp_get_nav_menu_name('primary_navigation') }}">
      {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'container_class' => 'flex h-full w-full', 'menu_class' => 'w-full h-1/2 nav uppercase text-menu flex justify-between flex-col items-center space-y-5', 'echo' => false]) !!}
    </nav>
    @endif
</aside>
