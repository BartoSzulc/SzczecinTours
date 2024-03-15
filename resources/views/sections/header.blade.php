@php
// $data = get_field('header', 'option');

$languages = pll_the_languages(['raw' => true]);
$languageData = [];

foreach ($languages as $language) {
    $languageData[] = [
        'name' => $language['name'],
        'flag' => $language['flag'],
        'slug' => $language['slug'],
        'url' => $language['url'],
    ];
}

$currentLanguageSlug = pll_current_language('slug');
$currentLanguageData = $languageData[$currentLanguageSlug] ?? null;

@endphp

<header class="banner lg:py-30 md:py-5 py-2.5 main-header z-[99] relative">
  <div class="container">
    <div class="flex items-center justify-between relative @if (!is_front_page()) after:absolute after:content-[''] after:w-full after:h-px after:left-0 after:-bottom-30 after:bg-color2/30 @endif">
      <a class="max-sm:self-start brand flex w-20 sm:w-[120px] lg:w-auto" href="{{ pll_home_url() }}">
        <span class="sr-only">VisitSzczecin</span>
          <img src="{{asset('images/logo.svg')}}" alt="logo">
      </a>
      @include('partials.header.menu')
    </div>
  </div>
  @include('partials.header.mobile-menu')
</header>

<div class="banner py-2.5 main-header--sticky fixed top-0 transform -translate-y-full transition-all duration-500 ease-in-out z-[99] opacity-0 bg-white w-full border-b border-b-color2/30 dark:bg-black dark:border-colorContrast">
  <div class="container">
    <div class="flex items-center justify-between relative ">
      <a class="max-sm:self-start brand flex w-20 sm:w-[120px] lg:w-32" href="{{ pll_home_url() }}">
        <span class="sr-only">VisitSzczecin</span>
        <img src="{{asset('images/logo.svg')}}" alt="logo">
      </a>
      @include('partials.header.menu')
    </div>
  </div>
  @include('partials.header.mobile-menu')
</div>


