<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="{{ asset('imgs/tip_logo.svg') }}">
        <title>{{ config('app.name', 'Tip') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <!-- Styles -->
        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-t{border-top-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.dark\:text-gray-500{--tw-text-opacity:1;color:#6b7280;color:rgba(107,114,128,var(--tw-text-opacity))}}
        </style>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased flex h-full flex-col bg-gray-100">
        <section>
            <div class="bg-orange-300">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 pt-20 text-center">
                    @if (Route::has('login'))
                        <div class="fixed top-0 right-0 px-6 py-4 sm:block">
                            @auth
                                <a href="{{ url('/explorar') }}" class="text-sm text-white font-extrabold">Explorar</a>
                            @else
                                @if (Route::has('register'))
                                <button class="bg-orange-400 rounded py-2 px-4 hover:bg-orange-500">
                                    <a href="{{ route('register') }}" class="text-sm text-white font-extrabold">Cadastrar</a>
                                </button>
                                @endif

                                <a href="{{ route('login') }}" class="ml-4 text-sm text-white font-extrabold">Entrar</a>
                            @endauth
                        </div>
                    @endif
                </div>
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 pt-20 pb-16 text-center">
                    <img class="inline-flex h-20 w-20 mb-5" src="{{ asset('imgs/tip-logo-white.png') }}">
                    <h1 class="text-white font-extrabold text-5xl">TIP</h1>
                    <span class="text-white font-extrabold text-2xl">Tranformar ideias em postagens</span>
                </div>
            </div>
        </section>
        <section>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-5 grid gap-2 lg:grid-cols-3 justify-items-center">
                <div class="w-full rounded-lg shadow-md lg:max-w-sm max-w-sm bg-white rounded-lg border border-gray-200 shadow-md mt-5">
                    <a href="/login">
                        <img style="height: 256px;" class="w-full object-cover rounded-t-lg" src="https://images.pexels.com/photos/10225549/pexels-photo-10225549.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="" />
                    </a>
                    <div class="p-5">
                        <a href="/login">
                            <h5 class="mb-2 text-1xl font-bold tracking-tight text-gray-900 dark:text-white">Lorem Ipsum is simply dummy text of the printing and typesetting</h5>
                        </a>
                        <figcaption class="flex items-center space-x-3">
                            <img class="w-9 h-9 rounded-full object-cover" src="https://images.pexels.com/photos/774909/pexels-photo-774909.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="profile picture">
                            <div class="space-y-0.5 font-medium dark:text-white text-left">
                                <div>Jese Leos</div>
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
                <div class="w-full rounded-lg shadow-md lg:max-w-sm max-w-sm bg-white rounded-lg border border-gray-200 shadow-md mt-5">
                    <a href="/login">
                        <img style="height: 256px;" class="w-full object-cover rounded-t-lg" src="https://images.pexels.com/photos/12290139/pexels-photo-12290139.jpeg?auto=compress&cs=tinysrgb&w=1600&lazy=load" alt="" />
                    </a>
                    <div class="p-5">
                        <a href="/login">
                            <h5 class="mb-2 text-1xl font-bold tracking-tight text-gray-900 dark:text-white">Lorem Ipsum is simply dummy text of the printing and typesetting</h5>
                        </a>
                        <figcaption class="flex items-center space-x-3">
                            <img class="w-9 h-9 rounded-full object-cover" src="https://images.pexels.com/photos/774909/pexels-photo-774909.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="profile picture">
                            <div class="space-y-0.5 font-medium dark:text-white text-left">
                                <div>Jese Leos</div>
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
                <div class="w-full rounded-lg shadow-md lg:max-w-sm max-w-sm bg-white rounded-lg border border-gray-200 shadow-md mt-5">
                    <a href="/login">
                        <img style="height: 256px;" class="w-full object-cover rounded-t-lg" src="https://images.pexels.com/photos/14270255/pexels-photo-14270255.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="" />
                    </a>
                    <div class="p-5">
                        <a href="/login">
                            <h5 class="mb-2 text-1xl font-bold tracking-tight text-gray-900 dark:text-white">Lorem Ipsum is simply dummy text of the printing and typesetting</h5>
                        </a>
                        <figcaption class="flex items-center space-x-3">
                            <img class="w-9 h-9 rounded-full object-cover" src="https://images.pexels.com/photos/774909/pexels-photo-774909.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="profile picture">
                            <div class="space-y-0.5 font-medium dark:text-white text-left">
                                <div>Jese Leos</div>
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
                <div class="w-full rounded-lg shadow-md lg:max-w-sm max-w-sm bg-white rounded-lg border border-gray-200 shadow-md mt-5">
                    <a href="/login">
                        <img style="height: 256px;" class="w-full object-cover rounded-t-lg" src="https://images.pexels.com/photos/13903187/pexels-photo-13903187.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="" />
                    </a>
                    <div class="p-5">
                        <a href="/login">
                            <h5 class="mb-2 text-1xl font-bold tracking-tight text-gray-900 dark:text-white">Lorem Ipsum is simply dummy text of the printing and typesetting</h5>
                        </a>
                        <figcaption class="flex items-center space-x-3">
                            <img class="w-9 h-9 rounded-full object-cover" src="https://images.pexels.com/photos/774909/pexels-photo-774909.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="profile picture">
                            <div class="space-y-0.5 font-medium dark:text-white text-left">
                                <div>Jese Leos</div>
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
                <div class="w-full rounded-lg shadow-md lg:max-w-sm max-w-sm bg-white rounded-lg border border-gray-200 shadow-md mt-5">
                    <a href="/login">
                        <img style="height: 256px;" class="w-full object-cover rounded-t-lg" src="https://images.pexels.com/photos/13756268/pexels-photo-13756268.jpeg?auto=compress&cs=tinysrgb&w=1600&lazy=load" alt="" />
                    </a>
                    <div class="p-5">
                        <a href="/login">
                            <h5 class="mb-2 text-1xl font-bold tracking-tight text-gray-900 dark:text-white">Lorem Ipsum is simply dummy text of the printing and typesetting</h5>
                        </a>
                        <figcaption class="flex items-center space-x-3">
                            <img class="w-9 h-9 rounded-full object-cover" src="https://images.pexels.com/photos/2220401/pexels-photo-2220401.jpeg?dpr=1" alt="profile picture">
                            <div class="space-y-0.5 font-medium dark:text-white text-left">
                                <div>Jese Leos</div>
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
                <div class="w-full rounded-lg shadow-md lg:max-w-sm max-w-sm bg-white rounded-lg border border-gray-200 shadow-md mt-5">
                    <a href="/login">
                        <img style="height: 256px;" class="w-full object-cover rounded-t-lg" src="https://images.pexels.com/photos/598917/pexels-photo-598917.jpeg?auto=compress&cs=tinysrgb&w=1600" alt="" />
                    </a>
                    <div class="p-5">
                        <a href="/login">
                            <h5 class="mb-2 text-1xl font-bold tracking-tight text-gray-900 dark:text-white">Lorem Ipsum is simply dummy text of the printing and typesetting</h5>
                        </a>
                        <figcaption class="flex items-center space-x-3">
                            <img class="w-9 h-9 rounded-full object-cover" src="https://images.pexels.com/photos/774909/pexels-photo-774909.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="profile picture">
                            <div class="space-y-0.5 font-medium dark:text-white text-left">
                                <div>Jese Leos</div>
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
            </div>
        </section>
        <footer class="bg-blue-200 py-8 mt-5">
            <p class="text-gray-700 font-extrabold text-center">Copyright © 2022 Tip. All Rights Reseverd</p>
        </footer>
        <script src="../path/to/flowbite/dist/flowbite.js"></script>
        <script src="https://unpkg.com/flowbite@1.5.3/dist/flowbite.js"></script>
    </body>
</html>
