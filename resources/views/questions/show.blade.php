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
                        <table class="table table-striped table-hover table-responsive text-nowrap">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Question</th>
                                    <th>Option A</th>
                                    <th>Option B</th>
                                    <th>Option C</th>
                                    <th>Option D</th>
                                    <th>Correct Answer</th>
                                    <th>Created By</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($questions as $qsn)
                                    @php
                                        $optionLabels = ['A', 'B', 'C', 'D'];
                                        $answers = $qsn->answers->values(); // Ensures 0-based index
                                    @endphp
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $qsn->name }}</td>
                                        @foreach ($optionLabels as $i => $label)
                                            <td>{{ $answers[$i]->answer_text ?? '-' }}</td>
                                        @endforeach
                                        <td>{{ $qsn->answers->firstWhere('is_correct', true)?->answer_text ?? '-' }}</td>
                                        <td>{{ $qsn->users->email ?? 'N/A' }}</td>
                                        <td><a href="" class="btn btn-info">Edit</a></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center text-muted">No questions found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div> <!-- table-responsive -->
                </div>
            </div>
        </div>
    </div>
</x-layout_admin>
