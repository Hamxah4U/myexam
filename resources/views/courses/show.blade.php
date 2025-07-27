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
                            <th>Coursee</th>
                            <th>created by</th>
                            <th>Action</th>
                        </tr>
                            @forelse ($courses as $course)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $course->name }}</td>
                                    <td>{{ $course->user->email }}</td>
                                    <td>
                                        <a href="" title="edit this course"><span class="fas fa-edit"></span></a>
                                        <a href=""><span class="fas fa-trash" style="color: red"></span></a>
                                    </td>
                                </tr>
                            @empty
                                
                            @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>


    <script>
        function change_school() {
            let school_id = $('#school_id').val();
            $('#department_id').html('<option>Loading...</option>');

            if (school_id !== "") {
                $.ajax({
                    url: `/get-departments/${school_id}`,
                    type: 'GET',
                    success: function(data) {
                        let options = '<option value="">Select Department</option>';
                        $.each(data, function(key, department) {
                            options += `<option value="${department.id}">${department.name}</option>`;
                        });
                        $('#department_id').html(options);
                    },
                    error: function(xhr, status, error) {
                        console.error("XHR:", xhr);
                        console.error("Status:", status);
                        console.error("Error:", error);
                        alert("An error occurred: " + xhr.responseText);
                        $('#department_id').html('<option>Error loading departments</option>');
                    }
                });
            } else {
                $('#department_id').html('<option value="">Select School First</option>');
            }
        }

        function generateRegNo() {
            let department_id = $('#department_id').val();
            if (department_id != "") {
                $.ajax({
                    url: `/get-department-code/${department_id}`,
                    type: 'GET',
                    success: function(response) {
                        const fullYear = new Date().getFullYear();
                        const year = String(fullYear).slice(-2);
                        const serial = String(response.serial).padStart(5, '0');
                        const reg_no = `${year}/${serial}/${response.department_code}`;
                        $('#reg_no').val(reg_no);
                    },
                    error: function(xhr, status, error) {
                        console.error("XHR:", xhr);
                        console.error("Status:", status);
                        console.error("Error:", error);
                        alert("Error generating registration number: " + xhr.responseText);
                    }
                })
            }
        }
    </script>

    <script>
        function changestate() {
            let state_id = $('#state_id').val();
            $('#lga_id').html('<option>Loading...</option>');

            if (state_id) {
                $.ajax({
                    url: '/staff/get-lgas/' + state_id,
                    type: 'GET',
                    success: function(data) {
                        let options = '<option value="">Select LGA</option>';
                        $.each(data, function(index, lga) {
                            options += `<option value="${lga.id}">${lga.name}</option>`;
                        });
                        $('#lga_id').html(options);
                    },
                    error: function() {
                        $('#lga_id').html('<option value="">Error loading LGAs</option>');
                    }
                });
            } else {
                $('#lga_id').html('<option value="">Select State First</option>');
            }
        }
    </script>
</x-layout_admin>
