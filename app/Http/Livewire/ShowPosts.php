<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class ShowPosts extends Component
{
    use WithPagination;
    public $searchTerm;
    public $deleteId = '';
    public $category_id;

    public function render()
    {
        $user = auth()->user();
        $categories = Category::all();
        $posts = $user->posts()->where('title', 'like', '%'.$this->searchTerm.'%')->where('category_id', 'like', '%' . $this->category_id . '%')->latest()->paginate(7);

        return view('livewire.show-posts', [
            'posts' => $posts,
            'categories' => $categories
        ]);
    }

    public function deleteId($id){
        $this->deleteId = $id;
    }

    public function delete(){
        Post::find($this->deleteId)->delete();
    }
}
