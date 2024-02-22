<div class="flex-item text-h4 font-semibold text-color2 dark:text-colorContrast h-fit max-2xl:w-full max-2xl:col-span-full text-center max-lg:hidden">
    <p>{{ pll__('Wybór kategorii') }}</p>
</div>
<div class="flex-item relative kategoria-radio text-button uppercase lg:flex items-center gap-2.5 hidden">
   
    <input type="radio" id="all" name="kategoria_wycieczki" class="hidden-radio kategoria_wycieczki-radio" value="all" checked>
    <label for="all" class="text-button cursor-pointer">
        @svg('images/wszystkie.svg')
        {{ pll__('Wszystkie') }}</label>

</div>
@if ($kategoria_wycieczki_terms && is_array($kategoria_wycieczki_terms))
@foreach($kategoria_wycieczki_terms as $term)
<div class="flex-item relative kategoria-radio text-button lg:flex items-center gap-2.5 hidden">
    
    @php
    $categoryImage = get_field('category_image', $term);
    $term_translations = pll_get_term_translations($term->term_id);
    $term_ids = array_values($term_translations);
    @endphp

    <input type="radio" id="{{ $term->slug }}" name="kategoria_wycieczki" class="hidden-radio kategoria_wycieczki-radio" value="{{ implode(',', $term_ids) }}">
    <label for="{{ $term->slug }}" class="text-button cursor-pointer">
        @if(!empty($categoryImage['url']))
            @php
            $url = $categoryImage['url'];
            $ext = pathinfo($url, PATHINFO_EXTENSION);
            @endphp
            @if ($ext == 'svg')

            {!! file_get_contents($url) !!}
            @else
                <img src="{{ $url }}" alt="{{ $term->name }}">
            @endif
        @endif
        {{ $term->name }}
    </label>
</div>
@endforeach
@endif

