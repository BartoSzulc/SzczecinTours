@extends('layouts.app')

@section('content')
<section class="hero__template  bg-color7 relative py-half lg:py-full overflow-hidden wysiwyg">
  <div class="pointer-events-none bg-white absolute triangle-right -top-px -right-px h-20 w-20 lg:w-[160px] lg:h-[160px] z-10"></div>
  <div class="container">
      <div class="w-full mb-half-mobile lg:mb-half">
          <div class="text-h4 lg:text-h3 font-bold"  data-aos="fade-up">
            <h1>404</h1>
          </div>
      </div>
      <div class="bg-white p-half-mobile lg:p-half max-lg:w-[calc(100%+40px)] max-lg:-left-5 relative">
       <div class="flex flex-wrap gap-5 items-center justify-center w-full">
        <div class="text-h3 lg:text-h3"  data-aos="fade-up">
          <h2>{{ pll__('Strona nie istnieje') }}</h2>
        </div>
        <a href="/" class="btn btn--primary"  data-aos="fade-up">{{ pll__('Powrót') }}</a>
       </div>
      </div>
     
  </div>
</section>
@endsection
