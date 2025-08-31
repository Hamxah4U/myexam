<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MyExam - Student Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="Administrator Login Portal">

    <link rel="shortcut icon" href="{{ asset('img/arashmil.jpg') }}" type="image/x-icon">

    <!-- Fonts and icons -->
    <script src="{{ asset('js/plugin/webfont/webfont.min.js') }}"></script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/kaiadmin.min.css') }}">
</head>

<body>
    <div class="container mt-4">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4>Exam: {{ $exam->name }}</h4>
        </div>
        <div class="card-body">
            <p><strong>Course:</strong> {{ $exam->course->name }}</p>
            <p>
                <strong>Duration:</strong> {{ $exam->duration }} minutes 
                (<span id="countdown"></span>)
            </p>
            <p><strong>Total Questions:</strong> {{ count($exam->questions) }}</p>
            <p><strong>Created by:</strong> {{ $exam->user->email }}</p>

            <hr>
            <form id="answerForm" method="POST" action="{{ route('student.answers.store') }}">
                @csrf
                <input type="hidden" name="exam_id" value="{{ $exam->id }}">
                <input type="hidden" name="student_id" value="{{ auth()->user()->id }}">
                <input type="hidden" name="course_id" value="{{ $exam->course_id }}">
                <input type="hidden" name="question_id" value="{{ $currentQuestion->id }}">
                <input type="hidden" name="navigate" id="navigate" value="">

                <input type="hidden" name="current_index" value="{{ $questionIndex }}">



                <div class="mb-4">
                    <h5>Q{{ $questionIndex + 1 }}: {{ $currentQuestion->name }}</h5>
                    @foreach ($currentQuestion->answers as $optKey => $option)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" 
                                name="answer_id" 
                                id="q{{ $currentQuestion->id }}_{{ $optKey }}" 
                                value="{{ $option->id }}"
                                @if(optional($savedAnswer)->answer_id == $option->id) checked @endif>
                            <input type="text" name="is_correct[{{ $option->id }}]" value="{{ $option->is_correct }}" hidden>
                            <label class="form-check-label" for="q{{ $currentQuestion->id }}_{{ $optKey }}">
                                {{ chr(65 + $optKey) }}. {{ $option->answer_text }}
                            </label>
                        </div>
                    @endforeach
                </div>

                <div class="d-flex justify-content-between">
                    {{-- Prev button --}}
                    @if ($questionIndex > 0)
                        <button type="submit" class="btn btn-secondary" onclick="document.getElementById('navigate').value='prev'">
                            Previous
                        </button>
                    @endif

                    {{-- Next or Submit --}}
                    @if ($questionIndex < $totalQuestions - 1)
                        <button type="submit" class="btn btn-primary" onclick="document.getElementById('navigate').value='next'">
                            Next
                        </button>
                    @else
                        <button type="submit" class="btn btn-success" onclick="document.getElementById('navigate').value='submit'">
                            Submit Exam
                        </button>
                    @endif
                </div>
            </form>
        </div>
    </div>


    <script>
        let currentQuestion = 0;
        const totalQuestions = {{ count($exam->questions) }};

        function showQuestion(index) {
            document.querySelectorAll('.question-box').forEach((q, i) => {
                q.style.display = (i === index) ? 'block' : 'none';
            });

            document.getElementById('prevBtn').disabled = (index === 0);
            document.getElementById('nextBtn').style.display = (index === totalQuestions - 1) ? 'none' : 'inline-block';
            document.getElementById('submitBtn').style.display = (index === totalQuestions - 1) ? 'inline-block' : 'none';
        }

        document.getElementById('nextBtn').addEventListener('click', () => {
            if (currentQuestion < totalQuestions - 1) {
                currentQuestion++;
                showQuestion(currentQuestion);
            }
        });

        document.getElementById('prevBtn').addEventListener('click', () => {
            if (currentQuestion > 0) {
                currentQuestion--;
                showQuestion(currentQuestion);
            }
        });
        
    </script>

    <script>
        let remaining = Math.floor({{ $remainingSeconds }});

        function updateTimer() {
            if (remaining <= 0) {
                clearInterval(timer);
                document.getElementById("answerForm").submit();
            } else {
                let minutes = Math.floor(remaining / 60);
                let seconds = remaining % 60;

                let formattedTime =
                    String(minutes).padStart(2, '0') + ":" +
                    String(seconds).padStart(2, '0');

                document.getElementById("countdown").innerText = formattedTime;
                remaining--;
            }
        }
        updateTimer();
        let timer = setInterval(updateTimer, 1000);
    </script>
    </div>
</body>