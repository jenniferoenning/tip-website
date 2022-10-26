<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class CreatePosts extends Component
{
    public $content = 'Apenas um teste';

    protected $rules = [
        'content' => 'required|min:3|max:255'
    ];

    public function render()
    {
        return view('livewire.create-posts');
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
