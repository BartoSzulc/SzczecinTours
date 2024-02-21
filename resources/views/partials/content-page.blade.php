<section class="hero__template relative py-30 lg:py-60">
  <div class="container builder">
      <div class="w-full mb-5 lg:mb-10">
          <div class="text-h4 lg:text-h3 font-bold" data-aos="fade-up">
            <h1>{{ the_title()}}</h1>
          </div>
      </div>
      <div class="bg-white p-5 lg:p-10 max-lg:w-[calc(100%+40px)] max-lg:-left-5 relative wysiwyg rounded-lg dark:text-colorContrast dark:bg-black dark:border dark:border-colorContrast"  data-aos="fade-up">
        @php(the_content())
      </div>
  </div>
</section>

