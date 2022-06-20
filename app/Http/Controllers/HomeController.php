<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function utenti_seguiti(){
        $user = Auth::user();
        $nomeUtente = $user->nomeUtente;
        $result = DB::select("SELECT  users.nomeUtente as nomeUtente, users.immagine as Imageuser, posts.id as idPost,
        posts.titolo as titoloPost, posts.url as ImagePost , posts.dataPost as dataPost
        from users join followers join posts 
        on followers.follower = ? and followers.following=posts.nomeUtente and followers.following = users.nomeUtente and posts.nomeUtente = users.nomeUtente 
        or (users.nomeUtente=? and posts.nomeUtente=?) 
        group by(posts.id) order by (posts.dataPost) DESC", [$nomeUtente, $nomeUtente, $nomeUtente]);

        return response()->json($result);
    }

    public function stampa_like(Request $request){
        $idPost = $request->idPost;
        $array = array();
        
        $result = DB::select("SELECT count(hw2Likes.post_id) as numeroLikes , posts.id as idPost from posts
        JOIN hw2Likes on post_id = ? and hw2Likes.post_id = posts.id  group by(posts.id)", [$idPost]);

        if($result == null){
            $array[] = [
                'numeroLikes' => '0',
                'idPost' => $idPost
            ];
            return response()->json($array);
        }

        return response()->json($result);
    
    }

    public function aggiungi_like(Request $request){
        $user = Auth::user();
        $nomeUtente = $user->nomeUtente;
        $idPost = $request->idPost;
        $array = array();

        DB::table('hw2Likes')->insert(['post_id' => $idPost, 'nomeUtente' => $nomeUtente]);

        $result = DB::select("SELECT count(hw2Likes.post_id) as numeroLikes , posts.id as idPost from posts
        JOIN hw2Likes on post_id = ? and hw2Likes.post_id = posts.id  group by(posts.id)", [$idPost]);

        if($result == null){
            $array[] = [
                'numeroLikes' => '0',
                'idPost' => $idPost
            ];
            return response()->json($array);
        }

        return response()->json($result);

    }

    public function like_users(Request $request){
        $idPost = $request->idPost;
        $array = array();

        $result = DB::select("SELECT hw2Likes.nomeUtente as nomeUtente, hw2Likes.post_id as postID FROM hw2Likes WHERE hw2Likes.post_id = ?", [$idPost]);

        if($result == null){
            $array[] = [
                'nomeUtente' => 'Nessun Like Ricevuto',
                'postID' => $idPost
            ];
            return response()->json($array);
        }

        return response()->json($result); 
    }

}
