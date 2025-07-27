<x-layout_admin>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h4>New Exam Management Window</h4>
                    </div>
                    @if (session('success'))
                        <x-alert-error type="success" :message="session('success')" />
                    @endif
                </div>

                <div class="card-body">
                    <form action="{{ route('exam.create') }}" method="post">
                        @csrf

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Course</label>
                                    <select name="course_id" id="course_id" class="form-control">
                                        <option value=""></option>
                                        @forelse ($courses as $course)
                                            <option value="{{ $course->id }}">{{ $course->name }}</option>
                                        @empty
                                            <option value="">No record found</option>
                                        @endforelse
                                    </select>
                                    <x-form-error name='course_id' />
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Exam Title</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Enter Exam name" value="{{ old('name') }}" />
                                    <x-form-error name='name' />
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Duration</label>
                                    <input type="number" class="form-control" id="duration" name="duration"
                                        placeholder="Enter Duration in Minute" value="{{ old('name') }}" />
                                    <x-form-error name='duration' />
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Start Time</label>
                                    <input type="datetime-local" name="start_date" id="start_date" value="{{ old('start_date') }}" class="form-control">

                                    <x-form-error name='start_date' />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">End Time</label>
                                    <input type="datetime-local" class="form-control" id="end_date" name="end_date"
                                        placeholder="Enter Exam name" value="{{ old('end_date') }}" />
                                    <x-form-error name='end_date' />
                                </div>
                            </div>

                        </div>
                </div>

                <div class="card-action">
                    <button class="btn btn-success">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</x-layout_admin>
