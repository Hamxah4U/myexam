<x-layout_admin>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h4>Course Management Window</h4>
                    </div>
                    @if (session('success'))
                        <x-alert-error type="success" :message="session('success')" />
                    @endif
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-responsive">
                        <tr>
                            <th>#</th>
                            <th>Course</th>
                            <th>Exam</th>
                            <th>Duration</th>
                            <th>Created by</th>
                            <th>Action</th>
                        </tr>
                        @forelse ($exams as $exam)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $exam->course->name }}</td>
                                <td>{{ $exam->name }}</td>
                                <td>{{ $exam->duration }}</td>
                                <td>{{ $exam->user->email }}</td>
                                <td><a href="" class="btn btn-info">Edit</a></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">No exams available.</td>
                            </tr>
                        @endforelse
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</x-layout_admin>
