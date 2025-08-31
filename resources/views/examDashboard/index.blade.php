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
   <div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0 text-center">Exam Rules & Instructions</h4>
        </div>
        <div class="card-body">
            <ol class="mb-4">
                <li>Read all instructions carefully before starting the exam.</li>
                <li>Do not refresh or close the browser during the exam.</li>
                <li>Each question has a fixed time limit; once time is up, you cannot go back.</li>
                <li>Use only one device to write your exam; multiple logins are prohibited.</li>
                <li>Click "Submit" once you have answered all questions.</li>
                <li>Any form of malpractice will lead to disqualification.</li>
            </ol>

            <div class="text-center">
                @forelse ($exams as $exam)
                    <a href="{{ route('student.exams.start', $exam->id) }}" class="btn btn-lg btn-success px-5">
                        Start {{ $exam->name }}
                    </a>
                @empty
                    <p>No exams available.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

    <!-- Optional JS -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>