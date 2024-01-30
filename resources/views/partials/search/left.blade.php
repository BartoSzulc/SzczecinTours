<div class="flex  items-center filter-button">
    <a id="selectToday" class="pr-30">Dzisiaj</a>
</div>
<div class="flex border-custom items-center filter-button">
    <a id="selectTomorrow" class="px-30">Jutro</a>
</div>
<div class="wrap border-custom datepicker-show flex w-fit relative cursor-pointer">
    <input class="absolute opacity-0 w-full h-full flex cursor-pointer" id="minMaxExample" >
    <div class="flex items-center gap-2.5 px-30">
        @svg('images.kalendarz-big') 
        <span id="selectedDate" class="flex items-center gap-2.5">Wybierz datę</span>
    </div>
</div>
<div class="pl-30 flex justify-center gap-30">
    @foreach($miejsce_wycieczki_terms as $term)
        <div class="relative miejsce-radio">
            <input type="radio" id="{{ $term->slug }}" name="miejsce_wycieczki" class="hidden-radio miejsce_wycieczki-radio" value="{{ $term->slug }}">
            <label for="{{ $term->slug }}" class="cursor-pointer">{{ $term->name }}</label>
        </div>
    @endforeach
</div>