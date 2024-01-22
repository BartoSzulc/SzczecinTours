@extends('layouts.app')

@section('content')
  <section class="hero__template bg-color7 relative py-half lg:py-full overflow-hidden">
    <div class="pointer-events-none bg-white absolute triangle-right -top-px -right-px h-20 w-20 lg:w-[160px] lg:h-[160px] z-10"></div>
    <div class="container">
        <div class="w-full mb-half-mobile lg:mb-half">
            <div class="text-h4 lg:text-h3 font-bold"  data-aos="fade-up">
              {{post_type_archive_title( '<h1 class="page-title">', '</h1>' );}}
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
          @while(have_posts()) @php(the_post())
            @include('partials.post-card', ['class' => 'bg-color7'])
          @endwhile
      </div>
    </div>
  </section>
@endsection