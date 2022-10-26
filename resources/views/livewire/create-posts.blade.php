<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nova postagem') }}
        </h2>
    </x-slot>

    <div class="xl:container mx-auto my-5">
        <div>
            <form method="post" wire:submit.prevent="create">
                <input type="text" name="content" id="content" wire:model="content">
                @error('content') {{ $message }} @enderror
                <button type="submit">Criar postagem</button>
            </form>
        </div>
    </div>
</div>
