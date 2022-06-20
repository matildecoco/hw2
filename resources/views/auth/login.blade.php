@extends('layouts.app')

@section('title', 'Login')

@section('style')
    <link href="{{ asset('css/login.css') }}" rel='stylesheet'>
@endsection

@section('script')
<script src="{{ asset('js/login.js') }}" defer></script>
@endsection

@section('content')

<form id = 'login' action = "{{route('login')}}" method = 'POST'>
    
    @csrf

    <div id = 'boxLogin'>
    <h3>Login </h3>
    <p>
    <label>Username <input type='text' name='nomeUtente'></label>
    </p>
    
    @error('nomeUtente')
        {{$message}}
    @enderror
    
    <p>
    <label>Password <input type='password' name='password'></label>
    </p>
    
    @error('password')
        {{$message}}
    @enderror
    
    </div>
    
    <p>
    <label>&nbsp;<input type='submit' value='Accedi'></label>
    </p>
    
    <div id = 'boxRegistrazione'>
    <span> Non sei registrato? </span>
    <a href='{{route("register")}}' id='nuovoAccount'> Clicca qui!</a>
    </div>

</form>
    
@endsection