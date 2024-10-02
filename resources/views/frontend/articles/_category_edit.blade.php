@foreach ($categories as $category)
    <option value="{{ $category->id }}" @selected(in_array($category->id, $selectedCategories))>
        {{ str_repeat('-', $depth * 4) }} {{ $category->name }}
    </option>
    @if ($category->children->isNotEmpty())
        @include('frontend.articles._category_edit', [
            'categories' => $category->children,
            'depth' => $depth + 1,
            'selectedCategories' => $selectedCategories,
        ])
    @endif
@endforeach
