<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Redirect;

use Cviebrock\EloquentSluggable\Services\SlugService;

class CreatePosts extends Component
{
    use WithFileUploads;

    public $post_photo_path;
    public $title;
    public $description;
    public $message_title;
    public $category;
    public $post;

    protected $rules = [
        'post_photo_path' => 'nullable|image',
        'title' => 'required:min:3|max:255',
        'category' => 'required'
    ];

    public function render()
    {
        $user = auth()->user();
        $categories = Category::all();
        
        return view('livewire.create-posts', [
            'user' => $user,
            'categories' => $categories
        ]);
    }

    public function store(Request $request)
    {
        $this->validate();

        $category_id = $this->category;

        if($this->post_photo_path){

            $path = $this->post_photo_path->store('posts', 's3');
            Storage::disk('s3')->setVisibility($path, 'public');

            Post::create([
                'user_id' => auth()->id(),
                'title' => $this->title,
                'description' => $this->description,
                'category_id' => $category_id,
                'slug' => SlugService::createSlug(Post::class, 'slug', $this->title),
                'post_photo_path' => basename($path),
                'url_image' => Storage::disk('s3')->url($path),
                'sentiment_score' => 0.5
            ]);
        }else{
            Post::create([
                'user_id' => auth()->id(),
                'title' => $this->title,
                'description' => $this->description,
                'category_id' => $category_id,
                'slug' => SlugService::createSlug(Post::class, 'slug', $this->title),
                'post_photo_path' => null,
                'url_image' => null,
                'sentiment_score' => 0.5
            ]);
        }

        return redirect('/postagens');
    }

}