<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class ExplorePosts extends Component
{
    use WithPagination;

    public function render()
    {
        $posts = Post::with('user')->latest()->paginate(6);

        return view('livewire.explore-posts', [
            'posts' => $posts
        ]);
    }

    public function like($idPost)
    {
        $post = Post::find($idPost);

        $post->likes()->create([
            'user_id' => auth()->user()->id
        ]);
    }

    public function unlike(Post $post)
    {

        $post->likes()->delete();
    }


}


