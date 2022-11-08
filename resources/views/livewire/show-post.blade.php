<div>
    <section>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Postagem') }}
            </h2>
        </x-slot>

        <div class="xl:container mx-auto my-5">
            <div class="max-w-sm w-full lg:max-w-full lg:flex">

                @if ($post->post_photo_path)
                    <div class="h-48 lg:h-auto lg:w-48 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden" style="background-image: url('{{ url("storage/{$post->post_photo_path}") }}')" title="{{ $post->user->name }}">
                    </div>
                @else
                    <div class="bg-center h-48 lg:h-auto lg:w-48 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden" style="background-image: url('{{ url('imgs/no-image-thumb.png') }}')" title="{{ $post->user->name }}">
                    </div>
                @endif
              <div class="border-r border-b border-l border-gray-400 lg:border-l-0 lg:border-t lg:border-gray-400 bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal">
                <div class="mb-8">
                  <p class="text-sm text-gray-600 flex items-center">
                    <svg class="fill-current text-gray-500 w-3 h-3 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                      <path d="M4 8V6a6 6 0 1 1 12 0v2h1a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-8c0-1.1.9-2 2-2h1zm5 6.73V17h2v-2.27a2 2 0 1 0-2 0zM7 6v2h6V6a3 3 0 0 0-6 0z" />
                    </svg>
                    Members only
                  </p>
                  <div class="text-gray-900 font-bold text-xl mb-2">{{ $post->title }}</div>
                  <p class="text-gray-700 text-base">{{ $post->description }}</p>
                </div>
                <div class="flex items-center">
                    <img class="w-10 h-10 rounded-full mr-4" src="{{ url("{$post->user->profile_photo_url}") }}" alt="{{ $post->user->name }}">
                    <div class="text-sm">
                        <p class="text-gray-900 leading-none">{{ $post->user->name }}</p>
                        <p class="text-gray-600">{{ $post->created_at->diffForHumans() }}</p>
                    </div>
                </div>
              </div>
            </div>
        </div>
    </section>

    <section class="col-span-8 col-start-5 mt-10 space-y-6">
        @auth
            <form method="POST" action="/posts/{{ $post->slug }}/comentarios" class="border border-gray-200 p-6 rounded-xl">
                @csrf

                <header class="flex items-center">
                    <img class="w-10 h-10 rounded-full mr-4" src="{{ url("{$post->user->profile_photo_url}") }}" alt="{{ $post->user->name }}">
                    <h2 class="ml-4">Você quer comentar?</h2>
                </header>


                <div class="mt-6">
                    <textarea name="body" class="w-full text-sm focus:outline-none focus:ring" cols="30" rows="10" placeholder="Escreva aqui seu feedback!"></textarea>
                </div>

                <div class="flex justify-end mt-10">
                    <button type="submit" class="bg-blue-500 text-white uppercase font-semibold text-xs py-2 px-10 rounded-2xl hover:bg-blue-600">Postar comentário</button>
                </div>
            </form>
        @else
            <p class="font-semibold">
                <a href="/register" class="hover:underline">Registre para comentar!</a> ou
                <a href="/login" class="hover:underline">Log in</a> para comentar.
            </p>
        @endauth
        
    </section>


    <section class="col-span-8 col-start-5 mt-10 space-y-6">
        <article class="flex bg-gray-200 border border-gray-300 p-6 rounded-xl rounded space-x-4">
            <div class="flex-shrink-0">
                <img src="{{ url("{$post->user->profile_photo_url}") }}" alt="{{ $post->user->name }}" width="60" height="60" class="rounded">
            </div>
            <header>
                <h3 class="front-bold">{{ $post->user->name }}</h3>
                <p class="text-xs">Postado <time>8 meses atrás</time></p>
            </header>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
        </article>
    </section>
</div>