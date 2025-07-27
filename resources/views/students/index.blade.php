<x-layout_admin>

    @if (session('success'))
        <x-alert-error type="success" :message="session('success')" />
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h4>New Student Management Window</h4>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('add-student') }}" method="post">
                    @csrf
                    <input type="hidden" name="password" id="password" value="password">
                    
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input type="text" class="form-control" id="first_name" name="first_name"
                                    placeholder="Enter first name" value="{{ old('first_name') }}" />
                                <x-form-error name='first_name' />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="surname">Surname</label>
                                <input type="text" class="form-control" id="surname" name="surname"
                                    placeholder="Enter surname" value="{{ old('surname') }}" />
                                <x-form-error name='surname' />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="other_name">Other Name</label>
                                <input type="text" class="form-control" id="other_name" name="other_name"
                                    placeholder="Enter other name" value="{{ old('other_name') }}" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="first_name">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Enter Email" value="{{ old('email') }}" />
                                <x-form-error name='email' />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="phone">phone</label>
                                <input type="number" class="form-control" id="phone" name="phone"
                                    placeholder="Enter phone" value="{{ old('phone') }}" />
                                <x-form-error name='phone' />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select name="gender_id" id="gender_id" class="form-control">
                                    <option value=""></option>
                                    @foreach ($genders as $gender)
                                       <option value="{{ $gender->id }}">{{ $gender->name }}</option> 
                                    @endforeach
                                </select>
                                <x-form-error name='gender_id' />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="dob">DOB</label>
                                <input type="date" class="form-control" id="dob" name="dob"
                                    value="{{ old('dob') }}" />
                                <x-form-error name='dob'/>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="State">State</label>
                                <select name="state_id" onchange="changestate()" id="state_id" class="form-control">
                                    <option value=""></option>
                                    @foreach ($states as $state)
                                        <option value="{{ $state->id }}">{{ $state->name }}</option>
                                    @endforeach
                                </select>
                                <x-form-error name='state_id' />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="lga">LGA</label>
                                <select name="lga_id" id="lga_id" class="form-control">
                                    <option value=""></option>
                                </select>
                                <x-form-error name='lga_id' />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="dob">School</label>
                                <select onchange="change_school()" name="school_id" id="school_id" class="form-control">
                                    <option value=""></option>
                                    @foreach ($schools as $school)
                                    <option value="{{ $school->id }}">{{ $school->name }}</option>
                                    @endforeach
                                </select>
                                <x-form-error name='school_id' />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="department">Department</label>
                                <select name="department_id" id="department_id" class="form-control" onchange="generateRegNo()" >
                                    <option value=""></option>
                                </select>
                                <x-form-error name='department_id' />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="regno">Reg. number</label>
                                <input type="text" name="reg_no" id="reg_no" value="{{ old('reg_no') }}" class="form-control" readonly>
                                <x-form-error name='reg_no' />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="level">Level</label>
                                <select name="level_id" id="level_id" class="form-control">
                                    <option value=""></option>
                                    @foreach ($levels as $level)
                                        <option value="{{ $level->id }}">{{ $level->name }}</option>
                                    @endforeach
                                </select>
                                <x-form-error name='level_id' />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="State">Session</label>
                                <select name="academicsession_id" id="academicsession_id" class="form-control">
                                    <option value=""></option>
                                    @foreach ($sessions as $session)
                                        <option value="{{ $session->id }}">{{ $session->name }}</option>
                                    @endforeach
                                </select>
                                <x-form-error name='academicsession_id' /> 
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="semester">Semester</label>
                                <select name="semester_id" id="semester_id" class="form-control">
                                    <option value=""></option>
                                    @foreach ($semesteres as $semestere)
                                    <option value="{{ $semestere->id }}">{{ $semestere->name }}</option>
                                    @endforeach
                                </select>
                                <x-form-error name='semester_id' />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label for="">Address</label>
                            <textarea name="address" id="address" cols="0" rows="0" class="form-control"></textarea>
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
