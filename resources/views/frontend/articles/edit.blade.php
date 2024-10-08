<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Article') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="w-full">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Article Information') }}
                            </h2>

                        </header>

                        <form method="post" action="{{ route('articles.update', $article->id) }}" class="mt-6 space-y-6"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')

                            <div>
                                <x-input-label for="title" :value="__('Title')"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" />
                                <x-text-input id="title" name="title" type="text" class="mt-1 block w-full"
                                    value="{{ $article->title }}" autofocus autocomplete="title" />
                                <x-input-error class="mt-2" :messages="$errors->get('title')" />
                            </div>

                            <div>
                                <div class="mb-6">
                                    <label for="body"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">body</label>
                                    <textarea id="summernote" name="body">{!! $article->body !!}</textarea>
                                    <x-input-error class="mt-2" :messages="$errors->get('body')" />
                                </div>
                            </div>

                            <div class="">
                                <label for="descritpion"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Article Description
                                </label>
                                <textarea id="descritpion" name="description" rows="4"
                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Write your thoughts here...">{{$article->description}}
                                </textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('description')" />

                            </div>

                            <div>
                                <label for="categories_ids"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Select Category
                                </label>

                                <select multiple="multiple" id="categories_ids" name="categories_ids[]"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-base rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                                    @include('frontend.articles._category_edit', [
                                        'categories' => $categories,
                                        'depth' => 0,
                                        'selectedCategories' => $selectedCategories,
                                    ])

                                </select>

                                <x-input-error class="mt-2" :messages="$errors->get('categories_ids')" />

                            </div>

                            <div>

                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    for="user_avatar">
                                    Upload Article Image
                                </label>
                                <input
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                    aria-describedby="image" id="image" type="file" name="image">

                                <x-input-error class="mt-2" :messages="$errors->get('image')" />
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG,
                                    JPG or GIF (MAX. 800x400px).</p>

                                    @if ($article->image)
                                    <img class="h-auto max-w-xs" src="{{asset('storage/'.$article->image)}}" alt="image description">
                                    @endif

                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Update') }}</x-primary-button>

                            </div>

                        </form>
                    </section>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
