@extends('layouts.templates.default')

@section ('title')@endsection

@section('content')

<div class="login-wrap">
    <div class="login-html">

        <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Sign In</label>
        <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Sign Up</label>

        <div class="login-form">
            <form class="sign-in-htm" action="/login" method="POST">
                @csrf
                <div class="group">
                    <input name="email" id="user" type="email" class="input" placeholder="Email">
                    @error('email')
                        <span class="alert-error-forms" role="alert">
                            <strong>Email or password incorrect</strong>
                        </span>
                    @enderror
                </div>

                <div class="group">
                    <input name="password" id="pass" type="password" class="input" data-type="password"  placeholder="Password">
                </div>

                <div class="group">
                    <input name="remember" id="check" type="checkbox" class="check">
                    <label for="check">
                        <span class="icon"></span> Remember</label>
                </div>

                <div class="group">
                    <input type="submit" class="button" value="Sign In">
                </div>

                <div class="hr"></div>
                <div class="foot-lnk">
                    <a href="/forgot-password">Forgot Password?</a>
                </div>
            </form>
            <form id="register" class="sign-up-htm" action="/register" method="POST">
                @csrf

                <div class="group">
                    <input name="registername" value="{{old('registername')}}" type="text" class="input" placeholder="Name" required>
                    @error('registeremail')
                        <span class="alert-error-forms" role="alert">
                            <strong>Please enter a name</strong>
                        </span>
                    @enderror
                </div>

                <div class="group">
                    <input name="registeremail" value="{{old('registeremail')}}" type="email" class="input" placeholder="Email" required>
                    @error('registeremail')
                        <span class="alert-error-forms" role="alert">
                            <strong>Check your email and try again</strong>
                        </span>
                    @enderror
                </div>
                <div class="group">
                    <input name="registerpassword" type="password" class="input" data-type="password" placeholder="Password" required>
                    @error('registerpassword')
                        <span class="alert-error-forms" role="alert">
                            <strong>Check Password (min 8 characters)</strong>
                        </span>
                    @enderror
                </div>
                <div class="group">
                    <input name="registerpassword_confirmation" type="password" class="input" data-type="password" placeholder="Password Confirmation" required>
                </div>
                <div class="group">
                    <input type="submit" class="button" value="Register">
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(function() {
        @if (session('registerAttempt'))
            $('#tab-2').trigger('click');
        @endif
    });
</script>

@endsection
