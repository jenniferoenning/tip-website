<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class ExplorePosts extends Component
{
    use WithPagination;
    public $searchTerm;

    public function render()
    {
        $query = '%'.$this->searchTerm.'%';

        $posts = Post::where('title', 'like', '%'.$this->searchTerm.'%')->latest()->paginate(6);

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


