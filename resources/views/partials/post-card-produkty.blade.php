<div class="col-span-1 flex">
    <div class="relative flex flex-col produkt__item bg-color7 transition-all duration-500 ease-in-out lg:p-30 p-5">
        <div class="pointer-events-none {{ $class ?? 'bg-white' }} absolute triangle-right -top-px -right-px w-60 h-60 lg:w-[calc((115/340)*100%)] lg:h-[120px] flex items-start justify-end z-0">
        </div>
        <div class="realization__item__image relatize z-10">
            <a class="overflow-hidden flex group" href="{{ get_permalink() }}">
                @if (has_post_thumbnail())
                <img class="h-20 lg:h-[120px] w-full object-center object-contain transition-all duration-500 ease-in-out " src="{{ get_the_post_thumbnail_url() }}" alt="{{ get_the_title() }}">
                @endif
            </a>
            
        </div>
        <div class="grow realization__item__content  flex flex-col  relatize z-10">
            <div class="realization__item__content__title text-h5 lg:text-h4 lg:mb-30 mb-5">
                <a class="inline-block" href="{{ get_permalink() }}"  data-aos="fade-up">
                    <h3>{!! get_the_title() !!}</h3>
                </a>
            </div>
            <div class="realization__item__content__desc text-xs lg:text-base text-color6 font-medium mb-11"  data-aos="fade-up">
                <p>{!! get_the_excerpt() !!}</p>
            </div>
            <div class="realization__item__content__link mt-auto max-lg:flex max-lg:justify-center "  data-aos="fade-up">
                <a class="btn btn--secondary" href="{{ get_permalink() }}"><span>{{ _('Szczegóły') }}</span></a>
            </div>
        </div>
    </div>
</div>