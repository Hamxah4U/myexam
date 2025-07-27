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
                    <table class="table table-striped">
                        <tr>
                            <th>#</th>
                            <th>Courses</th>
                            <th>Action</th>
                        </tr>
                        @forelse ($courses as $course)
                          <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><a href="{{ route('add-questions') }}/{{ $course->id }}"><strong>{{ $course->name }}</strong></td>
                             <td><a href="{{ route('add-questions') }}/{{ $course->id }}"><button class="btn btn-info">Add questions</button></td>
                          </tr>
                        @empty
                          <tr>
                            <td colspan="3" class="text-center text-muted">No courses available.</td>
                        </tr>
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>    
</x-layout_admin>
