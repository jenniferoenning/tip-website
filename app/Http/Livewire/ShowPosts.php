<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ShowPosts extends Component
{
    use WithPagination;

    public function render()
    {
        $user = auth()->user();
        $posts = $user->posts()->latest()->paginate(7);

        return view('livewire.show-posts', [
            'posts' => $posts
        ]);
    }
}
