@php
$languages = pll_languages_list(['fields' => '']);
$languageData = [];

foreach ($languages as $language) {
    $languageData[] = [
        'name' => $language->name,
        'custom_flag_url' => $language->custom_flag_url,
        'slug' => $language->slug,
    ];
}
@endphp
<div class="flex gap-5 items-center">
    <select id="language-select" class="select-custom">
        <option data-placeholder="true" value="all">- język wycieczki -</option>
        @foreach($languageData as $language)
            <option data-html="<div class='select-custom__inside'><img src='{{ $language['custom_flag_url'] }}'/><p>{{ $language['name'] }}</p></div>" value="{{ $language['slug'] }}">
                {{ $language['name'] }}
            </option>
        @endforeach
    </select>
    <select id="sorting-select" class="select-custom">
        <option data-placeholder="true">- sortuj wg -</option>
        <option value="DATE">Data wydarzenia</option>
        <option value="ASC">Alfabetycznie</option>
    </select>
    <div class="change-view flex items-center gap-[15px]">
        <div class="view grid-view active">
            @svg('images/kafelki.svg')
        </div>
        <div class="view list-view">
            @svg('images/lista.svg')
        </div>
    </div>
    
</div>