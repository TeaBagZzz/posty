<?php

namespace App\Http\Controllers;

use App\Mail\PostLiked;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    
    public function index()
    {
        //$user = auth()->user();

        //Mail::to($user)->send(new PostLiked());
        //dd(auth()->user()->posts);//Makes a "Collection" of the user's posts, this adds alot of functionality in manipulating the posts table. 
        //dd(auth()->user());//check user authentication passed from register page.
        return view('dashboard');
    }
}
