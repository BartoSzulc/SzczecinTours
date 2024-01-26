@php
$thumbnail_id = get_post_thumbnail_id()
@endphp

<div class="post bg-white flex flex-col h-full rounded-lg" data-aos="fade-up">
    <div class="post-image">
        @if ( has_post_thumbnail() ) 
        {!! wp_get_attachment_image($thumbnail_id, 'full', false, array('class' => 'object-cover object-center mx-auto h-[260px] aspect-[385/260] ', 'loading' => 'lazy')); !!}
        @endif
    </div>
    <div class="flex flex-col p-5">
        <div class="flex flex-wrap flex-row">
            <div class="post-date flex gap-2.5">
                @svg('images.kalendarz')
                <p>{{ date('d.m.Y', strtotime(get_post_meta(get_the_ID(), 'tour_date', true))) }}</p>
            </div>
        </div>
        <div class="post-title">
            <h2>{!! get_the_title() !!}</h2>
        </div>
        <div class="post-content">
            {!! get_the_content() !!}
        </div>
        
        
    </div>
</div>