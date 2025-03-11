@extends('services.ragahtuah.layouts.app')
@section('content')
    <div class="row mt-4">
        <div class="col-12 d-flex justify-content-center align-items-center">
            <div class="primary-bg" style="width: max-content">quiz <span id="questionOrder"></span></div>
        </div>
    </div>

    {{-- soal --}}
    <section style="height: 40vh">
        <div class="quiz mt-4" id="question">
        </div>
    </section>

    {{-- jawaban --}}
    <section class="answer mt-5 mb-4" id="answers">
        <button class="info-bg text-break" onclick="btnAnswer(this);btnClick()" id="answerOne"></button>
        <button class="info-bg text-break" onclick="btnAnswer(this);btnClick()" id="answerTwo"></button>
        <button class="info-bg text-break" onclick="btnAnswer(this);btnClick()" id="answerThree"></button>
        <button class="info-bg text-break" onclick="btnAnswer(this);btnClick()" id="answerFour"></button>
    </section>

    <div class="modal fade show" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true" id="myModal">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content"
                style="border-radius: 20px;box-shadow: inset 0 -10px 0 0 #bfbfbf, 0 10px 0px rgb(0 48 61 / 38%);">
                <div class="modal-header p-0" style="background-color: #3ECEFE;border-bottom: 0px">
                    <div class="progress" style="width: 100%; height: 5px;">
                        <div id="progress-bar" class="progress-bar" style="width: 0%; background-color: #6D45E7;"></div>
                    </div>
                </div>
                <div class="px-3 pt-1">
                    <H3 class="text-center mb-0">
                        <div style="background-color: #A77DFE; color: #fff; border-radius: 10px">SCOREBOARD</div>
                    </H3>
                </div>
                <div class="modal-body pt-0">

                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script type="text/javascript">
        let question_order = 1;

        function loadQuestion(order) {
            $.ajax({
                url: '{{ env('API_RAGAHTUAH', null) }}/api/question/' + order,
                method: 'GET',
                contentType: 'application/json',
                data: {
                    user_id: '{{ auth()->user()->id }}',
                    group_id: localStorage.getItem('groupId'),
                },
                success: function(response) {
                    if (response.status) {
                        $('#questionOrder').text(`${response.data.question_order}`);
                        $('#question').html(`<p>${response.data.question}</p>`);
                        const answers = response.data.answer;
                        $('#answerOne').text(`A. ${answers[0].value}`).attr('data-option', answers[0].option);
                        $('#answerTwo').text(`B. ${answers[1].value}`).attr('data-option', answers[1].option);
                        $('#answerThree').text(`C. ${answers[2].value}`).attr('data-option', answers[2].option);
                        $('#answerFour').text(`D. ${answers[3].value}`).attr('data-option', answers[3].option);

                        // Remove any previous success-bg class
                        $('.answer button').removeClass('success-bg').addClass('info-bg');

                        // Add success-bg class to the answered option
                        $('.answer button').each(function() {
                            if ($(this).attr('data-option') == response.data.answered) {
                                $(this).removeClass('info-bg').addClass('success-bg');
                            }
                        });

                        localStorage.setItem('questionId', response.data.question_id)
                        localStorage.setItem('examId', response.data.exam_id)
                        localStorage.setItem('examSessionId', response.data.exam_session_id)
                        localStorage.setItem('lengthQuestion', response.data.length_question)
                    } else {
                        window.location.href = "{{ route('ragahtuah') }}";
                    }
                },
                error: function(xhr, status, error) {
                    let response = JSON.parse(xhr.responseText);
                    console.log(response.message);
                }
            });
        }

        function loadScoreboard() {
            $.ajax({
                url: '{{ env('API_RAGAHTUAH', null) }}/api/scoreboard',
                method: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({
                    user_id: '{{ auth()->user()->id }}',
                    exam_id: localStorage.getItem('examId'),
                    exam_session_id: localStorage.getItem('examSessionId'),
                }),
                success: function(response) {
                    if (response.status) {
                        updateScoreboardModal(response.data);
                    } else {
                        console.log(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    let response = JSON.parse(xhr.responseText);
                    console.log(response.message);
                }
            });
        }

        function endExam() {
            $.ajax({
                url: '{{ env('API_RAGAHTUAH', null) }}/api/end',
                method: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({
                    'exam_id': localStorage.getItem('examId'),
                    'exam_session_id': localStorage.getItem('examSessionId'),
                    'user_id': '{{ auth()->user()->id }}',
                }),
                success: function(response) {
                    sessionStorage.setItem('examGrade', response.data.grade);
                    window.location.href = '/user/ragahtuah/result'; // Redirect ke halaman result
                },
                error: function(xhr, status, error) {
                    let response = JSON.parse(xhr.responseText);
                    console.log(response.message);
                }
            });
        }

        function nextQuestion() {
            $.ajax({
                url: '{{ env('API_RAGAHTUAH', null) }}/api/next-question',
                method: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({
                    'exam_id': localStorage.getItem('examId'),
                    'exam_session_id': localStorage.getItem('examSessionId'),
                    'user_id': '{{ auth()->user()->id }}',
                }),
                success: function(response) {
                    let next_question_order = null;
                    if (response && response.data) {
                        next_question_order = response.data.next_question_order;
                    }
                    let question_order = next_question_order === null ? 1 : next_question_order;
                    loadQuestion(question_order);
                },
                error: function(xhr, status, error) {
                    let response = JSON.parse(xhr.responseText);
                    console.log(response.message);
                }
            });
        }

        function btnAnswer(element) {
            $.ajax({
                url: '{{ env('API_RAGAHTUAH', null) }}/api/answer',
                method: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({
                    'question_id': localStorage.getItem('questionId'),
                    'exam_id': localStorage.getItem('examId'),
                    'exam_session_id': localStorage.getItem('examSessionId'),
                    'user_id': '{{ auth()->user()->id }}',
                    'answer': $(element).attr('data-option'),
                }),
                success: function(response) {
                    if (response.status) {
                        $('.answer button').removeClass('success-bg').addClass('info-bg');
                        $(element).removeClass('info-bg').addClass('success-bg');

                        $('#myModal').modal('show');
                        loadScoreboard();

                        let progressBar = document.getElementById('progress-bar');
                        let width = 100;
                        let interval = setInterval(function() {
                            if (width <= 0) {
                                clearInterval(interval);
                                $('#myModal').modal('hide');
                                if (question_order == localStorage.getItem('lengthQuestion')) {
                                    endExam();
                                } else {
                                    question_order++;
                                    loadQuestion(question_order);
                                }
                            } else {
                                width--;
                                progressBar.style.width = width + '%';
                            }
                        }, 30);
                    } else {
                        console.log(response);
                    }
                },
                error: function(xhr, status, error) {
                    let response = JSON.parse(xhr.responseText);
                    console.log(response.message);
                }
            });
        }

        function updateScoreboardModal(data) {
            const modalBody = document.querySelector('#myModal .modal-body');
            modalBody.innerHTML = '';

            let studentsArray = [];
            if (Array.isArray(data)) {
                studentsArray = data;
            } else if (data && typeof data === 'object') {
                studentsArray = Object.values(data);
            } else {
                console.error("Data is not an array or object:", data);
                return;
            }

            studentsArray.forEach(student => {
                const progressWidth = Math.min(100, parseFloat(student.grade));
                const studentElement = `
            <div class="my-3"
                style="background-color: #06C3F6; color: #fff; padding: 5px 15px; border-radius: 10px; box-shadow: inset 0 -4px 0 0 #fff, 0 4px 6px rgba(0, 0, 0, 0.15);">
                ${student.rank}. ${student.nama} (Grade: ${student.grade})
                <div class="progress mb-2"
                    style="background-color: #6D45E7; border-radius: 10px; border: 2px solid #fff;">
                    <div class="progress-bar" style="width: ${progressWidth}%; background-color: #FC8AFF; border-radius: 15px;"
                        role="progressbar" aria-valuenow="${progressWidth}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        `;
                modalBody.insertAdjacentHTML('beforeend', studentElement);
            });
        }


        $(document).ready(function() {
            // nextQuestion();
            loadQuestion(question_order);
        });
    </script>
@endpush
