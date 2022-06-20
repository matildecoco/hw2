@extends('layouts.app')

@section('title', 'Home')

@section('style')
    <link href="{{ asset('css/home.css') }}" rel='stylesheet'>
@endsection

@section('script')
    <script src={{asset('js/home.js')}} defer></script>
    <script type="text/javascript" defer>
        const utenti_seguiti='{{route("utenti_seguiti")}}'
        const stampa_like='{{route("stampa_like")}}'
        const aggiungi_like='{{route("aggiungi_like")}}'
        const like_users='{{route("like_users")}}'
    </script>
@endsection

@section('menu')
    <a href="{{route('home')}}">Home </a>
    <a href="{{route('searchPeople')}}">Cerca utente </a>
    <a href="{{route('searchContent')}}">Cerca post </a>
    <a class='button' href="{{ route('logout') }}" onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">Logout</a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>    
@endsection


@section('content')

<div id = 'boxPosts'>
</div>

<section id="modalView" class="hidden">
</section> 

@endsection