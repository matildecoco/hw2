<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use Illuminate\Support\Facades\DB;

class SearchPeopleController extends Controller
{
    public function index(){
        return view('searchPeople');
    }

    public function do_search_people(){
        $result = DB::select("SELECT * FROM users WHERE nomeUtente LIKE '%".$_POST['cerca']."%'");
        return response()->json($result);
    }

    public function do_search_people_def(){
        $user = Auth::user();
        $utente = $user->nomeUtente;
        $result = DB::select("SELECT * FROM users WHERE nomeUtente != '$utente'");
        return response()->json($result);
    }

    public function follow(Request $request){
        $user = Auth::user();
        $seguace = $user->nomeUtente;
        $seguito = $request->seguito;
        
        if($seguace === $seguito) return -1;
        
        $result = DB::insert("INSERT INTO followers (follower, following) VALUES(\"$seguace\", \"$seguito\")");
        if($result === true) return response("1");
        else return response("0");    
    }

} 
