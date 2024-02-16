@php
    $class = 'bg-white';
    $class1 = 'bg-color7';
@endphp

<footer class="footer relative overflow-hidden bg-color5 border-t border-colorObramowanie transition-all duration-500 ease-in-out dark:bg-black">

    <div class="container relative z-10 py-60">
        <div class="grid xl:grid-cols-4 lg:grid-cols-3 grid-cols-1 gap-5">
            <div class="col-span-1 text-base leading-30 lg:leading-[48px] text-color7 dark:text-colorContrast font-medium">
                <div class="flex flex-col">
                    <a class="brand flex mb-5 lg:mb-8" href="{{ home_url('/') }}">
                        @svg('images.logo', 'h-10 flex w-auto')
                    </a>
                    <a class="transition-all duration-500 ease-in-out hover:text-color3 hover:underline dark:!text-colorContrast" href="/polityka-prywatnosci">Polityka Prywatności</a>
                    <p>Copyright © 2023 UM Szczecin</p>
                    <p class="max-lg:hidden">&nbsp;</p>
                    <p>{{ pll__('Realizacja:') }}<a class="transition-all duration-500 ease-in-out hover:text-color3 hover:underline dark:!text-colorContrast" target="_blank" href="http://gregormedia.com.pl/"> gregormedia.com.pl</a></p>
                </div>
            </div>
            <div class="col-span-1 hidden xl:block">

            </div>
            <div class="col-span-1">
                <div class="text-desc title text-color2 dark:text-colorContrast mb-5 lg:mb-10 font-bold">
                    <p>Miejskie serwisy</p>
                </div>
                <div class="text-base leading-30 lg:leading-[48px] text-color7 dark:text-colorContrast font-medium">
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
                <div class="text-desc title text-color2 dark:text-colorContrast mb-5 lg:mb-10 font-bold">
                    <p>Kontakt</p>
                </div>
                <div class="text-base leading-30 lg:leading-[48px] text-color7 dark:text-colorContrast font-medium">
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
            <div class="3xl:col-span-5 3xl:col-start-3 lg:col-span-6 flex items-center col-span-full">
                <div class="text-sm lg:text-desc text-color6 dark:text-colorContrast lg:text-right font-normal text-center">
                    <p>Strona internetowa powstała w ramach projektu Szczecin Tours Planner dofinansowanego ze środków UE.</p>
                </div>
            </div>
            <div class="3xl:col-span-3 lg:col-span-6 flex items-center col-span-full max-lg:justify-center">
                <img src="{{ asset('images/int6a.png')}}" alt="">
            </div>
        </div>
    </div>
</footer>

@include('sections.home.modal')
