@extends('layouts.app')

@section('content')

    <div class="login-wrap">
        <div class="login-html">
            <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Reset Password</label>
            <input class="sign-up" style="display: none"><label class="tab" style="display: none"></label>

            <div class="login-form">
                <form class="sign-in-htm" action="{{ route('password.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="group">
                        <input name="email" id="user" type="email" value="{{ $email ?? old('email') }}" required autocomplete="email"  class="input" placeholder="Email">
                        @error('email')
                            <span class="errorMsg alert-error" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="group">
                        <input name="password" type="password" class="input" data-type="password" placeholder="Password" required>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="group">
                        <input name="password_confirmation" type="password" class="input" data-type="password" placeholder="Password Confirmation" required>
                    </div>

                    <div class="group">
                        <input type="submit" class="button" value="Reset Password">
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
