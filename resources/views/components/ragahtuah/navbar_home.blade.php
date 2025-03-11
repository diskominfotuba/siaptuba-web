@props([
    'href' => '/user/dashboard',
])
<section class="mb-3">
    <div class="navbar mt-4">
        <a href="{{ $href }}">
            <img src="{{ asset('assets/services/ragahtuah/') }}/img/btn_back.png"
                onmousedown="btnPressed(this, '{{ asset('assets/services/ragahtuah/') }}/img/btn_back.png', '{{ asset('assets/services/ragahtuah/') }}/img/btn_back_pressed.png')"
                onmouseup="btnReleased(this, '{{ asset('assets/services/ragahtuah/') }}/img/btn_back.png', '{{ asset('assets/services/ragahtuah/') }}/img/btn_back_pressed.png')"
                ontouchstart="btnPressed(this, '{{ asset('assets/services/ragahtuah/') }}/img/btn_back.png', '{{ asset('assets/services/ragahtuah/') }}/img/btn_back_pressed.png')"
                ontouchend="btnReleased(this, '{{ asset('assets/services/ragahtuah/') }}/img/btn_back.png', '{{ asset('assets/services/ragahtuah/') }}/img/btn_back_pressed.png')"
                alt=""></a>
        <img src="{{ asset('assets/services/ragahtuah/') }}/img/btn_sound.svg" id="btnSound"
            onclick="btnSound(this, '{{ asset('assets/services/ragahtuah/') }}/img/btn_sound.svg','{{ asset('assets/services/ragahtuah/') }}/img/btn_sound_clicked.svg')"
            alt="">
    </div>
</section>
