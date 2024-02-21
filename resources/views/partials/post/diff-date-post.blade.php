@php
$current_post_id = get_the_ID(); 
$related_posts = get_field('other_tours', $current_post_id);

@endphp
@if (!empty($related_posts)) 
<div class="w-full text-h4 my-10">
    <h2>{{ pll__('Ta sama wycieczka w innym terminie') }}</h2> 
</div>
<div class="post-translations flex flex-col gap-5">
    @foreach ($related_posts as $post) 
        @php
            setup_postdata($post); 
            $id = $post->ID;
            $post_url = get_permalink($id);
            $post_title = get_the_title($id);
            $post_language_slug = pll_get_post_language($id, 'slug');
            $post_language_url = pll_get_post_language($id, 'custom_flag_url');
        @endphp
        @include('partials.post.content-inside-post')
    @endforeach
    @php wp_reset_postdata(); @endphp 
</div>
@endif