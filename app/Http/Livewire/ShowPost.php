<?php

namespace App\Http\Livewire;

use Redirect;
use Cviebrock\EloquentSluggable\Services\SlugService;
use App\Models\User;
use Livewire\WithPagination;
use App\Models\Post;
use App\Models\Comment;
use Livewire\Component;
use Illuminate\Http\Request;

class ShowPost extends Component
{
    public $post;
    public $comments;

    use WithPagination;

    public function render()
    {
        $user = auth()->user();
        $post = $this->post;
        $post_id = $this->post->id;
        $this->comments = Comment::where('post_id', $post_id)->with('author')->latest()->paginate(5);
        $links = $this->comments;
        $this->comments = collect($this->comments->items());
        $comments = $this->comments;

        return view('livewire.show-post', [
            'post' => $post,
            'comments' => compact($this->comments),
            'links' => $links,
            'user' => $user
        ]);
    }

    public function mount($slug)
    {
        $this->post = Post::where('slug', $slug)->firstOrFail();
    }
}
