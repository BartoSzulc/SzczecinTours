<div class="flex flex-row items-center sm:gap-5 gap-3 md:gap-30 lg:gap-10 xl:gap-60">
    @if (has_nav_menu('primary_navigation'))
      <nav class="nav-primary hidden lg:block text-color2 dark:text-colorContrast" aria-label="{{ wp_get_nav_menu_name('primary_navigation') }}">
        {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav uppercase text-menu flex items-center xl:space-x-60 lg:space-x-30 md:space-x-5', 'echo' => false]) !!}
      </nav>
    @endif
    <div class="switchers flex items-center sm:gap-5 gap-3 max-sm:hidden">
      <button class="toggleDarkMode contrast-switcher" title="Toggle Dark Mode"></button>
      <div class="text-base md:text-desc text-color-2 flex font-size-switcher">
        <button class="normal mr-1.5 md:mr-2.5 size-button">A</button>
        <button class="medium mr-1 size-button">A+</button>
        <button class="big size-button">A++</button>
      </div>
    </div>
    <select id="language-select--header" class="select-custom--header w-fit" aria-label="Language Selection">
      @foreach($languageData as $language)
      <option title="{{$language['name']}}" data-html="{{ $language['slug'] == $currentLanguageSlug ? "<img src='{$language['flag']}'/>" : "<a href='{$language['url']}'><img src='{$language['flag']}'/></a>" }}" value="{{ $language['slug'] }}" {{ $language['slug'] == $currentLanguageSlug ? 'selected' : '' }}>
      </option>
      @endforeach
    </select>
    <div class="int6a max-2xl:-ml-5 max-xl:ml-0 max-lg:order-first"  >
      <img class="max-h-[16px] sm:max-h-[50px] lg:min-w-[200px] max-lg:max-w-[200px]" src="{{ asset('images/int6a.png')}}" alt="">
    </div>
    <div class="grow-[0] lg:hidden lg:w-full flex justify-end">
        <button id="menuButton" class="text-color2 dark:text-colorContrast w-5 h-5 relative focus:outline-none  js-button">
            <span class="sr-only">Open main menu</span>
            <div class="block w-5 absolute left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2">
                <span aria-hidden="true" class="menu-line block absolute h-0.5 w-5 bg-current transform transition duration-500 ease-in-out -translate-y-1.5 rounded-full"></span>
                <span aria-hidden="true" class="menu-line block absolute h-0.5 w-5 bg-current transform transition duration-500 ease-in-out rounded-full"></span>
                <span aria-hidden="true" class="menu-line block absolute h-0.5 w-5 bg-current transform transition duration-500 ease-in-out translate-y-1.5 rounded-full"></span>
            </div>
        </button>
    </div>  
</div>