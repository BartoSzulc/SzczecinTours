@php
$current_post_id = get_the_ID(); // Inside The Loop
$related_posts = get_field('other_tours', $current_post_id);

@endphp
@if (!empty($related_posts)) 
<div class="w-full text-h4 my-10">
    <h2>{{ pll__('Ta sama wycieczka w innym terminie') }}</h2> {{-- Adjust the text as needed --}}
</div>
<div class="post-translations flex flex-col gap-5">
    @foreach ($related_posts as $post) 
        @php
            setup_postdata($post); // Set up post data for each related post
            $id = $post->ID;
            $post_url = get_permalink($id);
            $post_title = get_the_title($id);
            $post_language_slug = pll_get_post_language($id, 'slug');
            $post_language_url = pll_get_post_language($id, 'custom_flag_url'); // Example, adjust as needed
        @endphp
        {{-- Include your partial here, or directly output the related post details --}}
        @include('partials.post.content-inside-post')
    @endforeach
    @php wp_reset_postdata(); // Reset the global post object after the loop @endphp
</div>
@endif