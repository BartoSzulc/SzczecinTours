@php
$thumbnail_id = get_post_thumbnail_id();
$kategoria_terms = get_the_terms(get_the_ID(), 'kategoria_wycieczki');

@endphp

<div class="post bg-white flex flex-col h-full rounded-lg " data-aos="fade-up">
    <div class="post-image">
        @if ( has_post_thumbnail() ) 
        {!! wp_get_attachment_image($thumbnail_id, 'full', false, array('class' => 'object-cover object-center mx-auto h-[260px] aspect-[385/260] rounded-t-lg', 'loading' => 'lazy')); !!}
        @endif
    </div>
    <div class="flex flex-col p-5">
        <div class="flex flex-wrap flex-row">
            <div class="post-date flex gap-2.5">
                @svg('images.kalendarz')
                <p>{{ date('d.m.Y', strtotime(get_post_meta(get_the_ID(), 'tour_date', true))) }}</p>
            </div>
        </div>
        <div class="flex flex-col mt-30">
            <div class="post-title text-h4 text-color6 ">
                <h2>{!! get_the_title() !!}</h2>
            </div>
            <div class="post-excerpt text-base mt-5">
                {!! get_the_excerpt() !!}
            </div>
            <div class="post-permalink flex items-center justify-between mt-12">
                @if ($kategoria_terms)
                    @foreach($kategoria_terms as $term)
                        @php
                            $categoryImage = get_field('category_image', $term);
                        @endphp
                        <img src="{{ $categoryImage['url'] }}" alt="{{ $term->name }}">
                    @endforeach
                @endif
                <a href="{{ get_permalink() }}" class="btn btn--primary uppercase mt-5"><span>Zobacz więcej</span></a>
            </div>
        </div>
        
        
    </div>
</div>  

