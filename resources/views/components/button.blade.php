@if ($button_version == 'v1')
<a class="btn btn--primary" target="{{ $button_link['target'] }}" href="{{ $button_link['url'] }}"><span>{{ $button_link['title'] }}</span></a>
@else
<a class="btn btn--secondary" target="{{ $button_link['target'] }}" href="{{ $button_link['url'] }}"><span>{{ $button_link['title'] }}</span></a>
@endif