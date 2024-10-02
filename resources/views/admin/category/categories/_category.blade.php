@foreach ($categories as $category)
    <option value="{{ $category->id }}">
        {{ str_repeat('-', $depth * 4) }} {{ $category->name }}
    </option>

    @if ($category->children->isNotEmpty())
        @include('admin.category.categories._category', ['categories' => $category->children, 'depth' => $depth + 1])
    @endif
@endforeach
