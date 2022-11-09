<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ShowPosts extends Component
{
    use WithPagination;
    public $searchTerm;
    public $deleteId = '';

    public function render()
    {
        $user = auth()->user();

        $query = '%'.$this->searchTerm.'%';
        $posts = $user->posts()->where('title', 'like', '%'.$this->searchTerm.'%')->latest()->paginate(7);

        return view('livewire.show-posts', [
            'posts' => $posts
        ]);
    }

    public function deleteId($id){
        $this->deleteId = $id;
    }

    public function delete(){
        Post::find($this->deleteId)->delete();
    }
}
