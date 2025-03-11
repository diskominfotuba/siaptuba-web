@extends('services.ragahtuah.layouts.app')
@section('content')
    <x-ragahtuah.navbar_home href="{{ route('ragahtuah') }}"></x-ragahtuah.navbar_home>

    <div class="row mt-4">
        <div class="col-12">
            <div class="level" style="">✨ Hasil Quiz Anda</div>
        </div>
    </div>

    {{-- soal --}}
    <section>
        <div class="quiz mt-4" style="font-family: 'digitalt">
            <p class="mb-0">SKOR</p>
            <h1 id="scoreValue">0</h1>
        </div>
    </section>
@endsection
@push('js')
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', (event) => {
            const examGrade = sessionStorage.getItem('examGrade');
            if (examGrade !== null) {
                document.getElementById('scoreValue').innerText = examGrade;
            } else {
                document.getElementById('scoreValue').innerText = 'Grade not available';
            }
        });
    </script>
@endpush
