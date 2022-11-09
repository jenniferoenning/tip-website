<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Explore') }}
        </h2>
    </x-slot>

    <section>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-5 grid gap-2 lg:grid-cols-3 justify-items-center">
            @if($posts->isNotEmpty())
                @foreach($posts as $post)
                    <div class="w-full rounded-lg shadow-md lg:max-w-sm max-w-sm bg-white rounded-lg border border-gray-200 shadow-md mt-5">
                        @if ($post->post_photo_path)
                            <a href="post/{{ $post->slug }}">
                                <img style="height: 256px;" class="w-full object-cover rounded-t-lg" src="{{ url("storage/{$post->post_photo_path}") }}" alt="" />
                            </a>
                        @else
                           <a href="post/{{ $post->slug }}">
                                <img style="height: 256px;" class="w-full object-cover rounded-t-lg" src="{{ url('imgs/no-image-thumb.png') }}" alt="" />
                            </a>
                        @endif
                        <div class="p-5">
                            <a href="post/{{ $post->slug }}">
                                <h5 class="mb-2 text-1xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $post->title }}</h5>
                            </a>
                            <figcaption class="flex items-center space-x-3">
                                <img class="w-9 h-9 rounded-full object-cover" src="{{ url("{$post->user->profile_photo_url}") }}" alt="{{ $post->user->name }}">
                                <div class="space-y-0.5 font-medium dark:text-white text-left">
                                    <div>{{ $post->user->name }}</div>
                                    <div class="text-sm font-light text-gray-500 dark:text-gray-400">
                                        <div class="grid gap-2 lg:grid-cols-3">
                                            <div class="flex items-center">
                                                <img class="mr-2" width="15" height="15" src="{{ asset('imgs/heart.svg') }}">
                                                <p>1.500</p>
                                            </div>
                                            <div class="flex items-center">
                                                <img class="mr-2" width="15" height="15" src="{{ asset('imgs/comment.svg') }}">
                                                <p>20</p>
                                            </div>
                                            <div class="flex items-center">
                                                <img class="mr-2" width="20" height="15" src="{{ asset('imgs/visibility.svg') }}">
                                                <p>23.232</p>
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
    </section>
</div>
