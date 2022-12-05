<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Post;

class PostCommentsController extends Controller
{
   public function store(Post $post)
   {
        request()->validate([
            'body' => 'required',
        ]);

        $create_comment = $post->comments()->create([
             'user_id' => request()->user()->id,
             'body' => request('body')
         ]);
        
        $response = Http::acceptJson()->get('https://tiip.herokuapp.com/getSentiment', [
            'id' => $create_comment->id,
            'post_id' => $post->id,
            'body' => request()->body
        ]);

        return back();
   }
}
