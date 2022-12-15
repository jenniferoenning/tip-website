<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar postagem') }}
        </h2>
    </x-slot>
    <div class="xl:container mx-auto py-5">
      <div class="h-100 w-full grid gap-1 lg:grid-cols-2 justify-center justify-center bg-teal-lightest font-sans">
        <div class="w-full rounded-lg shadow-md lg:max-w-sm max-w-sm bg-white rounded-lg border border-gray-200 shadow-md mt-5 justify-self-center">
            @if ($post_photo_path)
                <img style="height: 256px;" class="w-full object-cover rounded-t-lg" src="{{ $post_photo_path->temporaryUrl() }}" alt="" />
            @else
                <img style="height: 256px;" class="w-full object-cover rounded-t-lg" src="{{ $post->url_image }}" alt="" />
            @endif
            <div class="p-5">
                <h5 class="mb-2 text-1xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $post->title }}</h5>
                <figcaption class="flex items-center space-x-3">
                    <img class="w-9 h-9 rounded-full object-cover" src="{{ url("{$user->profile_photo_url}") }}" alt="profile picture">
                    <div class="space-y-0.5 font-medium dark:text-white text-left">
                        <div>{{ $user->name }}</div>
                    </div>
                </figcaption>
                <div>
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
                </div>
            </div>
        </div>
        <div class="container mx-auto bg-white rounded shadow p-6 mt-4 items-center">
            <div>
                <h1 class="text-lg text-center">Editar postagem</h1>

                <form method="post" wire:submit.prevent="update" enctype="multipart/form-data">
                    @csrf
                    <div class="my-5">
                        <label for="title" class="text-gray-700">{{ __('Título da postagem') }}</label>
                        <br>
                        <input class="border-gray-300 focus:border-orange-300 focus:ring focus:ring-orange-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full" type="text" name="title" id="title" wire:model="title">
                        @error('title') {{ $message }} @enderror
                    </div>


                    <div class="my-5">
                        <label for="description" class="text-gray-700">{{ __('Descrição da postagem') }}</label>
                        <br>
                        <textarea class="border-gray-300 focus:border-orange-300 focus:ring focus:ring-orange-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full" type="text" name="description" id="description" wire:model="description"></textarea> 
                        @error('description') {{ $message }} @enderror
                    </div>
                    
                    <span class="text-gray-700">Categoria</span>
                    <select wire:model="category" name="category" class="border-gray-300 focus:border-orange-300 focus:ring focus:ring-orange-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full">
                        <option class="text-gray-500" wire:model="category_id" required>{{ $post->category->name }}</option>
                        @foreach ($categories as $category)
                            <option class="text-gray-700" value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                     @error('category') {{ $message }} @enderror
                    <div class="my-5">
                        <div class="flex justify-center items-center w-full">
                            <label for="dropzone-file" class="flex flex-col justify-center items-center w-full h-64 bg-gray-50 rounded-lg border-2 border-gray-300 border-dashed cursor-pointer dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                <div class="flex flex-col justify-center items-center pt-5 pb-6">
                                    <svg aria-hidden="true" class="mb-3 w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Clique para enviar a foto</span></p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                                </div>
                                <input id="dropzone-file" type="file" wire:model="post_photo_path" class="hidden" />
                                <div wire:loading wire:target="post_photo_path">Carregando...</div>
                                @error('post_photo_path') {{ $message }} @enderror
                            </label>
                        </div>
                    </div>
                    <div class="text-center bg-orange-400 rounded py-2 px-4 hover:bg-orange-300">
                        <button class="text-white" wire:click = "update()">Editar postagem</button>
                    </div>
                </form>
            </div>
        </div>
      </div>
    </div>
</div>