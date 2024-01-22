@query([
    'post_type' => 'realizacje',
    'posts_per_page' => 3,
])
@php
$data = get_field('realizations');
$title = $data['title'] ?? null;
$content = $data['content'] ?? null;

@endphp
@if (!empty($data))
<section class="home__realizations bg-white py-half lg:py-full">
    <div class="container">
        <div class="w-full">
            @if (!empty($title))
            <div class="text-h3 lg:text-h2"  data-aos="fade-up">
                {!! $title !!}
            </div>
            @endif
            @if (!empty($content))
            <div class="text-base lg:text-desc my-half-mobile lg:my-half text-color6"  data-aos="fade-up">
                {!! $content !!}
            </div>
            @endif
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-5" >
            @posts
            @include('partials.post-card')
            @endposts
        </div>
    </div>
</section>
@endif