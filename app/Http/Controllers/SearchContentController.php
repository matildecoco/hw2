<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use Illuminate\Support\Facades\DB;

class SearchContentController extends Controller
{
    public function index(){
        return view('searchContent');
    }

    public function do_search_content(Request $request){
        $request->validate([
            "cerca"=>"required|string"
        ]);

        if($_POST['scelta'] === 'spotify'){
            //App key
            $client_id = '80c2c0a401714ed18188dcd3797ad36c';
            $client_secret = 'add0e342d53a4c5bb7e0a20e7a1d6c32';
            // Richiesta token
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, "https://accounts.spotify.com/api/token");
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
            $headers = array("Authorization: Basic ".base64_encode($client_id.":".$client_secret));
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            $result = curl_exec($curl);
            curl_close($curl);
            
            // Utilizzo
            $token = json_decode($result)->access_token;
            $data = http_build_query(array("q" => $_POST['cerca'], "type" => "album"));
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, "https://api.spotify.com/v1/search?q=cat".$data);
            $headers = array("Authorization: Bearer ".$token);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            $result = curl_exec($curl);
            echo "$result";
            curl_close($curl);
            }
        
            if($_POST['scelta'] === 'giphy'){
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, "http://api.giphy.com/v1/gifs/search?q=cat" .$_POST["cerca"]."&api_key=TrtuAq0z8mPxO6XH9rFLMkmbSgqcVxRv");
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                $api_return = curl_exec($curl);
                echo $api_return;
                curl_close($curl);
            }
        
    }

    public function condividiPost(Request $request){
        $user = Auth::user();
        $utente = $user->nomeUtente;
        $url = $request->image;
        $titolo = $request->titolo;
        $data = date('Y-m-d H:i:s');
        DB::table('posts')->insert(['titolo' => $titolo, 'url' => $url, 'nomeUtente' => $utente, 'dataPost' => $data]);
        return response("Post condiviso!");
    }
}
