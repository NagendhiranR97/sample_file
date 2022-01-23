@extends('layouts.master')

@section('content')
<section>
<div class="container mt-5">
    <div class="row">
    <div class="flash-message">
                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                    @if(Session::has('alert-' . $msg))
                        <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                    @endif
                @endforeach
            </div> 
        <div class="col-md-6 mx-auto">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h4 class="text-center">EMPLOYEE REGISTRATION</h4>
                </div>

                <div class="card-body">
                    <form>
                        @csrf
                        <div class="form-group mb-3">
                            <label for="fname">Employee First Name</label>
                                  <input type="text" name="fname" id="fname"class="form-control" placeholder="Enter Employee First Name">
                        </div>

                        <div class="form-group mb-3">
                            <label for="lname">Employee Last Name</label>
                                  <input type="text" name="lname" id="lname"class="form-control" placeholder="Enter Employee Last Name">
                        </div>

                        <div class="form-group mb-3">
                            <label for="email">Email Address</label>
                                  <input type="email" name="email" id="email" class="form-control" placeholder="Enter Email Address">
                        </div>

                        <div class="form-group mb-3">
                            <label for="email">Phone number</label>
                                  <input type="text" name="phone" id="phone" class="form-control" placeholder="Enter Phone Number">
                        </div>

                        <div class="form-group mb-3">
                            <label for="email">D.O.B</label>
                                  <input type="date" name="dob" id="dob" class="form-control" placeholder="Enter DOB">
                        </div>

                        <div class="form-group">
                    <label for="productcat">Gender</label>
                    <select class="form-select" id="gender" name="gender" aria-label="Default select example">
                        <option selected>Select Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                    </div>

                        <div class="form-group mb-3">
                            <label for="password">Password</label>
                                  <input type="password" name="password" id="password"class="form-control" placeholder="Enter Password">
                        </div>

                        <div class="form-group mb-3">
                            <label for="cpassword">Confirm Password</label>
                                  <input type="password" name="cpassword" id="cpassword"class="form-control" placeholder="Enter Confirm Password">
                        </div>
                        <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-dark btn-block mt-2" id="save_form">Register</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
@endsection


@push('scripts')

<script>
    $(document).ready(function()
    {
        $('#save_form').on('click', function(e)
        {

            var fname = $('#fname').val();
            var lname = $('#lname').val();
            var email = $('#email').val();
            var phone = $('#phone').val();
            var dob = $('#dob').val();
            var gender = $('#gender').val();
            var password = $('#password').val();
            var cpassword = $('#cpassword').val();
            var form = $(this).parents('form');
           $(form).validate({
            rules:{
                fname: {
                    required: true,
                },
                lname: {
                    required: true,
                },
                email: {
                    required: true,
                }, 
                phone: {
                    required: true,
                }, 
                dob: {
                    required: true,
                }, 
                gender: {
                    required: true,
                }, 
                password: {
                    required: true,
                    minlength: 6
                },
                cpassword: {
                    required: true,
                    equalTo: "#password"
                },
            },
            messages: {
                    fname: "First Name is required",
                    lname: "Last Name is required",
                    email: "Email Address is required",
                    phone: "Phone Number is required",
                    dob: "DOB is required",
                    gender: "Gender is required",
                    password: "Password is required",
                    cpassword: "Confirm Password is required",
                    cpassword: {
                        equalTo: "Confirm Password not matched"
                    },
                },
                highlight: function(element){
                    $(element).addClass('error')
                },
                submitHandler: function() 
                {
                    var formData = new FormData(form[0]);
                    $.ajax({
                        type: 'POST',
                        url: 'save_user',
                        data: formData,
                        dataType: 'JSON',
                        processData: false,
                        contentType: false,
                        success:function(data)
                        {
                            if(data.exists)
                            {
                                $('#notifDiv').fadeIn();
                                $('#notifDiv').css('background','red');
                                $('#notifDiv').text('Email already exists');
                                setTimeout(() => {
                                $('#notifDiv').fadeOut();
                                    
                                }, 3000);

                            }
                            else if(data.success)
                            {
                                $('#notifDiv').fadeIn();
                                $('#notifDiv').css('background','green');
                                $('#notifDiv').text('User Registered Successfully');
                                setTimeout(() => {
                                $('#notifDiv').fadeOut();
                                    
                                }, 3000);
                                $('[name="fname"]').val('');
                                $('[name="lname"]').val('');
                                $('[name="email"]').val('');
                                $('[name="phone"]').val('');
                                $('[name="dob"]').val('');
                                $('[name="gender"]').val('');
                                $('[name="password"]').val('');
                                $('[name="cpassword"]').val('');
                                top.location.href="usersview";
                            }
                            else
                            {
                                $('#notifDiv').fadeIn();
                                $('#notifDiv').css('background','red');
                                $('#notifDiv').text('An Error occured. Please try later.');
                                setTimeout(() => {
                                $('#notifDiv').fadeOut();
                                    
                                }, 3000);

                            }
                        }
                    });
                }
           });
    });
    });

</script>

@endpush

