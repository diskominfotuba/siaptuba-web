@extends('services.ragahtuah.layouts.app')
@section('content')
    <x-ragahtuah.navbar_home href="/user/dashboard"></x-ragahtuah.navbar_home>
    <section style="height: 70vh" class="justify-content-center align-items-center d-flex">
        <div>
            <div class="d-flex w-100 justify-content-center mb-4">
                <img src="{{ asset('assets/services/ragahtuah/') }}/img/title.png" id="title" alt="">
            </div>
            <div class="d-flex w-100 justify-content-center flex-column">
                <div class="d-flex justify-content-center">
                    <x-ragahtuah.button id='btnStart' href="#" src="btn_mulai.svg"
                        pressed="btn_mulai_pressed.svg"></x-ragahtuah.button>
                </div>
                <div class="d-flex justify-content-center mt-3">
                    <x-ragahtuah.button href="{{ route('ragahtuah.peringkat') }}" src="btn_peringkat.svg"
                        pressed="btn_peringkat_pressed.svg"></x-ragahtuah.button>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            register();
        });

        function register() {
            $.ajax({
                url: '{{ env('API_RAGAHTUAH', null) }}/api/register',
                method: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({
                    user_id: '{{ auth()->user()->id }}',
                    nama: '{{ auth()->user()->nama }}',
                    nama_opd: '{{ auth()->user()->opd->nama_opd }}'
                }),
                success: function(response) {
                    console.log(response.message);
                },
                error: function(xhr, status, error) {
                    let response = JSON.parse(xhr.responseText);
                    console.log(response.message);
                }
            });
        }

        $('#btnStart').click(function() {
            $.ajax({
                url: '{{ env('API_RAGAHTUAH', null) }}/api/exam',
                method: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({
                    user_id: '{{ auth()->user()->id }}',
                }),
                success: function(response) {
                    if (response.status) {
                        localStorage.setItem('groupId', response.data.id);
                        window.location.href = "{{ route('ragahtuah.soal') }}"
                    } else {
                        swal({
                            title: 'Oops!',
                            text: response.message,
                            icon: 'error',
                            timer: 3000,
                        });
                    }
                },
                error: function(xhr, status, error) {
                    let response = JSON.parse(xhr.responseText);
                    console.log(response.message);
                }
            });
        });
    </script>
@endpush
