<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nova postagem') }}
        </h2>
    </x-slot>

    <div class="xl:container mx-auto my-5">
      <div class="h-100 w-full flex items-center justify-center bg-teal-lightest font-sans">
        <div class="xl:container bg-white rounded shadow p-6 mt-4">
            <div>
                <form method="post" wire:submit.prevent="create" enctype="multipart/form-data">
                    @if ($post_photo_path)
                        <div class="mb-4">
                            <img src="{{ $post_photo_path->temporaryUrl() }}" style="max-width: 200px;">
                        </div>
                    @endif
                    <label for="title">{{ __('Título da postagem') }}</label>
                    <br>

                    <input type="text" name="title" id="title" wire:model="title" placeholder="Título da sua postagem">
                    @error('title') {{ $message }} @enderror
                    <br>
                    <label for="description">{{ __('Descrição da postagem') }}</label>
                    <br>
                    <input type="text" name="description" id="description" wire:model="description" placeholder="Descrição da sua postagem">
                    @error('description') {{ $message }} @enderror

                    <br>
                    <input type="file" wire:model="post_photo_path">
                    @error('post_photo_path') {{ $message }} @enderror
                    <br>
                    <button type="submit">Criar postagem</button>
                </form>
            </div>
        </div>
      </div>
    </div>
</div>