@php

$year = get_field('year') ?? null;

@endphp
<div class="col-span-1 flex">
    <div class="flex flex-col realization__item bg-color7 hover:bg-white transition-all duration-500 ease-in-out hover:shadow-cien-1">
        <div class="realization__item__image relative">
            <a class="overflow-hidden flex group" href="{{ get_permalink() }}">
                @if (has_post_thumbnail())
                <img class="h-[150px] lg:h-[320px] w-full object-center object-cover transition-all duration-500 ease-in-out group-hover:scale-110" src="{{ get_the_post_thumbnail_url() }}" alt="{{ get_the_title() }}">
                @endif
            </a>
            <div class="pointer-events-none {{ $class ?? 'bg-white' }} absolute triangle-right -top-px -right-0.5 w-60 h-60 lg:w-[calc((115/520)*100%)] lg:h-[120px] flex items-start justify-end z-0">
                
                @if (!empty($year))
                <div class="text-base lg:text-h6 text-color2 font-semibold"  data-aos="fade-up">
                    <p>{{ $year }}</p>
                </div>
                @endif
            </div>
        </div>
        <div class="grow realization__item__content lg:p-30 p-5 flex flex-col">
            <div class="realization__item__content__title text-h4 lg:mb-30 mb-5">
                <a class="inline-block" href="{{ get_permalink() }}"  data-aos="fade-up">
                    <h3>{!! get_the_title() !!}</h3>
                </a>
            </div>
            <div class="realization__item__content__desc text-xs lg:text-base text-color6 font-medium mb-11"  data-aos="fade-up">
                <p>{!! get_the_excerpt() !!}</p>
            </div>
            <div class="realization__item__content__link mt-auto"  data-aos="fade-up">
                <a class="btn btn--primary" href="{{ get_permalink() }}"><span>{{ pll__('Zobacz więcej')}}</span></a>
            </div>
        </div>
    </div>
</div>