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
    public $sentiment_score;

    public function render()
    {

        if($this->sentiment_score == "" && $this->category_id == "" && $this->searchTerm == ""){
            $posts = Post::where('title', 'like', '%' . $this->searchTerm . '%')->where('category_id', 'like', '%' . $this->category_id . '%')->latest()->paginate(6);
        }else if($this->sentiment_score == 1){
            $posts = Post::where('title', 'like', '%' . $this->searchTerm . '%')->where('category_id', 'like', '%' . $this->category_id . '%')->orderBy('sentiment_score', 'desc')->paginate(6);
        }else if($this->sentiment_score == 2){
            $posts = Post::where('title', 'like', '%' . $this->searchTerm . '%')->where('category_id', 'like', '%' . $this->category_id . '%')->orderBy('sentiment_score', 'asc')->paginate(6);
        }

        $categories = Category::all();
        
        return view('livewire.explore-posts', [
            'posts' => $posts,
            'categories' => $categories
        ]);
    }
}