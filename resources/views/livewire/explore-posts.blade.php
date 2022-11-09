<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Explore') }}
        </h2>
    </x-slot>

    <section>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-5 justify-items-center">
            <form class="mt-3">
                <div class="flex">
                    <label for="search-dropdown" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-gray-300">Seu e-mail</label>
                    <button id="dropdown-button" data-dropdown-toggle="dropdown" class="flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-900 bg-gray-100 border border-gray-300 rounded-l-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700 dark:text-white dark:border-gray-600" type="button">Categorias <svg aria-hidden="true" class="ml-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg></button>
                    <div id="dropdown" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700" data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="top" style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate3d(897px, 5637px, 0px);">
                        <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdown-button">
                        <li>
                            <button type="button" class="inline-flex py-2 px-4 w-full hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Animais</button>
                        </li>
                        <li>
                            <button type="button" class="inline-flex py-2 px-4 w-full hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Comidas</button>
                        </li>
                        <li>
                            <button type="button" class="inline-flex py-2 px-4 w-full hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Periféricos</button>
                        </li>
                        <li>
                            <button type="button" class="inline-flex py-2 px-4 w-full hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Logos</button>
                        </li>
                        </ul>
                    </div>
                    <div class="relative w-full">
                        <input wire:model="searchTerm" type="search" id="search-dropdown" class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-r-lg border-l-gray-50 border-l-2 border border-gray-300 focus:ring-orange-300 focus:border-orange-300" placeholder="Pesquise o título" required>
                        <button type="submit" class="absolute top-0 right-0 p-2.5 text-sm font-medium text-white bg-orange-300 rounded-r-lg border border-orange-300 hover:bg-orange-400 focus:ring-4 focus:outline-none focus:ring-orange-300">
                            <svg aria-hidden="true" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            <span class="sr-only">Search</span>
                        </button>
                    </div>
                </div>
            </form>
            <div class="grid gap-2 lg:grid-cols-3 justify-center">
                @if($posts->isNotEmpty())
                    @foreach($posts as $post)
                        <div class="w-full rounded-lg shadow-md lg:max-w-sm max-w-sm bg-white rounded-lg border border-gray-200 shadow-md mt-5">
                            @if ($post->post_photo_path)
                                <a href="postagem/{{ $post->slug }}" :active="request()->routeIs('show.post')">
                                    <img style="height: 256px;" class="w-full object-cover rounded-t-lg" src="{{ url("storage/{$post->post_photo_path}") }}" alt="" />
                                </a>
                            @else
                               <a href="postagem/{{ $post->slug }}" :active="request()->routeIs('show.post')">
                                    <img style="height: 256px;" class="w-full object-cover rounded-t-lg" src="{{ url('imgs/no-image-thumb.png') }}" alt="" />
                                </a>
                            @endif
                            <div class="px-5 pb-5">
                                <p class="text-xs pb-3 pt-2 text-gray-500">Postado {{ $post->created_at->diffForHumans() }}</p>
                                <a href="postagem/{{ $post->slug }}" :active="request()->routeIs('show.post')">
                                    <h5 class="mb-2 text-1xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $post->title }}</h5>
                                </a>
                                <figcaption class="flex flex-row items-center space-x-3">
                                    <img class="w-9 h-9 rounded-full object-cover" src="{{ url("{$post->user->profile_photo_url}") }}" alt="{{ $post->user->name }}">
                                    <div class="space-y-0.5 font-medium dark:text-white text-left">
                                        <div>{{ $post->user->name }}</div>
                                        <div class="text-sm font-light text-gray-500 dark:text-gray-400">
                                            <div class="grid gap-2 lg:grid-cols-3">
                                                <div class="flex items-center">
                                                    <img class="mr-2" width="15" height="15" src="{{ asset('imgs/heart.svg') }}">
                                                    <p>1.500</p>
                                                </div>
                                                <div class="flex items-center ml-2">
                                                    <img class="mr-2" width="15" height="15" src="{{ asset('imgs/comment.svg') }}">
                                                    <p>20</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </figcaption>
                            </div>
                        </div>
                    @endforeach
                @else 
                    <div>
                        <h2>Nenhum post</h2>
                    </div>
                @endif
            </div>
        </div>
        <div class="max-w-7xl mx-auto lg:px-8">
            <div class="py-5">
              {{ $posts->links() }}
            </div>
        </div>
    </section>
</div>
