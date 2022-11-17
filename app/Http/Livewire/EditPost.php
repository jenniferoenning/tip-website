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
        'description'       => 'required:min:3|max:255',
        'category'          => 'required',
        'post_photo_path'   => 'required|image|max:1024',
    ];

    protected $messages = [
        'title.required' => 'Campo título vazio.',
        'description.required' => 'Campo descrição vazio.',
        'category.required' => 'Campo categoria vazio.',
        'post_photo_path.required' => 'Este campo de foto está vazio.',
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
        $path = $this->post_photo_path->store('posts', 's3');
        Storage::disk('s3')->setVisibility($path, 'public');

        $category_id = $this->category;

        $post->update([
            'title' => $this->title,
            'description' => $this->description,
            'category_id' => $category_id,
            'slug' => SlugService::createSlug(Post::class, 'slug', $this->title),
            'post_photo_path' => basename($path),
            'url_image' => Storage::disk('s3')->url($path)
        ]);

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
