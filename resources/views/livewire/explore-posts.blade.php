<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Explore') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            @if($posts->isNotEmpty())
                @foreach($posts as $post)
                  <div class="flex pt-3 pb-3 items-center">
                      <p class="w-full text-green">{{ $post->content }}</p>
                    @if ($post->likes->count())
                        <a href="#" wire:click.prevent="unlike({{ $post->id }})">Descurtir</a>
                    @else
                        <a href="#" wire:click.prevent="like({{ $post->id }})">Curtir</a>
                    @endif
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

</div>
