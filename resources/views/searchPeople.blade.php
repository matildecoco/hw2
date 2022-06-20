@extends('layouts.app')

@section('title', 'Cerca utente')

@section('style')
    <link href="{{ asset('css/search_people.css') }}" rel='stylesheet'>
@endsection

@section('script')
    <script src={{asset('js/search_people.js')}} defer></script>
    <script type="text/javascript" defer>
        const do_search_people_def = '{{route("do_search_people_def")}}'
        const follow = '{{route("follow")}}'
    </script>
@endsection

@section('content')
    
    <form id = 'ricercaUtente' action = '{{route("do_search_people")}}' method = 'POST'>
    @csrf
    <nav>
    <span>
        <input type='text' name='cerca' placeholder = 'Cerca'>
    </span>
    <span>
        <label>&nbsp;<input type='submit' value='Cerca'></label>
    </span>
    <a href= '{{route('home')}}'>Ritorna alla home</a>
    </nav>
    </form>
    
    <div id = 'boxUtenti'>
    </div>  

@endsection