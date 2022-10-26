<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class ShowPosts extends Component
{
    use WithPagination;

    public function render()
    {
        $posts = Post::with('user')->latest()->paginate(5);

        return view('livewire.show-posts', [
            'posts' => $posts
        ]);
    }
}
