<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Register</title>
    @include('layouts.css')

<body class="h-100">

    <div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-5">
                                <h4 class="text-center pb-2 login-box-msg">User Registration</h4>
                                <hr>
                                <form class="form-group" name="registration" id="registration"
                                    action="{{url('registration')}}" method="POST">
                                    {{ csrf_field() }}
                                    {{ csrf_field() }}
                                    @if (Session::has('success'))
                                    <div class="alert alert-success">
                                        {{Session::get('success')}}
                                    </div>
                                    @endif
                                    @if (Session::has('fail'))
                                    <div class="alert alert-danger">
                                        {{Session::get('fail')}}
                                    </div>
                                    @endif
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>First Name</label>
                                            <input type="text" class="form-control input-default" name="fname"
                                                id="fname" placeholder="First Name" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Last Name</label>
                                            <input type="text" class="form-control input-default" name="lname"
                                                id="lname" placeholder="Last Name" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>Mobile</label>
                                            <input type="tel" class="form-control input-default" name="mobile"
                                                id="mobile" placeholder="Mobile" pattern="[0-9]{10}" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>DOB</label>
                                            <input type="date" class="form-control input-default" name="dob" id="dob"
                                                placeholder="DOB" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>Email</label>
                                            <input type="email" class="form-control input-default" name="email"
                                                id="email" placeholder="Email" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Password</label>
                                            <input type="password" class="form-control input-default" name="pwd"
                                                id="pwd" placeholder="Password" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>Address</label>
                                            <input type="text" class="form-control input-default" name="address"
                                                id="address" placeholder="Address" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>City</label>
                                            <input type="text" class="form-control input-default" name="city" id="city"
                                                placeholder="City" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>State</label>
                                            <input type="text" class="form-control input-default" name="state"
                                                id="state" placeholder="State" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Pincode</label>
                                            <input type="number" class="form-control input-default" name="pincode"
                                                id="pincode" placeholder="Pincode" pattern="[0-9]{6}" required>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-dark float-right">Sign Up</button>
                                </form>
                                <p class="mt-5 login-form__footer">Have account <a href="{{url('login')}}"
                                        class="text-primary">Sign In
                                    </a> now</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

</body>

</html>