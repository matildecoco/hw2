@extends('layouts.app')

@section('title', 'Crea post')

@section('style')
    <link href="{{ asset('css/create_post.css') }}" rel='stylesheet'>
@endsection

@section('script')
    <script src={{asset('js/search_content.js')}} defer></script>
    <script type="text/javascript" defer>
        const condividiPost = '{{route("condividiPost")}}'
    </script>
@endsection

@section('content')

<form id = 'ricercaPost' action = '{{route("do_search_content")}}' method = 'POST'>
    @csrf
    <nav>
    <span>
        <input type='text' name='cerca' placeholder = 'Cerca'>
    </span>

    <select name='scelta'>
        <option value="spotify">Spotify</option>
        <option value="giphy">Giphy</option>
    </select>

    <span>
        <label>&nbsp;<input type='submit' value='Cerca'></label>
    </span>

    <a href= '{{route('home')}}'>Ritorna alla home</a>
    </nav>
    </form>
    
    <section id = 'boxPost'>
    </section>
    
    <section id="modalView" class="hidden">
    </section>
    
@endsection
