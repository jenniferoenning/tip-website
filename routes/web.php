<?php
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\{
    ShowPosts,
    CreatePosts,
    ExplorePosts,
    ShowPost,
    EditPost
};
use App\Http\Livewire\User\UploadPhoto;
use App\Http\Controllers\PostCommentsController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {

    Route::get('/nova_postagem', CreatePosts::class)->name('create.posts');
    Route::post('posts/{post:slug}/comentarios', [PostCommentsController::class, 'store']);
    Route::get('explorar', ExplorePosts::class)->name('explorar');
    Route::get('postagens', ShowPosts::class)->name('posts');
    Route::get('/postagem/{slug}', ShowPost::class)->name('show.post');
    Route::get('/postagem/editar/{id}', EditPost::class)->name('post.edit');
});
