@extends('layouts.master2')

@section('title')
    Login 
@stop


@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css" crossorigin="">

    <!--=============== CSS ===============-->
    <link rel="stylesheet" href="assets/css/styles_login.css">
    <!-- Sidemenu-respoansive-tabs css -->
    {{--    <link href="{{URL::asset('assets/plugins/sidemenu-responsive-tabs/css/sidemenu-responsive-tabs.css')}}" rel="stylesheet">--}}
@endsection
@section('content')
    <div class="login">
        <img src="assets/img/media/bahrz.jpg" alt="image" class="login__bg">

        <form method="POST" action="{{ route('login') }}" class="login__form">
            @csrf
            <h1 class="login__title">Login</h1>

            <div class="login__inputs">
                <div class="login__box">
                    <input class="form-control" placeholder="Enter your email"
                           type="email"name="email" :value="old('email')"
                           required autofocus autocomplete="username">


                    <i class="ri-mail-fill"></i>
                </div>

                <div class="login__box">
                    <input class="form-control" placeholder="Enter your password"
                           type="password"
                           name="password"
                           required autocomplete="current-password">


                    <i class="ri-lock-2-fill"></i>
                </div>
            </div>

            <div class="login__check">
                <div class="login__check-box">
                    <input class="login__check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} >
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <label for="user-check" class="login__check-label">Remember me</label>
                </div>

                <a href="#" class="login__forgot">Forgot Password?</a>
            </div>

            <button type="submit" class="login__button">{{ __('LOGIN ') }}</button>

            <div class="login__register">
                Don't have an account? <a href="#">Register</a>
            </div>
        </form>
    </div>
@endsection
@section('js')
@endsection




