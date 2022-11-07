<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Explore') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($posts->isNotEmpty())
                @foreach($posts as $post)
                        <div class="max-w-sm w-full lg:max-w-full lg:flex">

                            @if ($post->post_photo_path)
                                <div class="h-48 lg:h-auto lg:w-48 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden" style="background-image: url('{{ url("storage/{$post->post_photo_path}") }}')" title="{{ $post->user->name }}">
                                </div>
                            @else
                                <div class="bg-center h-48 lg:h-auto lg:w-48 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden" style="background-image: url('{{ url('imgs/no-image-thumb.png') }}')" title="{{ $post->user->name }}">
                                </div>
                            @endif
                            <a href="post/{{ $post->id }}">
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
                                        @if ($post->user->profile_photo_url)
                                            <img class="w-10 h-10 rounded-full mr-4" src="{{ url("{$post->user->profile_photo_url}") }}" alt="{{ $post->user->name }}">
                                        @else
                                            <img class="w-10 h-10 rounded-full mr-4" src="{{ url('imgs/no-image.png') }}" alt="{{ $post->user->name }}">
                                        @endif

                                        <div class="text-sm">
                                            <p class="text-gray-900 leading-none">{{ $post->user->name }}</p>
                                            <p class="text-gray-600">{{ $post->created_at->format('m/d/Y') }}</p>
                                        </div>
                                        <div class="text-sm">
                                            @if ($post->likes->count())
                                                <a href="#" wire:click.prevent="unlike({{ $post->id }})">Descurtir</a>
                                            @else
                                                <a href="#" wire:click.prevent="like({{ $post->id }})">Curtir</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                @endforeach
            @else 
                <div>
                    <h2>Nenhum post</h2>
                </div>
            @endif
        </div>
    </div>
</div>
