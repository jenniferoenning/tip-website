<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\User;
use Livewire\Component;
use Illuminate\Http\Request;

class ShowPost extends Component
{

    public $post;

    public function mount($id)
    {

        $this->post = Post::find($id);

        return view('livewire.show-post', [
            'post' => $this->post
        ]);
    }

}
