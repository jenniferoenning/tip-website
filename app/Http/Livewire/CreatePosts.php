<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Redirect;
use Cviebrock\EloquentSluggable\Services\SlugService;

class CreatePosts extends Component
{
    use WithFileUploads;

    public $post_photo_path;
    public $title;
    public $description;
    public $message_title;
    public $category_id;

    public function render()
    {
        $user = auth()->user();
        $categories = Category::all();
        
        return view('livewire.create-posts', [
            'user' => $user,
            'categories' => $categories
        ]);
    }

    public function create()
    {
        $this->validate([
            'post_photo_path' => 'required|image|max:1024',
            'description' => 'required:min:3|max:255',
            'title' => 'required:min:3|max:255',
            'category_id' => 'required|exists:App\Models\Category,id'
        ]);

        $user = auth()->user();
        $nameFile = Str::slug(auth()->user()->name) . '.' . $this->post_photo_path->getClientOriginalExtension();
        $path = $this->post_photo_path->storeAs('users', $nameFile);

        auth()->user()->posts()->create([
            'title' => $this->title,
            'description' =>$this->description,
            'post_photo_path' => $path,
            'slug' => SlugService::createSlug(Post::class, 'slug', $this->title),
            'category_id' => $this->category_id,
        ]);

        return redirect('/postagens');
    }
}
