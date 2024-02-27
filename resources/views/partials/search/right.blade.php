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
<div class="flex max-sm:flex-wrap gap-5 items-center">
    <select id="language-select" class="select-custom min-w-[200px] flex-initial">
        <option data-placeholder="true" value="all">{{ pll__('- język wycieczki -') }}</option>
        @foreach($languageData as $language)
            <option data-html="<div class='select-custom__inside'><img src='{{ $language['custom_flag_url'] }}'/><p>{{ $language['name'] }}</p></div>" value="{{ $language['slug'] }}">
                {{ $language['name'] }}
            </option>
        @endforeach
    </select>
    <select id="sorting-select" class="select-custom min-w-[200px] flex-initial">
        <option data-placeholder="true">{{ pll__('- sortuj wg -') }}</option>
        <option value="DATE">{{ pll__('Data wydarzenia') }}</option>
        <option value="ASC">{{ pll__('Alfabetycznie') }}</option>
    </select>
    <div class="change-view md:flex items-center gap-[15px] hidden">
        <div class="view grid-view">
            @svg('images/kafelki.svg', 'max-3xl:max-w-[25px] max-3xl:h-6')
        </div>
        <div class="view list-view active">
            @svg('images/lista.svg', 'max-3xl:max-w-[25px] max-3xl:h-6')
        </div>
    </div>
    
</div>