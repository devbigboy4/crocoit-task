<ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
    @foreach ($categories as $category)
        <li class="{{ $category->children->isNotEmpty() ? 'relative' : '' }}">
            @if ($category->children->isNotEmpty())
                <!-- Parent category with children -->
                <button id="dropdown-{{ $category->id }}" data-dropdown-toggle-two="dropdown-{{ $category->id }}-menu"
                    type="button"
                    class="flex items-center justify-between w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                    {{ $category->name }}
                    <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <!-- Child categories (Dropdown) -->
                <div id="dropdown-{{ $category->id }}-menu"
                    class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                    @include('frontend.categories._category_list', ['categories' => $category->children])
                </div>
            @else
                <!-- Single category without children -->
                <a href="{{ route('categories.index', ['categoryId'=> $category->id]) }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                    {{ $category->name }}
                </a>
            @endif
        </li>
    @endforeach
</ul>


