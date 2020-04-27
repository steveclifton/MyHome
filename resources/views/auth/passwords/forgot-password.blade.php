@extends('layouts.templates.default')

@section ('title')Forgot Password | @endsection

@section('content')

    <div class="login-wrap">
        <div class="login-html">
            <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Reset Password</label>
            <input class="sign-up" style="display: none"><label class="tab" style="display: none"></label>

            <div class="login-form">
                <form class="sign-in-htm" action="/forgot-password" method="POST">
                    @csrf
                    <div class="group">
                        <input name="email" id="user" type="text" class="input" placeholder="Email">
                        @error('email')
                            <span class="errorMsg alert-error" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="group">
                        <input type="submit" class="button" value="Reset Password">
                    </div>
                    @if (session('status'))
                        <div>
                            <span class="alert-success-forms" role="alert">
                                <strong>{{ session('status') }}</strong>
                            </span>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>

@endsection
