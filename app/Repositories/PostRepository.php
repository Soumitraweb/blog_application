<?php
namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Models\Post;

class PostRepository{
    public function getAllPost(){      
        return Post::with('comments', 'user')->where('status', 'active')->orderBy('id', 'DESC')->get();
    }  
    public function insertPost($request){
        $post = new Post();
        $post->title = $request->title;
        $post->details = $request->details;
        $post->user_id =rand(1,1000);
        $post->created_at = now();
        $post->save();
        return true;
    }
}