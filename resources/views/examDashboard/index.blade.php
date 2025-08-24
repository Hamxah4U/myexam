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
            <div class="card-header">
                @if(isset($exam))
                    <h4>{{ $exam->title }} - Online Test</h4>
                    <small><strong>Duration:</strong> {{ $exam->duration }} minutes</small>
                @else
                    <div class="alert alert-warning">No exam data available.</div>
                @endif
            </div>
            <div class="card-body">
                @if(session('error'))
                    <x-alert-error type="danger" :message="session('error')" />
                @endif

                <form action="{{-- {{ route('exam.submit', $exam->id) }} --}}" method="POST" id="examForm">
                    @csrf
                    {{-- @foreach($exam->questions as $index => $question)
                        <div class="mb-4">
                            <h5>Q{{ $index+1 }}: {{ $question->question_text }}</h5>
                            @foreach($question->answers as $optKey => $option)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" 
                                           name="answers[{{ $question->id }}]" 
                                           id="q{{ $question->id }}_{{ $optKey }}" 
                                           value="{{ $option->id }}" required>
                                    <label class="form-check-label" for="q{{ $question->id }}_{{ $optKey }}">
                                        {{ chr(65 + $optKey) }}. {{ $option->answer_text }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    @endforeach --}}

                    <button type="submit" class="btn btn-primary">Submit Test</button>
                </form>
            </div>
        </div>
    </div>
</body>