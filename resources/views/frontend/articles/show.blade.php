<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($article->title) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <main class="pt-8 pb-16 lg:pt-16 lg:pb-24 bg-white dark:bg-gray-900 antialiased">
                    <div class="flex justify-between px-4 mx-auto max-w-screen-xl ">
                        <article
                            class="mx-auto w-full max-w-2xl format format-sm sm:format-base lg:format-lg format-blue dark:format-invert">
                            <header class="mb-4 lg:mb-6 not-format">
                                <address class="flex items-center mb-6 not-italic">
                                    <div class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white">
                                        <img class="mr-4 w-16 h-16 rounded-full"
                                            src="https://flowbite.com/docs/images/people/profile-picture-2.jpg"
                                            alt="Jese Leos">
                                        <div>

                                            <a href="#" rel="author"
                                                class="text-xl font-bold text-gray-900 dark:text-white">{{ $article->user->name }}
                                            </a>

                                            <p class="text-base text-gray-500 dark:text-gray-400">Graphic Designer,
                                                educator & CEO Flowbite</p>

                                            <p class="text-base text-gray-500 dark:text-gray-400">
                                                <time pubdate datetime="2022-02-08" title="February 8th, 2022">
                                                   {{$article->created_at->format('M d, Y')}}
                                                </time>
                                            </p>
                                        </div>
                                    </div>
                                </address>
                                <h1
                                    class="mb-4 text-3xl font-extrabold leading-tight text-gray-900 lg:mb-6 lg:text-4xl dark:text-white">
                                    {{ $article->title }}
                                </h1>

                            <p class="mt-3">
                                {{$article->description}}
                            </p>
                            </header>



                            <figure class="w-full md:h-auto">
                                <img src="{{asset('storage/'. $article->image)}}"
                                    alt="" class="w-full h-auto">
                            </figure>



                            <div class="">
                                {!! $article->body !!}
                            </div>



                        </article>
                    </div>
                </main>

                <aside aria-label="Related articles" class="py-8 lg:py-24 bg-gray-50 dark:bg-gray-800">
                    <div class="px-4 mx-auto max-w-screen-xl">
                        <h2 class="mb-8 text-2xl font-bold text-gray-900 dark:text-white">Related articles</h2>
                        <div class="grid gap-12 sm:grid-cols-2 lg:grid-cols-4">



                            @foreach ($related_articles as $art)
                                <article class="max-w-xs">
                                    <a href="{{ route('articles.show', $art->id) }}">
                                        <img src="{{ asset('storage/' . $art->image) }}" class="mb-5 rounded-lg w-60 h-52"
                                            alt="Image 1">
                                    </a>
                                    <h2 class="mb-2 text-xl font-bold leading-tight text-gray-900 dark:text-white">
                                        <a href="{{ route('articles.show', $art->id) }}">{{ $art->title }}</a>
                                    </h2>
                                    <p class="mb-4 text-gray-500 dark:text-gray-400">
                                        {!! Str::limit($art->description, 100) !!}
                                    </p>

                                    <a href="{{ route('articles.show', $art->id) }}"
                                        class="inline-flex items-center font-medium underline underline-offset-4 text-primary-600 dark:text-primary-500 hover:no-underline">
                                        Read in 2 minutes
                                    </a>
                                </article>
                            @endforeach
                        </div>
                    </div>
                </aside>


            </div>
        </div>
    </div>
</x-app-layout>
