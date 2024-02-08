<div class="bg-color4 rounded-lg pl-10 py-5 pr-5 relative dark:text-colorContrast text-color2 flex items-center justify-between">
    <div class="post-title text-h5">
        <h2>{{ $post_title }}</h2>
    </div>
    <div class="post-info flex gap-10 items-center">
        <div class="post-date flex gap-2.5 items-center">
            @svg('images.kalendarz')
            <p>{{ date('d.m.Y', strtotime(get_post_meta($id, 'tour_date', true))) }}</p>
        </div>
        <div class="post-time flex gap-2.5 items-center">
            @svg('images.godzina')
            <p>{{get_field('tour_time', $id)}}</p>
        </div>
        <div class="post-price flex gap-2.5 items-center">
            @svg('images.koszt')
            <p>{{get_field('tour_price', $id)}}</p>
        </div>
        <div class="post-language text-color1">
            <img class="text-color3" src="{{ $post_language_url }}" title="{{ $post_language_slug }}" alt="{{ $post_language_slug }}">
        </div>
        <div class="post-permalink flex">
                
            
            <a href="{{ get_permalink($id) }}" class="btn btn--primary uppercase !w-[calc(325px)]"><span>Zobacz szczegóły</span></a>
        </div>
    </div>
</div>