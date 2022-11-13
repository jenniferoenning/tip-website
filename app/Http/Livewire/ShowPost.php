<?php

namespace App\Http\Livewire;

use Redirect;
use Cviebrock\EloquentSluggable\Services\SlugService;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use Livewire\Component;
use Illuminate\Http\Request;

class ShowPost extends Component
{
    public $post;
    public $comments;

    public function mount($slug)
    {
        $this->post = Post::where('slug', $slug)->firstOrFail();
        $id_post_search = Post::where('slug', $slug)->firstOrFail();
        $post_id = $id_post_search->id;
        $this->comments = Comment::where('post_id', $post_id)->get();

        return view('livewire.show-post', [
            'post' => $this->post,
            'comments' => $this->comments
        ]);
    }

}
