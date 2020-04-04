@extends('layouts.app')

@section('title','Sign Up')

@section('stylesheet')
    <link href="{{ url('css/custom.css') }}" rel="stylesheet">
@endsection

@section('js') 
    <script src="{{ url('js/validation.js') }}"></script>
@endsection

@section('content')
<div id="login">
    <h3 class="text-center text-white pt-5">Sign Up</h3>
    <div class="container">
        <div id="login-row" class="row justify-content-center align-items-center">
            <div id="login-column" class="col-md-6">
                <div id="signup-box" class="col-md-12">
                    <form id="signup-form" class="form" action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label id="name_label" for="name" class="text-info">Name</label><br>
                            <input type="text" name="name" id="name" class="form-control required @error('name') error_class @enderror" required value="{{ old('name') }}">
                            <p class="error">@error('name') {{$message}} @enderror</p>
                           
                        </div>
                        <div class="form-group">
                            <label id="email_label" for="email" class="text-info">Email</label><br>
                            <input type="text" name="email" id="email" class="form-control required @error('email') error_class @enderror" required value="{{ old('email') }}">
                            <p class="error">@error('email') {{$message}} @enderror</p>
                        </div>
                        <div class="form-group">
                            <label id="gender_label" for="gender" class="text-info">Gender</label><br>
                            <input type="radio" class="required" name="gender" id="gender_male" value="M" checked>Male
                            <input type="radio" class="required" name="gender" id="gender_female" value="F">Female
                            <br>
                            <p class="error">@error('gender') {{$message}} @enderror</p>
                        </div>
                        <div class="form-group">
                            <label id="password_label" for="password" class="text-info">Password</label><br>
                            <input type="text" name="password" id="password" class="form-control required @error('password') error_class @enderror" required value="{{ old('password') }}">
                            <p class="error">@error('password') {{$message}} @enderror</p>
                        </div>
                        <div class="form-group">
                            <label id="password_confirmation_label" for="password_confirmation" class="text-info">Confirm Password</label><br>
                            <input type="text" name="password_confirmation" id="password_confirmation" required class="form-control required @error('password_confirmation') error_class @enderror" value="{{ old('password_confirmation') }}">
                            <p class="error">@error('password_confirmation') {{$message}} @enderror</p>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" id="submit" class="btn btn-info btn-md" value="submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
