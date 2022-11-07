<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class CreatePosts extends Component
{
    use WithFileUploads;

    public $post_photo_path;
    public $title;
    public $description;

    public function render()
    {
        return view('livewire.create-posts');
    }

    public function create()
    {
        $this->validate([
            'post_photo_path' => 'required|image|max:1024',
            'description' => 'required:min:3|max:255',
            'title' => 'required:min:3|max:255'
        ]);

        $user = auth()->user();

        $nameFile = Str::slug(auth()->user()->name) . '.' . $this->post_photo_path->getClientOriginalExtension();
        $path = $this->post_photo_path->storeAs('users', $nameFile);

        auth()->user()->posts()->create([
            'title' => $this->title,
            'description' =>$this->description,
            'post_photo_path' => $path,
        ]);

        return redirect('/postagens');
    }
}
