<?php
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\{
    ShowPosts,
    CreatePosts,
    ExplorePosts,
    ShowPost,
    //EditPost
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

    Route::get('/novo_postagem/', CreatePosts::class)->name('create.posts');
    Route::post('/novo_postagem/update', CreatePosts::class)->name('update.posts');
    Route::post('posts/{post:slug}/comentarios', [PostCommentsController::class, 'store']);
    Route::get('explorar', ExplorePosts::class)->name('explorar');
    Route::get('postagens', ShowPosts::class)->name('posts');
    Route::get('/postagem/{slug}', ShowPost::class)->name('show.post');
    //Route::get('/postagem/editar/{id}', EditPost::class)->name('edit.post');
    //Route::put('/postagem/update/{id}', EditPost::class)->name('update.post');
});
