<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class ShowPosts extends Component
{
    public $message = 'Apenas um teste';

    public function render()
    {
        $posts = Post::get();

        return view('livewire.show-posts', [
            'posts' => $posts
        ]);
    }
}
