
@php

$data = get_field('modal', 'option');
$title = $data['modal_title'] ?? null;
$phone = $data['modal_phone'] ?? null;
$email = $data['modal_email'] ?? null;

@endphp
@if ($data)
<div id="contactModal" class="hidden animate-fade-in fixed inset-0 z-[99] overflow-auto bg-black bg-opacity-40 text-color2 dark:text-colorContrast">
    <div class="flex items-center justify-center min-h-screen modal-inside">
      <div class="bg-white border border-color4 rounded-lg p-5 lg:p-10 animate-scaleUp modal-content dark:bg-black dark:border-colorContrast ">
        <button id="closeModal" class="absolute -top-3 -right-3 z-10 bg-white rounded-full p-2 border border-color4 hover:scale-110 transition-all duration-500 ease-in-out group/main">
          <svg width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg"><defs><clipPath id="a"><path fill="#fff" fill-opacity="0" d="M0 0h24v24H0z"/></clipPath></defs><g clip-path="url(#a)"><path class="transition-all duration-500 ease-in-out group-hover/main:stroke-color3" d="m6 6 12 12m0-12L6 18" stroke="#1F294C" stroke-width="2" stroke-linejoin="round"/></g></svg>
        </button>
        @if (!empty($title))
        <div class="text-h5 lg:text-h4 font-bold">
         <p>{{ $title }}</p>
        </div>
        @endif
        <div class="mt-4">
          @if (!empty($phone))
            <a href="tel:{{str_replace(' ', '', $phone)}}" class="flex items-center group/item">
              <svg width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg"><defs><clipPath id="a"><path fill="#fff" fill-opacity="0" d="M0 0h24v24H0z"/></clipPath></defs><path fill="none" d="M0 0h24v24H0z"/><g clip-path="url(#a)"><path  class="transition-all duration-500 ease-in-out group-hover/item:fill-color3" d="M13 9h-2v2h2V9Zm4 0h-2v2h2V9Zm3 6.5c-1.25 0-2.453-.2-3.57-.57a1.026 1.026 0 0 0-1.024.24l-2.195 2.2a15.12 15.12 0 0 1-6.594-6.58L8.82 8.58a.98.98 0 0 0 .25-1.01C8.703 6.45 8.5 5.25 8.5 4c0-.55-.453-1-1-1H4c-.547 0-1 .45-1 1 0 9.39 7.61 17 17 17 .547 0 1-.45 1-1v-3.5c0-.55-.453-1-1-1ZM19 9v2h2V9h-2Z" fill="#0296D8" fill-rule="evenodd"/></g></svg>
              <span class="ml-2 group-hover/item:text-color3 transition-all duration-500 ease-in-out">{{ $phone }}</span>
            </a>
          @endif
          @if (!empty($email))
            <a href="mailto:{{ $email }}" class="flex items-center mt-3 group/item">
              <svg width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg"><defs><clipPath id="a"><path fill="#fff" fill-opacity="0" d="M0 0h24v24H0z"/></clipPath></defs><path fill="none" d="M0 0h24v24H0z"/><g clip-path="url(#a)"><path class="transition-all duration-500 ease-in-out group-hover/item:fill-color3" d="M22 20.007c0 .262-.11.514-.29.7a1.007 1.007 0 0 1-.702.293H2.992A.987.987 0 0 1 2 20.007V19h18V7.3l-8 7.2-10-9V4a.996.996 0 0 1 1-1h18a.996.996 0 0 1 1 1v16.007ZM4.437 5 12 11.81 19.563 5H4.438ZM0 15h8v2H0v-2Zm0-5h5v2H0v-2Z" fill="#0296D8" fill-rule="evenodd"/></g></svg>
              <span class="ml-2 group-hover/item:text-color3 transition-all duration-500 ease-in-out">{{ $email }}</span>
            </a>
          @endif
        </div>
      </div>
    </div>
</div>
@endif
  