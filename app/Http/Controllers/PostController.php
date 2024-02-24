<?php

namespace App\Http\Controllers;
use App\Repositories\PostRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Mail\SendBlogPostEmail;
use App\Events\SendBlogNotification;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class PostController extends Controller
{
    public $postRepo;
    public function __construct(PostRepository $postRepo){
        $this->postRepo = $postRepo;
    }

    public function getAllPost(){
        $posts = $this->postRepo->getAllPost();  
        return view('welcome', compact('posts'));
    }

    public function addPost(){  
        return view('add_post');
    }

    public function insertPost(Request $request){
        $posts = $this->postRepo->insertPost($request);  
        event(new SendBlogNotification($request->title  .' has been created.'));
        
        $users = User::whereIn('id', [1,2])->get();//User::all();       
        foreach($users as $user) {  
            Mail::to('mannasoumitra90@gmail.com')->queue(new SendBlogPostEmail($user));
        }        
        return redirect()->back()->with('success', 'Post successfully submitted.');   
    }
}
