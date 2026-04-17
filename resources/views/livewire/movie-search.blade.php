<div class="w-full min-h-screen flex flex-col">

    {{-- HEADER --}}
    <div class="flex items-center justify-between px-8 py-4 bg-black/80 backdrop-blur-md fixed w-full z-50">
        <h1 class="text-red-600 text-2xl font-bold tracking-wide">
            AI MOVIES
        </h1>

        {{-- AUTH UI --}}
        <div class="flex items-center gap-4">
            {{-- якщо не авторизований --}}
            {{-- @guest --}}
            <button class="text-sm text-white hover:text-gray-300">Login</button>
            <button class="bg-red-600 px-4 py-1 rounded hover:bg-red-700 text-sm">
                Register
            </button>
            {{-- @endguest --}}

            {{-- якщо авторизований --}}
            {{-- @auth --}}
            {{-- <span class="text-sm text-gray-300">Hi, Volodymyr</span> --}}
            {{-- @endauth --}}
        </div>
    </div>

    {{-- HERO --}}
    <div class="flex flex-col items-center justify-center text-center flex-1 px-4">

        <h2 class="text-4xl md:text-5xl font-bold mb-6">
            Find your next movie 🎬
        </h2>

        <p class="text-gray-400 mb-6 max-w-xl">
            Describe anything — plot, vibe, actors — AI will find it.
        </p>

        {{-- SEARCH --}}
        <div class="flex gap-2 w-full max-w-xl">
            <input type="text" wire:model="query" placeholder="Try: time travel romance with sad ending..."
                class="w-full bg-black/70 border border-gray-700 px-4 py-3 rounded text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-600" />

            <button wire:click="search" wire:loading.attr="disabled"
                class="bg-red-600 hover:bg-red-700 px-6 rounded font-semibold disabled:opacity-50">
                <span wire:loading.remove>Search</span>
                <span wire:loading>...</span>
            </button>
        </div>

        {{-- LOADING --}}
        <div wire:loading class="flex justify-center mt-10">
            <div class="animate-spin h-10 w-10 border-4 border-red-600 border-t-transparent rounded-full"></div>
        </div>

        @if($error)
            <div class="flex flex-col items-center justify-center mt-10 text-center">
                <h2 class="text-xl font-semibold mb-2">😬 Oops...</h2>
                <p class="text-gray-400">{{ $error }}</p>
            </div>
        @endif
    </div>



    {{-- RESULTS --}}
    <div wire:loading.remove class="px-6 pb-10">

        @if(count($movies))
            <h2 class="text-xl font-semibold mb-6 text-center md:text-left">
                Results
            </h2>

            <div class="grid gap-6 grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5">

                @foreach($movies as $movie)
                    <div class="group relative cursor-pointer">

                        {{-- POSTER --}}
                        <img src="{{ $movie['Poster'] ?? '' }}"
                            class="rounded-lg w-full h-[300px] object-cover transition duration-300 group-hover:scale-105" />

                        {{-- OVERLAY --}}
                        <div
                            class="absolute inset-0 bg-black/80 opacity-0 group-hover:opacity-100 transition p-3 flex flex-col justify-end rounded-lg">

                            <h3 class="text-sm font-bold mb-1">
                                <a href="https://www.imdb.com/title/{{ $movie['imdbID'] ?? '' }}/" target="_blank"
                                    class="hover:underline">
                                    {{ $movie['Title'] }}
                                </a>
                            </h3>

                            <p class="text-xs text-gray-300 line-clamp-3">
                                {{ $movie['Plot'] ?? '' }}
                            </p>

                        </div>

                    </div>
                @endforeach

            </div>
        @endif

    </div>

</div>