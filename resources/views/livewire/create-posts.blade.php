<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nova postagem') }}
        </h2>
    </x-slot>

    <div class="xl:container mx-auto my-5">
      <div class="lg:flex lg:items-center lg:justify-between">
          <div class="mt-5 flex lg:mt-0 lg:ml-4">
            <span class="ml-3 relative sm:hidden">
              <button type="button" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" id="mobile-menu" aria-haspopup="true">
                Mais
                <svg class="-mr-1 ml-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
              </button>
              <div class="origin-top-right absolute right-0 mt-2 -mr-1 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5" aria-labelledby="mobile-menu" role="menu">
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Edit</a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">View</a>
              </div>
            </span>
          </div>
      </div>
      <div class="h-100 w-full flex items-center justify-center bg-teal-lightest font-sans">
        <div class="xl:container bg-white rounded shadow p-6 mt-4">
            <div>
                <form method="post" wire:submit.prevent="create">
                    <input type="text" name="content" id="content" wire:model="content">
                    @error('content') {{ $message }} @enderror
                    <button type="submit">Criar postagem</button>
                </form>
            </div>
        </div>
      </div>
    </div>
</div>
