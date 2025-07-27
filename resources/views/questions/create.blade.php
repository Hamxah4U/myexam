<x-layout_admin>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h4>New Course Management Window</h4>
                    </div>
                    @if (session('success'))
                        <x-alert-error type="success" :message="session('success')" />
                    @endif
                </div>

                <div class="card-body">
                    <form action="{{ route('add-questions') }}" method="post">
                        @csrf

                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="name">Question</label>
                                    <textarea placeholder="Enter Question" class="form-control" name="name" id="" cols="0" rows="0">{{  old('name') }}</textarea>
                                    <x-form-error name='name' />
                                </div>
                            </div>
                            <div class="col-md-1"></div>
                        </div>

                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="name">Option A</label>
                                    <input type="text" class="form-control" id="option_a" name="option_a"
                                        placeholder="Enter option A" value="{{ old('option_a') }}" />
                                    <x-form-error name='option_a' />
                                </div>
                            </div>
                            <div class="col-md-1"></div>
                        </div>

                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="name">Option B</label>
                                    <input type="text" class="form-control" id="option_b" name="option_b"
                                        placeholder="Enter option B" value="{{ old('option_b') }}" />
                                    <x-form-error name='option_b' />
                                </div>
                            </div>
                            <div class="col-md-1"></div>
                        </div>

                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="name">Option C</label>
                                    <input type="text" class="form-control" id="option_c" name="option_c"
                                        placeholder="Enter option C" value="{{ old('option_c') }}" />
                                    <x-form-error name='option_c' />
                                </div>
                            </div>
                            <div class="col-md-1"></div>
                        </div>

                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="name">Option D</label>
                                    <input type="text" class="form-control" id="option_d" name="option_d"
                                        placeholder="Enter option D" value="{{ old('option_d') }}" />
                                    <x-form-error name='option_d' />
                                </div>
                            </div>
                            <div class="col-md-1"></div>
                        </div>

                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="name">Correct Answer</label>
                                    <input type="text" class="form-control" id="correct_answer" name="correct_answer"
                                        placeholder="Enter Crrect Answer" value="{{ old('correct_answer') }}" />
                                    <x-form-error name='is_correct' />
                                </div>
                            </div>
                            <div class="col-md-1"></div>
                        </div>

                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <button class="btn btn-success">Submit</button>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </form>
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
