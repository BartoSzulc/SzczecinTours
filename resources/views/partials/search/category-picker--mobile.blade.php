<select id="single" class="lg:hidden category-picker--mobile select-custom min-w-[200px] flex-initial">
    <option data-placeholder="true" data-html="<div class='select-custom__inside'><svg width='60' height='60' viewBox='0 0 60 60' fill='none' xmlns='http://www.w3.org/2000/svg'>
        <mask id='mask0_1736_3' style='mask-type:luminance' maskUnits='userSpaceOnUse' x='0' y='0' width='60' height='60'>
        <path d='M59 59V1H1V59H59Z' fill='white' stroke='white' stroke-width='2'/>
        </mask>
        <g mask='url(#mask0_1736_3)'>
        <path d='M12.8906 35.3906L3.14063 19.3934C1.89727 17.5324 1.17188 15.2965 1.17188 12.8906C1.17188 6.41836 6.41836 1.17188 12.8906 1.17188C19.3629 1.17188 24.6094 6.41836 24.6094 12.8906C24.6094 15.2965 23.884 17.5324 22.6406 19.3934L12.8906 35.3906Z' stroke='#1F294C' stroke-width='2' stroke-miterlimit='10' stroke-linecap='round' stroke-linejoin='round'/>
        <path d='M17.5781 12.8906C17.5781 15.4793 15.4793 17.5781 12.8906 17.5781C10.302 17.5781 8.20312 15.4793 8.20312 12.8906C8.20312 10.302 10.302 8.20313 12.8906 8.20313C15.4793 8.20313 17.5781 10.302 17.5781 12.8906Z' stroke='#1F294C' stroke-width='2' stroke-miterlimit='10' stroke-linecap='round' stroke-linejoin='round'/>
        <path d='M47.1094 54.1406C48.4043 54.1406 49.4531 55.1906 49.4531 56.4844C49.4531 57.7793 48.4043 58.8281 47.1094 58.8281C45.8145 58.8281 44.7656 57.7793 44.7656 56.4844C44.7656 55.1906 45.8145 54.1406 47.1094 54.1406Z' stroke='#1F294C' stroke-width='2' stroke-miterlimit='10' stroke-linecap='round' stroke-linejoin='round'/>
        <path d='M47.1094 54.1406L37.3594 38.8465C36.116 36.9855 35.3906 34.7496 35.3906 32.3438C35.3906 25.8715 40.6371 20.625 47.1094 20.625C53.5816 20.625 58.8281 25.8715 58.8281 32.3438C58.8281 34.7496 58.1027 36.9855 56.8594 38.8465L47.1094 54.1406Z' stroke='#1F294C' stroke-width='2' stroke-miterlimit='10' stroke-linecap='round' stroke-linejoin='round'/>
        <path d='M51.7969 32.3438C51.7969 34.9324 49.698 37.0312 47.1094 37.0312C44.5207 37.0312 42.4219 34.9324 42.4219 32.3438C42.4219 29.7551 44.5207 27.6563 47.1094 27.6563C49.698 27.6563 51.7969 29.7551 51.7969 32.3438Z' stroke='#1F294C' stroke-width='2' stroke-miterlimit='10' stroke-linecap='round' stroke-linejoin='round'/>
        <path d='M15.2344 37.7344C15.2344 39.0293 14.1855 40.0781 12.8906 40.0781C11.5957 40.0781 10.5469 39.0293 10.5469 37.7344C10.5469 36.4406 11.5957 35.3906 12.8906 35.3906C14.1855 35.3906 15.2344 36.4406 15.2344 37.7344Z' stroke='#1F294C' stroke-width='2' stroke-miterlimit='10' stroke-linecap='round' stroke-linejoin='round'/>
        <path d='M28.2422 56.6562C28.3371 56.6562 28.4141 56.5793 28.4141 56.4844C28.4141 56.3894 28.3371 56.3125 28.2422 56.3125C28.1472 56.3125 28.0703 56.3894 28.0703 56.4844C28.0703 56.5793 28.1472 56.6562 28.2422 56.6562Z' stroke='#1F294C' stroke-width='2'/>
        <path d='M15.2344 37.7344H25.3125C27.9012 37.7344 30 39.8332 30 42.4219C30 45.0105 27.9012 47.1094 25.3125 47.1094H11.25C8.66133 47.1094 6.5625 49.2082 6.5625 51.7969C6.5625 54.3855 8.66133 56.4844 11.25 56.4844H22.9687' stroke='#1F294C' stroke-width='2' stroke-miterlimit='10' stroke-linecap='round' stroke-linejoin='round'/>
        <path d='M33.5156 56.4844H44.7656' stroke='#1F294C' stroke-width='2' stroke-miterlimit='10' stroke-linecap='round' stroke-linejoin='round'/>
        </g>
        </svg>
        <p>{{ pll__('Wszystkie') }}</p></div>"value="all">{{ pll__('Wszystkie') }}</option>
    @if ($kategoria_wycieczki_terms && is_array($kategoria_wycieczki_terms))
    @foreach($kategoria_wycieczki_terms as $term)

    @php
    $categoryImage = get_field('category_image', $term);
    $term_translations = pll_get_term_translations($term->term_id);
    $term_ids = array_values($term_translations);
    
    @endphp
    <option data-html="<div class='select-custom__inside'>
        @if(!empty($categoryImage['url']))
        @php
        $url = $categoryImage['url'];
        $ext = pathinfo($url, PATHINFO_EXTENSION);
        @endphp
        @if ($ext == 'svg')
        {!! str_replace('"', "'", file_get_contents($url)) !!}
        @else
        <img src='{{ $url }}'' alt='{{ $term->name }}'> @endif @endif <p>{{ $term->name }} </p></div>" value="{{ implode(',', $term_ids) }}">{{ $term->name }}</option>
    @endforeach
    @endif
</select>