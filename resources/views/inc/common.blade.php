{{-- Functions --}}

@php

if (!function_exists('setTitle')) :
    function setTitle($page_name) {
        echo ucwords($page_name);
}
endif

@endphp