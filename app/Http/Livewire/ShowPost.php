<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Redirect;
use Cviebrock\EloquentSluggable\Services\SlugService;
use App\Models\User;
use Livewire\Component;
use Illuminate\Http\Request;

class ShowPost extends Component
{
    public $post;

    public function mount($slug)
    {
        $this->post = Post::where('slug', $slug)->firstOrFail();

        return view('livewire.show-post', [
            'post' => $this->post
        ]);
    }

}
