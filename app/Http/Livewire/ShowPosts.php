<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class ShowPosts extends Component
{
    use WithPagination;

    public $content = 'Apenas um teste';

    protected $rules = [
        'content' => 'required|min:3|max:255',
    ];

    public function render()
    {
        $posts = Post::with('user')->latest()->paginate(5);

        return view('livewire.show-posts', [
            'posts' => $posts
        ]);
    }

    public function create()
    {
        $this->validate();

        auth()->user()->posts()->create([
            'content' => $this->content,

        ]);

        $this->content = '';
    }
}
