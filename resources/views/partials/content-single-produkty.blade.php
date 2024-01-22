@php
$custom_taxonomy_terms = get_the_terms(get_the_ID(), 'kategoria_produktu');

$title = isset($title) ? $title : get_the_title();

// ACF
$select_product = get_field('select_product');
$product_variations = get_field('product_variations');
$product_simple = get_field('product_simple');

@endphp
<section class="hero__template  bg-color7 relative py-half lg:py-full overflow-hidden single-produkty">
    <div class="pointer-events-none bg-white absolute triangle-right -top-px -right-px h-20 w-20 lg:w-[160px] lg:h-[160px] z-10"></div>
    <div class="container">
        <div class="w-full mb-half-mobile lg:mb-half">
            <div class="text-h4 lg:text-h3 font-bold"  data-aos="fade-up">
                    
                    @if ($custom_taxonomy_terms && !is_wp_error($custom_taxonomy_terms))
                        @foreach ($custom_taxonomy_terms as $term)
                            {{ $term->name }}
                        @endforeach
                    @endif
                  
            </div>
        </div>
        @if ($select_product == 'v2')
            @include ('partials.product-variations')
        @elseif ($select_product == 'v1')
            @include ('partials.product-simple')
        @endif
        @include ('partials.product-description')
        
        
    </div>
</section>
@include ('partials.recent-products')

