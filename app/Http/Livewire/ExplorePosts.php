<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class ExplorePosts extends Component
{
    use WithPagination;
    public $searchTerm;
    public $category_id;

    public function render()
    {
        $categories = Category::all();
        $posts = Post::where('title', 'like', '%' . $this->searchTerm . '%')->where('category_id', 'like', '%' . $this->category_id . '%')->latest()->paginate(6);
        
        return view('livewire.explore-posts', [
            'posts' => $posts,
            'categories' => $categories
        ]);
    }
}