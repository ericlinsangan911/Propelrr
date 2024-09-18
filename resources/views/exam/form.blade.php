@extends('layouts.app')

@section('title', 'Form')
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            function calculateAge() {
                const dob = new Date($('#dob').val());
                const today = new Date();
                let age = today.getFullYear() - dob.getFullYear();
                const monthDiff = today.getMonth() - dob.getMonth();
                if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < dob.getDate())) {
                    age--;
                }
                $('#age').val(age);
            }

            $('#dob').on('change', calculateAge);

            $('#form').on('submit', function(event) {
                event.preventDefault();

                let isValid = true;

                $('.error').text('');

                // Validate Full Name
                const fullName = $('#fullname').val();
                if (!/^[a-zA-Z\s,.]+$/.test(fullName)) {
                    $('#fullnameError').text('Invalid Full Name.');
                    isValid = false;
                }

                // Validate Email
                const email = $('#email').val();
                const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
                if (!emailRegex.test(email)) {
                    $('#emailError').text('Invalid Email Address.');
                    isValid = false;
                }

                // Validate Mobile Number
                const mobile = $('#mobile').val();
                if (!/^09\d{9}$/.test(mobile)) {
                    $('#mobileError').text('Invalid Mobile Number.');
                    isValid = false;
                }

                // If validation passes, submit the form using AJAX
                if (isValid) {
                    $.ajax({
                        url: '{{ route("form.submit") }}',
                        type: 'POST',
                        data: $(this).serialize(),
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.success) {
                                alert('Form submitted successfully!');
                                $('#form')[0].reset();
                                $('#age').val('');
                            } else {
                                // Display server-side validation errors
                                $.each(response.errors, function(key, messages) {
                                    $('#' + key + 'Error').text(messages[0]);
                                });
                            }
                        },
                        error: function() {
                            alert('An error occurred.');
                        }
                    });
                }
            });
        });
    </script>
    <style>
      .error{
        color:red;
      }
    </style>
@section('content')
<h1>Form</h1>
    <form id="form">
        <label for="fullname">Full Name:</label>
        <input type="text" id="fullname" name="fullname" class="form-control" >
        <span id="fullnameError" class="error"></span><br><br>

        <label for="email">Email Address:</label>
        <input type="email" id="email" name="email" class="form-control">
        <span id="emailError" class="error"></span><br><br>

        <label for="mobile">Mobile Number:</label>
        <input type="text" id="mobile" name="mobile" class="form-control">
        <span id="mobileError" class="error"></span><br><br>

        <label for="dob">Date of Birth:</label>
        <input type="date" id="dob" name="dob" class="form-control">
        <br><br>

        <label for="age">Age:</label>
        <input type="text" id="age" name="age" readonly class="form-control">
        <br><br>

        <label for="gender">Gender:</label>
        <select id="gender" name="gender" class="form-control">
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="other">Other</option>
        </select>
        <br><br>

        <button type="submit" class="btn btn-primary mt-3">Submit</button>
    </form>
@endsection
