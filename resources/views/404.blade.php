@extends('layouts.app')

@section('content')
<section class="hero__template  bg-color4 relative py-half lg:py-full overflow-hidden wysiwyg">
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
        <a href="/" class="btn btn--primary"  data-aos="fade-up"><span>{{ pll__('Powrót') }}</span></a>
       </div>
      </div>
     
  </div>
</section>
@endsection
