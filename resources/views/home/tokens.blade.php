@extends('layouts.templates.auth')

@section ('title')Tokens | @endsection

@section('content')

    <div class="container">
        <div id="app">
            <passport-personal-access-tokens></passport-personal-access-tokens>
        </div>
    </div>
    <script type="text/javascript" src="js/app.js"></script>
@endsection
