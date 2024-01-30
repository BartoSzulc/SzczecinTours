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
<div class="flex gap-5">
    <select id="language-select" class="select-custom">
        <option data-placeholder="true">- język wycieczki -</option>
        @foreach($languageData as $language)
            <option data-html="<div class='select-custom__inside'><img src='{{ $language['custom_flag_url'] }}'/><p>{{ $language['name'] }}</p></div>" value="{{ $language['slug'] }}">
                {{ $language['name'] }}
            </option>
        @endforeach
    </select>
    <select id="sorting-select" class="select-custom">
        <option data-placeholder="true">- sortuj wg -</option>
        <option value="dateup">Data wydarzenia</option>
        <option value="asc">Alfabetycznie</option>
    </select>
</div>