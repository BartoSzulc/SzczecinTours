<article class="single__content">
  <div class="container">
    <div class="bg-white p-5 lg:p-10 max-lg:w-[calc(100%+40px)] max-lg:-left-5 relative rounded-lg mt-60"  data-aos="fade-up">
      <div class="w-full mb-5 lg:mb-10 flex flex-col">
        <a href="" class="btn--grey self-center lg:self-end lg:-mt-10 relative -mt-5 -translate-y-1/2">
          wróć do listy
        </a>
        <div class="text-h4 lg:text-h3 font-bold"  data-aos="fade-up">
          <h1>{{ the_title()}}</h1>
        </div>
      </div>
      @php(the_content())
    </div>
  </div>
</article>