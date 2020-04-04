@extends('layouts.app')

@section('title','Login')

@section('stylesheet')
    <link href="{{ url('css/custom.css') }}" rel="stylesheet">
@endsection

@section('content')
<div id="login">
    <h3 class="text-center text-white pt-5">Login</h3>
    <div class="container">
        <div id="login-row" class="row justify-content-center align-items-center">
            <div id="login-column" class="col-md-6">
                <div id="login-box" class="col-md-12">
                    <form id="login-form" class="form" action="{{ route('login') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="email" class="text-info">Email:</label><br>
                            <input type="text" name="email" id="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password" class="text-info">Password:</label><br>
                            <input type="text" name="password" id="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" class="btn btn-info btn-md" value="submit">
                        </div>
                        <div id="register-link" class="text-right">
                            <a href="{{ route('register') }}" class="text-info">Sign Up</a>
                        </div>
                    </form>
                    @if ($message = Session::get('success'))
                        <div class="form-group success_message">    
                            <label class="text-info">{{ $message }}</label>
                        </div>
                    @endif

                    @if ($message = Session::get('error'))
                        <div class="form-group success_message">    
                            <label class="text-info">{{ $message }}</label>
                        </div>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
