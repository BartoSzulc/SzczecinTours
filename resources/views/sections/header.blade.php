@php
$data = get_field('header', 'option');
$mail = $data['mail'] ?? null;
$phone = $data['phone'] ?? null;
$linkedin = $data['linkedin'] ?? null;
$facebook = $data['facebook'] ?? null;
$language = $data['language'] ?? null;
@endphp

<header class="banner py-2.5">
  <div class="container">
    <div class="flex items-center justify-between">
      <a class="max-sm:self-start brand flex w-20 sm:w-[120px] lg:w-auto" href="{{ home_url('/') }}">
        @svg('images.logo')
      </a>
      <div class="max-sm:flex-wrap flex flex-row sm:flex-col sm:space-y-5 lg:space-y-7 justify-end">
        @if ($language)
        <ul class="polylang sm:hidden grow-0 w-full flex justify-end mb-2.5">
          @php
            $args = array('show_flags' => 1, 'show_names' => 1, 'hide_current' => true ,'dropdown' => 0, 'display_names_as'=>'slug'); pll_the_languages($args);  
          @endphp
        </ul>
        @endif
        <div class="space-x-2.5 sm:space-x-30 flex items-center justify-end">
          @if (!empty($mail))
          <a href="mailto:{{$mail}}" class="text-base text-color6 flex items-center space-x-2.5 group max-sm:bg-color4  max-sm:p-3 transition-all duration-500 max-sm:hover:bg-color2">
            <svg class="max-sm:h-4 max-sm:w-4" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g clip-path="url(#clip0_3758_523)">
            <path class="transition-all duration-500 sm:group-hover:fill-color2 group-hover:fill-white" fill-rule="evenodd" clip-rule="evenodd" d="M4.2353 5.29427C4.2353 4.90441 4.55133 4.58838 4.94119 4.58838H19.0588C19.4487 4.58838 19.7647 4.90441 19.7647 5.29427L19.765 12.4134L15.9429 16.2355H8.05711L4.2353 12.4136V5.29427ZM7.7647 9.17332C7.7647 9.3701 7.92263 9.52957 8.11791 9.52957H15.8821C16.0771 9.52957 16.2353 9.3731 16.2353 9.17332V8.47408C16.2353 8.2773 16.0774 8.11784 15.8821 8.11784H8.11791C7.92286 8.11784 7.7647 8.2743 7.7647 8.47408V9.17332ZM7.7647 12.7027C7.7647 12.8995 7.92263 13.059 8.11791 13.059H15.8821C16.0771 13.059 16.2353 12.9025 16.2353 12.7027V12.0035C16.2353 11.8067 16.0774 11.6472 15.8821 11.6472H8.11791C7.92286 11.6472 7.7647 11.8037 7.7647 12.0035V12.7027ZM8.47059 3.17665L11.5765 0.847242C11.8275 0.658992 12.1725 0.658992 12.4236 0.847242L15.5295 3.17665H8.47059ZM0.772125 8.95048L2.82352 7.4119V11.0019L0.772125 8.95048ZM21.1765 7.41194L23.2279 8.95052L21.1765 11.0019V7.41194ZM22.8853 23.2943H1.11473L8.0167 17.6472H15.9833L22.8853 23.2943ZM24 10.1749V22.3822L17.286 16.8889L24 10.1749ZM0 22.3822V10.1749L6.71405 16.8889L0 22.3822Z" fill="#080808"/>
            </g>
            <defs>
            <clipPath id="clip0_3758_523">
            <rect width="24" height="24" fill="white"/>
            </clipPath>
            </defs>
            </svg>
            <span class="transition-all duration-500 group-hover:text-color2 hidden sm:block">{{$mail}}</span>
          </a>
          @endif
          @if (!empty($phone))
          <a href="tel:{{ removeSpaces($phone) }}" class="text-base text-color6 flex items-center space-x-2.5 group max-sm:bg-color4 max-sm:p-3  transition-all duration-500 max-sm:hover:bg-color2">
            <svg class="max-sm:h-4 max-sm:w-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
              <g clip-path="url(#clip0_3759_628)">
                <path  class="transition-all duration-500 sm:group-hover:fill-color2 group-hover:fill-white"d="M17.4692 7.41177H13.5836C12.2207 7.41177 11.1163 8.52185 11.1163 9.88537V15.1073C11.1163 16.4412 12.4426 17.0485 13.4536 16.1797L14.6211 15.1765H17.4692V21.8811C17.4692 23.0509 16.5235 24 15.355 24H5.46574C4.29786 24 3.35156 23.0501 3.35156 21.8811V2.11888C3.35156 0.94906 4.29727 0 5.46574 0H5.82215V0.882353C5.82215 1.95479 6.69242 2.82353 7.76565 2.82353H13.0551C14.1278 2.82353 14.9986 1.9537 14.9986 0.882353V0H15.355C16.5229 0 17.4692 0.949939 17.4692 2.11888V7.41177ZM12.7635 15.3767C12.4386 15.6559 12.1751 15.5352 12.1751 15.1073V9.88537C12.1751 9.10588 12.8063 8.47059 13.5836 8.47059H19.2372C20.0163 8.47059 20.6457 9.10617 20.6457 9.88537V12.7029C20.6457 13.4848 20.0165 14.1176 19.232 14.1176H14.2286L12.7635 15.3767ZM17.8222 12C18.212 12 18.528 11.684 18.528 11.2941C18.528 10.9043 18.212 10.5882 17.8222 10.5882C17.4323 10.5882 17.1163 10.9043 17.1163 11.2941C17.1163 11.684 17.4323 12 17.8222 12ZM14.9986 12C15.3885 12 15.7045 11.684 15.7045 11.2941C15.7045 10.9043 15.3885 10.5882 14.9986 10.5882C14.6088 10.5882 14.2927 10.9043 14.2927 11.2941C14.2927 11.684 14.6088 12 14.9986 12ZM7.23392 0H13.5869V0.882353C13.5869 1.17365 13.3485 1.41176 13.0551 1.41176H7.76565C7.47156 1.41176 7.23392 1.17453 7.23392 0.882353V0Z" fill="#080808"/>
              </g>
              <defs>
                <clipPath id="clip0_3759_628">
                  <rect width="24" height="24" fill="white"/>
                </clipPath>
              </defs>
            </svg>
            <span class="transition-all duration-500 group-hover:text-color2 hidden sm:block">{{$phone}}</span>
          </a>
          @endif
          @if ($language)
          <ul class="polylang hidden sm:block">
            @php
              $args = array('show_flags' => 1, 'show_names' => 1, 'hide_current' => true ,'dropdown' => 0, 'display_names_as'=>'slug'); pll_the_languages($args);  
            @endphp
          </ul>
          @endif
        </div>
        <div class="space-x-2.5 md:space-x-5 lg:space-x-30 xl:space-x-60 flex items-center justify-end">
          @if (has_nav_menu('primary_navigation'))
          <nav class="nav-primary hidden lg:block" aria-label="{{ wp_get_nav_menu_name('primary_navigation') }}">
            {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav uppercase text-menu flex items-center xl:space-x-60 lg:space-x-30 md:space-x-5', 'echo' => false]) !!}
          </nav>
         
          @endif
          <div class="socials space-x-2.5 flex items-center justify-center">
            @if (!empty($linkedin))
            <a href="{{ $linkedin }}" class="group bg-color4 max-sm:p-3 p-4 flex items-center justify-center transition-all duration-500 hover:bg-color2">
              <svg  width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0_3739_552)">
                <path class="transition-all duration-500 group-hover:fill-white" d="M1.92306 0.0136719C0.860348 0.0136719 0.000171932 0.875396 0 1.9357C0 2.99704 0.860176 3.85859 1.92323 3.85859C2.98337 3.85859 3.84475 2.99704 3.84475 1.9357C3.84475 0.875224 2.98319 0.0136719 1.92306 0.0136719Z" fill="#080808"/>
                <path class="transition-all duration-500 group-hover:fill-white" d="M0.265625 5.31738H3.58168V15.9865H0.265625V5.31738Z" fill="#080808"/>
                <path class="transition-all duration-500 group-hover:fill-white" d="M12.0186 5.05176C10.4055 5.05176 9.32391 5.93618 8.88118 6.77486H8.83682V5.31705H5.65642H5.65625V15.986H8.96938V10.708C8.96938 9.31653 9.23433 7.96876 10.9595 7.96876C12.6599 7.96876 12.6826 9.56016 12.6826 10.7972V15.9858H15.9962V10.1339C15.9962 7.26143 15.3764 5.05176 12.0186 5.05176Z" fill="#080808"/>
                </g>
                <defs>
                <clipPath id="clip0_3739_552">
                <rect width="16" height="16" fill="white"/>
                </clipPath>
                </defs>
              </svg>
            </a>
            @endif
            @if (!empty($facebook))
            <a href="{{ $facebook }}" class="group bg-color4 max-sm:p-3 p-4 flex items-center justify-center transition-all duration-500 hover:bg-color2">
              <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path class="transition-all duration-500 group-hover:fill-white" d="M11.9965 0.00332907L9.92164 0C7.59065 0 6.08426 1.54552 6.08426 3.93762V5.75313H3.99812C3.81785 5.75313 3.67188 5.89927 3.67188 6.07954V8.71001C3.67188 8.89028 3.81802 9.03625 3.99812 9.03625H6.08426V15.6738C6.08426 15.854 6.23024 16 6.4105 16H9.13232C9.31259 16 9.45857 15.8539 9.45857 15.6738V9.03625H11.8978C12.078 9.03625 12.224 8.89028 12.224 8.71001L12.225 6.07954C12.225 5.99299 12.1905 5.91009 12.1295 5.84884C12.0684 5.78758 11.9851 5.75313 11.8986 5.75313H9.45857V4.2141C9.45857 3.47438 9.63484 3.09886 10.5984 3.09886L11.9961 3.09836C12.1762 3.09836 12.3222 2.95222 12.3222 2.77211V0.329578C12.3222 0.149642 12.1764 0.00366197 11.9965 0.00332907Z" fill="#080808"/>
              </svg>
            </a>
            @endif
          </div>
        </div>
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
