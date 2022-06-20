<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'nomeUtente', 'titolo', 'url', "dataPost"
    ];

    public function user(){
        return $this->belongsTo("App\User");
    }

    public function userLikes(){
        return $this->belongsToMany("App\User","hw2Likes");  
    }
}
