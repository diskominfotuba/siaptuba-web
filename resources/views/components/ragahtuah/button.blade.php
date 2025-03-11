@props([
    'src' => '',
    'pressed' => '',
    'href' => '#',
    'id' => '#',
])
<a id="{{ $id }}" href="{{ $href }}">
    <img src="{{ asset('assets/services/ragahtuah/img/' . $src) }}"
        onmousedown="btnPressed(this, '{{ asset('assets/services/ragahtuah/img/' . $src) }}', '{{ asset('assets/services/ragahtuah/img/' . $pressed) }}')"
        onmouseup="btnReleased(this, '{{ asset('assets/services/ragahtuah/img/' . $src) }}', '{{ asset('assets/services/ragahtuah/img/' . $pressed) }}')"
        ontouchstart="btnPressed(this, '{{ asset('assets/services/ragahtuah/img/' . $src) }}', '{{ asset('assets/services/ragahtuah/img/' . $pressed) }}')"
        ontouchend="btnReleased(this, '{{ asset('assets/services/ragahtuah/img/' . $src) }}', '{{ asset('assets/services/ragahtuah/img/' . $pressed) }}')"
        alt="">
</a>
