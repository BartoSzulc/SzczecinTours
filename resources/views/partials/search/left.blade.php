<div class="flex  items-center filter-button">
    <a id="selectToday" class="pr-2.5 xs:pr-5 3xl:pr-30">{{pll__('Dzisiaj')}}</a>
</div>
<div class="flex border-custom items-center filter-button">
    <a id="selectTomorrow" class="px-2.5 xs:px-5 3xl:px-30">{{pll__('Jutro') }} </a>
</div>
<div class="wrap border-custom datepicker-show flex w-fit relative cursor-pointer">
    <input autocomplete="false" name="hidden" type="text" class="absolute opacity-0 w-full h-full flex cursor-pointer" id="minMaxExample" >
    <div class="input-wrapper flex items-center gap-2.5 px-2.5 xs:px-5 3xl:px-30">
        @svg('images.kalendarz-big', 'max-3xl:max-w-[25px] max-3xl:h-6') 
        <span id="selectedDate" class="flex items-center gap-2.5">{{ pll__('Wybierz datę') }}</span>
    </div>
</div>
<div class="md:pl-5 3xl:pl-30 flex justify-center gap-5 3xl:gap-30 max-md:w-full max-sm:flex-wrap">
    @foreach($miejsce_wycieczki_terms as $term)
        @if(is_object($term) && property_exists($term, 'slug'))
            <div class="relative miejsce-radio">
                <input type="radio" id="{{ $term->slug }}" name="miejsce_wycieczki" class="hidden-radio miejsce_wycieczki-radio" value="{{ $term->slug }}">
                <label for="{{ $term->slug }}" class="cursor-pointer">{{ $term->name }}</label>
            </div>
        @endif
    @endforeach
</div>