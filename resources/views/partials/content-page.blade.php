<section class="hero__template  bg-color7 relative py-half lg:py-full overflow-hidden wysiwyg">
  <div class="pointer-events-none bg-white absolute triangle-right -top-px -right-px h-20 w-20 lg:w-[160px] lg:h-[160px] z-10"></div>
  <div class="container">
      <div class="w-full mb-half-mobile lg:mb-half">
          <div class="text-h4 lg:text-h3 font-bold"  data-aos="fade-up">
            <h1>{{ the_title()}}</h1>
          </div>
      </div>
      <div class="bg-white p-half-mobile lg:p-half max-lg:w-[calc(100%+40px)] max-lg:-left-5 relative"  data-aos="fade-up">
        @php(the_content())
      </div>
     
  </div>
</section>

