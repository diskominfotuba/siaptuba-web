@extends('services.ragahtuah.layouts.app')
@section('content')
    <x-ragahtuah.navbar_home href="{{ route('ragahtuah') }}"></x-ragahtuah.navbar_home>

    <div class="row mt-4">
        <div class="col-12">
            <div class="level" style="">🏆 TOP 10 SCOREBOARD</div>
        </div>
    </div>

    {{-- soal --}}
    <section class="container text-white mt-5">
        <div class="d-flex justify-content-between">
            <span>Nama</span>
            <span>Skor</span>
        </div>

        <div id="scoreboard-list"></div>
    </section>
@endsection
@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            fetch('{{ env('API_RAGAHTUAH', null) }}/api/scoreboard-top-10')
                .then(response => response.json())
                .then(data => {
                    if (data.status) {
                        const scoreboardList = document.getElementById('scoreboard-list');
                        scoreboardList.innerHTML = ''; // Kosongkan konten sebelumnya

                        data.data.forEach((item, index) => {
                            const scoreboardItem = document.createElement('div');
                            scoreboardItem.className = 'd-flex justify-content-between';

                            const nameDiv = document.createElement('div');
                            nameDiv.className = 'd-flex';

                            const rankSpan = document.createElement('span');
                            rankSpan.textContent = `${item.rank}.`;

                            const nameInfoDiv = document.createElement('div');
                            nameInfoDiv.className = 'ml-1';

                            const nameSpan = document.createElement('span');
                            nameSpan.className = 'd-block';
                            nameSpan.style.marginBottom = '-11px';
                            nameSpan.textContent = item.nama;

                            const opdSpan = document.createElement('span');
                            opdSpan.style.fontSize = '.8rem';
                            opdSpan.textContent = item.nama_opd;

                            nameInfoDiv.appendChild(nameSpan);
                            nameInfoDiv.appendChild(opdSpan);

                            nameDiv.appendChild(rankSpan);
                            nameDiv.appendChild(nameInfoDiv);

                            const gradeSpan = document.createElement('span');
                            gradeSpan.textContent = item.grade;

                            scoreboardItem.appendChild(nameDiv);
                            scoreboardItem.appendChild(gradeSpan);

                            scoreboardList.appendChild(scoreboardItem);
                        });
                    } else {
                        console.error('Failed to fetch data:', data.message);
                    }
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });
        });
    </script>
@endpush
