@extends('layouts.master')

@section('content')
<section>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h4 class="text-center">LOGIN</h4>
                </div>

                <div class="card-body">
                    <form>
                        @csrf
                       
                        <div class="form-group mb-3">
                            <label for="email">Email Address</label>
                                  <input type="email" name="email" id="email"class="form-control" placeholder="Enter Email Address">
                        </div>

                        <div class="form-group mb-3">
                            <label for="password">Password</label>
                                  <input type="password" name="password" id="password"class="form-control" placeholder="Enter Password">
                        </div>

                        <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-dark btn-block mt-2" id="login_form">Login</button>
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
        $('#login_form').on('click', function(e)
        {
            e.preventDefault();
            var email = $('#email').val();
            var password = $('#password').val();
         
                    $.ajax({
                        type: 'POST',
                        url: 'login_user',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            email: email,
                            password: password
                        },
                        success:function(data)
                        {

                                if(data.success)
                            {
                                alert(data);
                                $('#notifDiv').fadeIn();
                                $('#notifDiv').css('background','green');
                                $('#notifDiv').text('Successfully Logged In');
                                setTimeout(() => {
                                $('#notifDiv').fadeOut();
                                }, 3000);
                              window.location ="{{ route('home') }}";

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
           });
    });

</script>

@endpush

