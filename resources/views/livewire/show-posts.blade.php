<div>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Postagens') }}
      </h2>
  </x-slot>

    <section>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-5 justify-items-center">
            @if($posts->isNotEmpty())
                <p class="text-sm text-gray-600">Última postagem {{ $posts[0]->created_at->diffForHumans() }}</p>
            @else
                <p class="text-sm text-gray-600">Sem postagens por aqui :(</p>
            @endif
            <form class="mt-3">
                <div class="flex">
                    <select wire:model="category_id" class="items-center py-2.5 text-sm text-gray-900 bg-gray-100 border border-gray-300 rounded-l-lg hover:bg-gray-200 focus:ring-orange-300 focus:border-orange-300">
                        <option value="">Categorias</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <div class="relative w-full">
                        <input wire:model="searchTerm" type="search" id="search-dropdown" class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-r-lg border-l-gray-50 border-l-2 border border-gray-300 focus:ring-orange-300 focus:border-orange-300" placeholder="Pesquise o título" required>
                    </div>
                </div>
            </form>
            <div class="grid gap-2 lg:grid-cols-3 justify-center">
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

                                @if(!empty($post->sentiment_score) && $post->sentiment_score >= 1.0 or $post->sentiment_score > 0.5)
                                    <span class="text-xs pb-3 pt-2 text-gray-500">Score de sentimentos:</span>
                                    <div class="flex items-center">
                                        <p class="text-xs pb-3 pt-2 text-gray-500">{{ $post->sentiment_score }}% </p>
                                        <img class="w-8" src="{{ asset('imgs/arrow_up.svg') }}" />
                                        <img data-tooltip-target="tooltip-green" style="width: 20px; height: 20px" src="{{ asset('imgs/info-fill.svg') }}">
                                        <div id="tooltip-green" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 transition-opacity duration-300 tooltip dark:bg-gray-700">
                                            Este ícone em <span class="text-lime-500">verde</span> indica uma postagem <br />
                                            com análise de sentimentos positiva.
                                            <div class="tooltip-arrow" data-popper-arrow></div>
                                        </div>
                                    </div>
                                @elseif(!empty($post->sentiment_score) && $post->sentiment_score >= 0.5 or $post->sentiment_score >= 0.25)
                                    <span class="text-xs pb-3 pt-2 text-gray-500">Score de sentimentos:</span>
                                    <div class="flex items-center">
                                        <p class="text-xs pb-3 pt-2 text-gray-500">{{ $post->sentiment_score }}% </p>
                                        <img class="w-8" src="{{ asset('imgs/neutral.svg') }}" />
                                        <img data-tooltip-target="tooltip-blue" style="width: 20px; height: 20px" src="{{ asset('imgs/info-fill.svg') }}">
                                        <div id="tooltip-blue" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 transition-opacity duration-300 tooltip dark:bg-gray-700">
                                            Este ícone em <span class="text-cyan-500">azul</span> indica uma postagem <br />
                                            com análise de sentimentos neutro.
                                            <div class="tooltip-arrow" data-popper-arrow></div>
                                        </div>
                                    </div>
                                @elseif(!empty($post->sentiment_score) && $post->sentiment_score < 0.25 or $post->sentiment_score == 0.00 or $post->sentiment_score < 0.00)
                                    <span class="text-xs pb-3 pt-2 text-gray-500">Score de sentimentos:</span>
                                    <div class="flex items-center">
                                        <p class="text-xs pb-3 pt-2 text-gray-500">{{ $post->sentiment_score }}% </p>
                                        <img class="w-8" src="{{ asset('imgs/arrow_down.svg') }}" />
                                        <img data-tooltip-target="tooltip-red" style="width: 20px; height: 20px" src="{{ asset('imgs/info-fill.svg') }}">
                                        <div id="tooltip-red" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 transition-opacity duration-300 tooltip dark:bg-gray-700">
                                            Este ícone em <span class="text-red-500">vermelho</span> indica uma postagem <br />
                                            com análise de sentimentos negativa.
                                            <div class="tooltip-arrow" data-popper-arrow></div>
                                        </div>
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
                                    <div class="flex flex-row">
                                        <div>
                                            <a href="/postagem/editar/{{ $post->id}}">
                                                <span class="sm:block">
                                                  <button type="button" class="inline-flex items-center px-4 py-2 border border-green-500 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                    <svg class="w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                      <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                                    </svg>
                                                  </button>
                                                </span>
                                            </a>
                                        </div>
                                        <div>
                                            <span class="sm:block" data-modal-toggle="popup-modal">
                                              <button wire:click="deleteId({{ $post->id }})" type="button" class="inline-flex items-center px-4 py-2.5 border border-red-500  rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none ml-2">
                                                <svg class="text-red-500" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                </svg>
                                              </button>
                                            </span>
                                            <div wire:ignore.self id="popup-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full">
                                                <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                        <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent  hover:text-gray-400 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="popup-modal">
                                                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                            <span class="sr-only">Close modal</span>
                                                        </button>
                                                        <div class="p-6 text-center">
                                                            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Você quer mesmo deletar essa postagem?</h3>
                                                            <button wire:click.prevent="delete()" data-modal-toggle="popup-modal" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                                                Sim, quero
                                                            </button>
                                                            <button data-modal-toggle="popup-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">não, cancela</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </figcaption>
                            </div>
                        </div>
                    @endforeach
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
