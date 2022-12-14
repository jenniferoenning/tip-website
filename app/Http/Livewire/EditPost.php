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

class EditPost extends Component
{
    use WithFileUploads;

    public $post_photo_path;
    public $title;
    public $description;
    public $message_title;
    public $category;
    public $post;
    public $postId;

    protected $rules = [
        'title'             => 'required:min:3|max:255',
        'category'          => 'required',
        'post_photo_path'   => 'nullable|image',
    ];

    protected $messages = [
        'title.required' => 'Campo título vazio.',
        'category.required' => 'Campo categoria vazio.',
    ];

    public function mount($id)
    {
        $this->post = Post::find($id);
        $post = $this->post;
        $this->postId = $post->id;
        $this->title = $post->title;
        $this->description = $post->description;
        $this->category = $post->category->id;
    }

    public function update()
    {
        $post = Post::find($this->postId);

        $this->validate();
        $category_id = $this->category;

        if($this->post_photo_path){

            $path = $this->post_photo_path->store('posts', 's3');
            Storage::disk('s3')->setVisibility($path, 'public');

            $post->update([
                'title' => $this->title,
                'description' => $this->description,
                'category_id' => $category_id,
                'slug' => SlugService::createSlug(Post::class, 'slug', $this->title),
                'post_photo_path' => basename($path),
                'url_image' => Storage::disk('s3')->url($path)
            ]);
        }else{
            $post->update([
                'title' => $this->title,
                'description' => $this->description,
                'category_id' => $category_id,
                'slug' => SlugService::createSlug(Post::class, 'slug', $this->title),
            ]);
        }

        return redirect('/postagens');
    }

    public function render()
    {
        $user = auth()->user();
        $categories = Category::all();

        return view('livewire.edit-post', [
            'user' => $user,
            'categories' => $categories
        ]);
    }

}
