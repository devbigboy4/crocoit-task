<x-app-layout>

    <div>
        <div class="flex items-center justify-center align-baseline py-4 md:py-4 gap-4 flex-wrap">

            <form class="min-w-96">

                <select id="category"
                    class="bblock w-full px-4 py-3 text-base text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                    <option selected>Choose a Category</option>
                    @foreach ($categories as $category)
                        @include('frontend.categories._category', [
                            'categories' => $categories,
                            'depth' => 0,
                        ])
                    @endforeach

                </select>

            </form>
        </div>
    </div>


    <div class="py-2">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


            @foreach ($articles as $article)
            <div
                class=" w-full flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-full hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 relative mb-4">

                <!-- Image Section -->
                <img class="object-cover w-full rounded-t-lg h-96 md:w-48 md:h-64 md:rounded-none md:rounded-s-lg"
                    src="{{ asset('storage/' . $article->image) }}" alt="">

                <!-- Text Content Section -->
                <div class="flex flex-col justify-between p-4 leading-normal w-full">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                        {{ $article->title }}
                    </h5>

                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">

                        {!! $article->description  !!}
                    </p>
                </div>

                <!-- Dropdown Button and Menu -->
                <div class="absolute top-4 right-4">
                    <!-- Make ID unique by appending article ID -->
                    <button id="dropdownButton{{ $article->id }}"
                        data-dropdown-toggle="dropdown{{ $article->id }}"
                        class="inline-block text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:ring-4 focus:outline-none relative focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-1.5"
                        type="button">
                        <span class="sr-only">Open dropdown</span>
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 16 3">
                            <path
                                d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
                        </svg>
                    </button>

                    <!-- Dropdown Menu with unique ID -->
                    <div id="dropdown{{ $article->id }}"
                        class="z-10 hidden text-base list-none absolute bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                        <ul class="py-2" aria-labelledby="dropdownButton{{ $article->id }}">
                            <li>
                                <a href="{{ route('articles.show', $article->id) }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                                    Show
                                </a>
                            </li>
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Edit</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Delete</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        @endforeach


        </div>

    </div>
</x-app-layout>
