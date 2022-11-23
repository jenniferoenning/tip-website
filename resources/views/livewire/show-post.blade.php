<div class="h-100 w-full justify-center justify-center bg-teal-lightest font-sans pb-5">
    <div class="container mx-auto bg-white rounded shadow p-6 mt-4 items-center">
        <section>
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Postagem') }}
                </h2>
            </x-slot>

            <div class="xl:container mx-auto my-5">
                <h1 class="text-2xl text-gray-600"> {{ $post->title}} </h1>
                <h1 class="text-2xl text-gray-600"> {{ $post->category['name']}} </h1>
                <div class="max-w-sm w-full lg:max-w-full lg:flex justify-center">
                    @if ($post->post_photo_path)
                        <div class="flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden">
                            <img  style="height: 400px;" class="w-full object-cover rounded" src="{{ $post->url_image }}" alt="" />
                        </div>
                    @else
                        <div class="bg-center h-48 lg:h-auto lg:w-48 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden">
                            <img src="{{ url('imgs/no-image-thumb.png') }}">
                        </div>
                    @endif
                </div>
            </div>
        </section>

        <section class="col-span-8 col-start-5 mt-10 space-y-6">
            <div class="xl:container mx-auto my-5">
                <div class="max-w-sm w-full lg:max-w-full lg:flex mb-5">
                    <div class="mr-3">
                        <p class="text-sm text-gray-800 py-2 px-2 ">{{ $post->likes->count() }}</p>
                    </div>
                    @if($post->likes->count()) 
                        <a href="#" wire:click.prevent="unlike({{ $post->id }})" class="text-sm border rounded-xl py-2 px-2 text-red-600 hover:bg-gray-200">Descurtir</a>
                    @else
                        <a href="#" wire:click.prevent="like({{ $post->id }})" class="text-sm border rounded-xl py-2 px-2 hover:bg-gray-200">Curtir</a>
                    @endif 

                    <button data-tooltip-target="tooltip-click" data-tooltip-trigger="click" class="clipboard border rounded-xl sharebtn relative flex z-10 text-sm ml-3 py-2 px-2 hover:bg-gray-200" title="Clique para copiar o url">
                        <span class="inline-block placeholder-gray-400">Compartilhar</span>
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
                            Públicar comentário
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
            </div>
        </section>
        @if($comments->isNotEmpty())
            @foreach($comments as $comment)
                <section class="col-span-8 col-start-5 mt-10 space-y-6">
                    <div class="xl:container mx-auto my-5">
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
                                <p>{{ $comment->body }}</p>
                            </div>
                        </article>
                    </div>
                </section>
            @endforeach
        @else 
            <div class="xl:container mx-auto my-5 pt-5">
                <h2>Nenhum comentário...</h2>
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
</div>