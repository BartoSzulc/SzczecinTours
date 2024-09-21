<aside class="absolute -translate-x-full mobile-menu gap-3 flex-col px-5 py-3 flex items-center justify-center">

    @if (has_nav_menu('primary_navigation'))
      <nav class="nav-primary grow" aria-label="{{ wp_get_nav_menu_name('primary_navigation') }}">
        {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'container_class' => 'flex h-full w-full', 'menu_class' => 'w-full nav uppercase text-xs font-medium sm:text-menu flex justify-center gap-5 items-center', 'echo' => false]) !!}
      </nav>
    @endif

    <div class="switchers flex items-center sm:gap-5 gap-2 sm:hidden self-end">
      <button class="toggleDarkMode contrast-switcher" title="Toggle Dark Mode"></button>
      <div class="text-base md:text-desc text-color-2 flex font-size-switcher">
        <button class="normal mr-1.5 md:mr-2.5 size-button">A</button>
        <button class="medium mr-1 size-button">A+</button>
        <button class="big size-button">A++</button>
      </div>
    </div>
</aside>
