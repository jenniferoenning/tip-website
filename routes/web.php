<?php
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\{
    ShowPosts,
    CreatePosts,
    ExplorePosts
};
use App\Http\Livewire\User\UploadPhoto;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {

    Route::get('explorar', ExplorePosts::class)->name('explorar');
    Route::get('postagens', ShowPosts::class)->name('posts');
    Route::get('/novo_post', CreatePosts::class)->name('create.posts');
    Route::get('/upload', UploadPhoto::class)->name('upload.photo.user');

});
