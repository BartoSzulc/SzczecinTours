<aside class="absolute -translate-x-full mobile-menu flex flex-col px-5 py-3">
    @if (has_nav_menu('primary_navigation'))
      <nav class="nav-primary grow" aria-label="{{ wp_get_nav_menu_name('primary_navigation') }}">
        {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'container_class' => 'flex h-full w-full', 'menu_class' => 'w-full nav uppercase text-xs font-medium sm:text-menu flex justify-center gap-5 items-center', 'echo' => false]) !!}
      </nav>
    @endif
</aside>
