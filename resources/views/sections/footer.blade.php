@php
    $class = 'bg-white';
    $class1 = 'bg-color7';
@endphp

<footer class="footer relative overflow-hidden bg-color5 border-t border-colorObramowanie transition-all duration-500 ease-in-out dark:bg-black">

    <div class="container relative z-10 py-60">
        <div class="grid grid-cols-4">
            <div class="col-span-1 text-base leading-[48px] text-color7 dark:text-colorContrast font-medium">
                <div class="flex flex-col">
                    <a class="brand flex mb-8" href="{{ home_url('/') }}">
                        @svg('images.logo', 'h-10 flex w-auto')
                    </a>
                    <a class="transition-all duration-500 ease-in-out hover:text-color3 hover:underline dark:!text-colorContrast" href="/polityka-prywatnosci">Polityka Prywatności</a>
                    <p>Copyright © 2023 UM Szczecin</p>
                    <p class="max-lg:hidden">&nbsp;</p>
                    <p>{{ pll__('Realizacja:') }}<a class="transition-all duration-500 ease-in-out hover:text-color3 hover:underline dark:!text-colorContrast" target="_blank" href="http://gregormedia.com.pl/"> gregormedia.com.pl</a></p>
                </div>
            </div>
            <div class="col-span-1 max-lg:hidden">

            </div>
            <div class="col-span-1">
                <div class="text-desc title text-color2 dark:text-colorContrast mb-10 font-bold">
                    <p>Miejskie serwisy</p>
                </div>
                <div class="text-base leading-[48px] text-color7 dark:text-colorContrast font-medium">
                    <ul>
                        <li>
                            <a class="transition-all duration-500 ease-in-out hover:text-color3 hover:underline dark:!text-colorContrast" href="">Oficjalny Portal Miasta Szczecin</a>
                        </li>
                        <li>
                            <a class="transition-all duration-500 ease-in-out hover:text-color3 hover:underline dark:!text-colorContrast" href="">Kalendarz wydarzeń Miasta Szczecin</a>
                        </li>
                        <li>
                            <a class="transition-all duration-500 ease-in-out hover:text-color3 hover:underline dark:!text-colorContrast" href="">Deklaracja dostępności</a>
                        </li>
                        <li>
                            <a class="transition-all duration-500 ease-in-out hover:text-color3 hover:underline dark:!text-colorContrast" href="">Visit Szczecin</a>
                        </li>
                    </ul>
                </div>
                
            </div>
            <div class="col-span-1">
                <div class="text-desc title text-color2 dark:text-colorContrast mb-10 font-bold">
                    <p>Kontakt</p>
                </div>
                <div class="text-base leading-[48px] text-color7 dark:text-colorContrast font-medium">
                    <ul>
                        <li>
                            <p>Żegluga Szczecińska</p>
                        </li>
                        <li>
                            <p>Turystyka Wydarzenia Sp. z o.o.</p>
                        </li>
                        <li>
                            <p>ul. Tadeusza Wendy 8</p>
                        </li>
                        <li>
                            <p>70-655 Szczecin, Polska</p>
                        </li>
                        <li>
                            <a class="transition-all duration-500 ease-in-out hover:text-color3 hover:underline dark:!text-colorContrast" href="www.zstw.szczecin.pl">www.zstw.szczecin.pl</a>
                        </li>
                    </ul>
                </div>
                
            </div>
        </div>
        @if (has_nav_menu('footer_navigation'))
          <nav class="nav-footer relative pb-half-mobile lg:pb-half after:content-[''] after:absolute after:bg-color6 after:w-full after:h-px after:bottom-0" aria-label="{{ wp_get_nav_menu_name('footer_navigation') }}">
            {!! wp_nav_menu(['theme_location' => 'footer_navigation', 'menu_class' => 'flex-col lg:flex-row nav uppercase text-white justify-center text-menu flex items-center xl:space-x-60 lg:space-x-30 lg:space-y-0 space-y-5', 'echo' => false]) !!}
          </nav>
        @endif  
    </div>
    <div class="container">
        <div class="grid grid-cols-12 gap-5  border-t border-colorObramowanie py-30">
            <div class="3xl:col-span-5 3xl:col-start-3 lg:col-span-6 flex items-center">
                <div class="text-desc text-color6 dark:text-colorContrast text-right font-normal">
                    <p>Strona internetowa powstała w ramach projektu Szczecin Tours Planner dofinansowanego ze środków UE.</p>
                </div>
            </div>
            <div class="3xl:col-span-3 lg:col-span-6 flex items-center">
                <img src="{{ asset('images/int6a.png')}}" alt="">
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
