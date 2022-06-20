@extends('layouts.app')

@section('title', 'Signup')

@section('style')
    <link href="{{ asset('css/signup.css') }}" rel='stylesheet'>
@endsection

@section('script')
    <script src={{asset('js/signup.js')}} defer></script>
@endsection

@section('content')

<form id = 'registrazione' action = "{{route("register")}}" method = 'POST' enctype="multipart/form-data">
    
    @csrf
    
    <div id = 'boxSignup'>
    <h3>Registrazione</h3>
    <p>
    <label>Nome <input type='text' name='nome'></label>
    </p>

    @error('nome')
        {{$message}}
    @enderror

    <p>
    <label>Cognome <input type='text' name='cognome'></label>
    </p>

    @error('cognome')
        {{$message}}
    @enderror

    <p>
    <label>E-Mail <input type='text' name='email'></label>
    </p>
    
    @error('email')
        {{$message}}
    @enderror

    <span id = "ErroreMail"></span>
    <p>
    <label id ='username'>Username <input type='text' name='nomeUtente' verifyNomeUtente="{{route('usernameCheck')}}"></label>
    </p>

    </p>
    <span id = "ErroreUser"></span>
    <p>

    @error('nomeUtente')
        {{$message}}
    @enderror

    <span id = "ErroreUser"></span>
    <p>
    <label>Password <input type='password' name='password'></label>
    </p>


    @error('password')
        {{$message}}
    @enderror


    <span id = "ErrorePassword"></span>
    <p>
    <label>Conferma password <input type='password' name='password_confirmation'></label>
    </p>
    <p>
    <label>Immagine del profilo <input type='text' name='immagine'></label>
    </p>

    @error('immagine')
        {{$message}}
    @enderror

    </div>
    <p>
    <label>&nbsp;<input type='submit' value='Registrati'></label>
    </p>
    <div id = 'boxLogin'>
    <span> Hai già un account? </span>
    <a href='{{route('login')}}' id='accedi'> Clicca qui!</a>
    </div>
</form>

@endsection