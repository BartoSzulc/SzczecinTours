
@php
$current_post_id = get_the_ID(); // Inside The Loop
$translations = pll_get_post_translations($current_post_id);

@endphp
@if (!empty($translations)) 
<div class="w-full text-h4 my-10">
    <h2>{{ pll__('Ta sama wycieczka w innym języku') }}</h2>
</div>
<div class="post-translations flex flex-col gap-5">
    @foreach ($translations as $lang => $id) 
        {{-- Skip the current post --}}
        @if ($id != $current_post_id) 
            @php
                $post_url = get_permalink($id);
                $post_title = get_the_title($id);
                // Assuming you have a way to get the language-specific URL and slug
                $post_language_slug = pll_get_post_language($id, 'slug');
                $post_language_url = pll_get_post_language($id, 'custom_flag_url'); // Get the slug of the post's language
            @endphp
            {{-- Include your partial here, or directly output the translation details --}}
            @include('partials.post.content-inside-post')
        @endif
    @endforeach
</div>
@endif
