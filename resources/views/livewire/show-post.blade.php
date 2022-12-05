<div class="h-100 w-full justify-center justify-center bg-teal-lightest font-sans pb-5">
    <div class="container mx-auto bg-white rounded shadow p-6 mt-4 items-center">
        <section>
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Postagem') }}
                </h2>
            </x-slot>

        </section>

        <section class="col-span-8 col-start-5 mt-10 space-y-6">
            <div class="xl:container mx-auto my-5">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <h1 class="font-bold text-3xl text-gray-600 break-all"> {{ $post->title}} </h1>
                        <h1 class="text-sm text-gray-600 break-all"> Categoria: {{ $post->category['name']}} </h1>
                        <br>
                        <p class="text-gray-600 break-all">Descrição:</p>
                        <p class="text-gray-600 break-all">{{ $post->description }} </p>
                        <br />
                        @if(!empty($post->sentiment_score) && $post->sentiment_score >= 1.0 or $post->sentiment_score > 0.7)
                            <p class="text-gray-600 break-all">Score de sentimentos:</p>
                            <div class="flex">
                                <p class="text-xs pb-3 pt-2 text-gray-500">{{ $post->sentiment_score }}% </p>
                                <img class="w-8" src="{{ asset('imgs/arrow_up.svg') }}" />
                            </div>
                        @elseif(!empty($post->sentiment_score) && $post->sentiment_score >= 0.7 or $post->sentiment_score >= 0.5 or $post->sentiment_score >= 0.3)
                            <p class="text-gray-600 break-all">Score de sentimentos:</p>
                            <div class="flex">
                                <p class="text-xs pb-3 pt-2 text-gray-500">{{ $post->sentiment_score }}% </p>
                                <img class="w-8" src="{{ asset('imgs/neutral.svg') }}" />
                            </div>
                        @elseif(!empty($post->sentiment_score) && $post->sentiment_score < 0.3)
                            <p class="text-gray-600 break-all">Score de sentimentos:</p>
                            <div class="flex">
                                <p class="text-xs pb-3 pt-2 text-gray-500">{{ $post->sentiment_score }}% </p>
                                <img class="w-8" src="{{ asset('imgs/arrow_down.svg') }}" />
                            </div>
                        @endif
                    </div>
                    <div>
                        @if ($post->post_photo_path)
                            <div class="flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden">
                                <img style="height: 400px;" class="w-full object-cover rounded" src="{{ $post->url_image }}" alt="" />
                            </div>
                        @else
                            <div class="flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden">
                                <img style="height: 400px;" class="w-full object-cover  " src="{{ url('imgs/no-image-thumb.png') }}">
                            </div>
                        @endif
                    </div>
                </div>
                <div class="flex flex-wrap items-center mt-5">
                    <div>
                        <p class="text-sm text-gray-800 py-2 px-2 ">{{ $post->likes->count() }}</p>
                    </div>
                    <div>
                        @if($post->likes->count()) 
                            <a href="#" wire:click.prevent="unlike({{ $post->id }})" class="text-sm self-center border rounded-xl py-3 px-3 text-red-600 hover:bg-gray-200">Descurtir</a>
                        @else
                            <a href="#" wire:click.prevent="like({{ $post->id }})" class="clipboard border rounded-xl sharebtn relative flex z-10 text-sm ml-3 py-3 px-3 hover:bg-gray-200">Curtir</a>
                        @endif 
                    </div>
                    <div>
                        <button data-tooltip-target="tooltip-click" data-tooltip-trigger="click" class="clipboard border rounded-xl sharebtn relative flex z-10 text-sm ml-3 py-2 px-2 hover:bg-gray-200" title="Clique para copiar o url">
                            <span class="inline-block placeholder-gray-400 self-center">Compartilhar</span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="h-5 w-6 my-1 text-gray-500">
                                <path fill="currentColor" d="M352 320c-22.608 0-43.387 7.819-59.79 20.895l-102.486-64.054a96.551 96.551 0 0 0 0-41.683l102.486-64.054C308.613 184.181 329.392 192 352 192c53.019 0 96-42.981 96-96S405.019 0 352 0s-96 42.981-96 96c0 7.158.79 14.13 2.276 20.841L155.79 180.895C139.387 167.819 118.608 160 96 160c-53.019 0-96 42.981-96 96s42.981 96 96 96c22.608 0 43.387-7.819 59.79-20.895l102.486 64.054A96.301 96.301 0 0 0 256 416c0 53.019 42.981 96 96 96s96-42.981 96-96-42.981-96-96-96z">
                                </path>
                            </svg>
                        </button> 
                        <div id="tooltip-click" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 transition-opacity duration-300 tooltip dark:bg-gray-700">
                            Url copiado!
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="xl:container mx-auto my-5">
                @auth
                <form method="POST" action="/posts/{{ $post->slug }}/comentarios">
                @csrf
                    <div class="mb-4 w-full bg-gray-50 rounded-lg border border-gray-200 dark:bg-gray-700 dark:border-gray-600">
                       <div class="py-2 px-4 bg-white rounded-b-lg dark:bg-gray-800">
                           <textarea name="body" rows="8" class="block px-0 w-full text-sm text-gray-800 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400" placeholder="Escreva um comentário..."></textarea>
                       </div>
                    </div>
                    <div class="flex">
                        <div>
                            <img class="w-10 h-10 mr-4 rounded-full object-cover" src="{{ url("{$user->profile_photo_url}") }}" alt="{{ $user->name }}">
                        </div>
                        <div class="flex">
                            <button type="submit" class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white bg-orange-300 rounded-lg focus:ring-4 focus:ring-orange-400 hover:bg-orange-400">
                            Publicar comentário
                            </button>
                        </div>
                    </div>
                </form>
                @else
                    <p class="font-semibold">
                        <a href="/register" class="hover:underline">Registre para comentar!</a> ou
                        <a href="/login" class="hover:underline">Log in</a> para comentar.
                    </p>
                @endauth
                @if($comments->isNotEmpty())
                    @foreach($comments as $comment)
                        <section class="col-span-8 col-start-5 mt-10 space-y-6">
                            <article class="bg-gray-50 border border-gray-100 p-6 rounded-xl rounded">
                                <div class="flex space-x-4">
                                    <div class="flex-shrink-0">
                                        <img src="{{ url("{$comment->author->profile_photo_url}") }}" alt="{{ $user->name }}" width="60" height="60" class="rounded">
                                    </div>
                                    <header>
                                        <h3 class="front-bold">{{ $comment->author->name }}</h3>
                                        <p class="text-xs text-gray-600">Postado {{ $comment->author->created_at->diffForHumans() }}</p>
                                    </header>
                                </div>
                                <br>
                                <div>
                                    <p class="break-all">{{ $comment->body }}</p>
                                </div>
                            </article>
                        </section>
                    @endforeach
                @else 
                    <div class="my-5 pt-5">
                        <h2 class="text-gray-600 text-sm">Nenhum comentário...</h2>
                    </div>
                @endif
                <div class="max-w-7xl mx-auto lg:px-8">
                    <div class="py-5">
                        @if($links->links())
                            {{ $links->links() }}
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>