<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Explore') }}
        </h2>
    </x-slot>

    <section>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-5 justify-items-center">
            <div>
                <form class="mt-3">
                    <div class="md:flex text-left mx-8">
                        <select wire:model="category_id" class="items-center py-2.5 text-sm text-gray-900 bg-gray-100 border border-gray-300 md:rounded-l-lg hover:bg-gray-200 focus:ring-orange-300 focus:border-orange-300 mb-2">
                            <option value="">Categorias</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <div class="relative w-full">
                            <input wire:model="searchTerm" type="search" id="search-dropdown" class="p-2.5 md:w-full z-20 text-sm text-gray-900 bg-gray-50 md:border-l-gray-50 border-l-2 border border-gray-300 focus:ring-orange-300 focus:border-orange-300 mb-2" placeholder="Pesquise o título" required>
                        </div>
                        <select wire:model="sentiment_score" class="items-center py-2.5 text-sm text-gray-900 bg-gray-100 border border-gray-300 md:rounded-r-lg hover:bg-gray-200 focus:ring-orange-300 focus:border-orange-300 mb-2">
                            <option value="">Relevâncias</option>
                            <option value="1">Análises relevantes</option>
                            <option value="2">Análises menos relevantes</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="grid gap-2 lg:grid-cols-3 justify-items-center">
                @if($posts->isNotEmpty())
                    @foreach($posts as $post)
                        <div class="w-full rounded-lg shadow-md lg:max-w-sm max-w-sm bg-white rounded-lg border border-gray-200 shadow-md mt-5">
                            @if ($post->post_photo_path)
                                <a href="postagem/{{ $post->slug }}" :active="request()->routeIs('show.post')">
                                    <img style="height: 256px;" class="w-full object-cover rounded-t-lg" src="{{ $post->url_image }}" alt="" />
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
                                <p class="text-xs pb-3 pt-2 text-gray-500">Categoria: {{ $post->category['name'] }}</p>
                                @if(!empty($post->sentiment_score) && $post->sentiment_score >= 1.0 or $post->sentiment_score > 0.7)
                                    <span class="text-xs pb-3 pt-2 text-gray-500">Score de sentimentos:</span>
                                    <div class="flex">
                                        <p class="text-xs pb-3 pt-2 text-gray-500">{{ $post->sentiment_score }}% </p>
                                        <img class="w-8" src="{{ asset('imgs/arrow_up.svg') }}" />
                                    </div>
                                @elseif(!empty($post->sentiment_score) && $post->sentiment_score >= 0.7 or $post->sentiment_score >= 0.5 or $post->sentiment_score >= 0.3)
                                    <span class="text-xs pb-3 pt-2 text-gray-500">Score de sentimentos:</span>
                                    <div class="flex">
                                        <p class="text-xs pb-3 pt-2 text-gray-500">{{ $post->sentiment_score }}% </p>
                                        <img class="w-8" src="{{ asset('imgs/neutral.svg') }}" />
                                    </div>
                                @elseif(!empty($post->sentiment_score) && $post->sentiment_score < 0.3)
                                    <span class="text-xs pb-3 pt-2 text-gray-500">Score de sentimentos:</span>
                                    <div class="flex">
                                        <p class="text-xs pb-3 pt-2 text-gray-500">{{ $post->sentiment_score }}% </p>
                                        <img class="w-8" src="{{ asset('imgs/arrow_down.svg') }}" />
                                    </div>
                                @endif
                                <figcaption class="flex flex-row items-center space-x-3">
                                    <img class="w-9 h-9 rounded-full object-cover" src="{{ url("{$post->user->profile_photo_url}") }}" alt="{{ $post->user->name }}">
                                    <div class="space-y-0.5 font-medium dark:text-white text-left">
                                        <div>{{ $post->user->name }}</div>
                                        <div class="text-sm font-light text-gray-500 dark:text-gray-400">
                                            <div class="flex flex-wrap items-center">
                                                <div class="flex items-center">
                                                    <img class="mr-2" width="15" height="15" src="{{ asset('imgs/heart.svg') }}">
                                                    <p>{{ $post->likes->count() }}</p>
                                                </div>
                                                <div class="flex items-center ml-2">
                                                    <img class="mr-2" width="15" height="15" src="{{ asset('imgs/comment.svg') }}">
                                                    <p>{{ $post->comments->count() }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </figcaption>
                            </div>
                        </div>
                    @endforeach
                @else 
                    <div class="mt-5">
                        <h2>Nenhuma postagem por aqui...</h2>
                    </div>
                @endif
            </div>
        </div>
        <div class="flex items-center justify-center mt-10">
            <div wire:loading style="border-top-color: transparent;" class="w-16 h-16 border-4 border-orange-400 border-solid rounded-full animate-spin"></div>
        </div>
        <div class="max-w-7xl mx-auto lg:px-8">
            <div class="py-5">
                
                {{ $posts->links() }}
            </div>
        </div>
    </section>
</div>
