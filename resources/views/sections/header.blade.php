@php
// $data = get_field('header', 'option');
@endphp

<header class="banner py-30">
  <div class="container">
    <div class="flex items-center justify-between relative @if (!is_front_page()) after:absolute after:content-[''] after:w-full after:h-px after:left-0 after:-bottom-30 after:bg-color2/30 @endif">
      <a class="max-sm:self-start brand flex w-20 sm:w-[120px] lg:w-auto" href="{{ home_url('/') }}">
        @svg('images.logo')
      </a>
      <div class="max-sm:flex-wrap flex flex-row sm:flex-col sm:space-y-5 lg:space-y-7 justify-end">
        @if (has_nav_menu('primary_navigation'))
          <nav class="nav-primary hidden lg:block text-color2" aria-label="{{ wp_get_nav_menu_name('primary_navigation') }}">
            {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav uppercase text-menu flex items-center xl:space-x-60 lg:space-x-30 md:space-x-5', 'echo' => false]) !!}
          </nav>
        @endif
        <div class="grow-[0] mt-5 sm:pb-2.5 lg:hidden w-full flex justify-end">
          <div class="js-button">
            <svg class="sm:w-12" width="40" height="25" viewBox="0 0 40 25" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M40 0H0V5H40V0Z" fill="#080808"/>
              <path d="M40 10H0V15H40V10Z" fill="#080808"/>
              <path d="M40 20H0V25H40V20Z" fill="#080808"/>
            </svg>
          </div>
        </div>  
      </div>
    </div>
  </div>
</header>
