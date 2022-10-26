<?php
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\{
    ShowPosts
};

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/explorar', function () {
        return view('explorar');
    })->name('explorar');
    
    Route::get('postagens', ShowPosts::class)->name('posts');

});
