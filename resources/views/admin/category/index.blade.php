@extends('admin.layouts.master')

@section('page-title', 'Category')

@section('content')
    <section class="section">
        <div class="section-header">

            <h1>Category</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item">
                    <a href="{{ route('admin.categories.index') }}">Category</a>
                </div>
                <div class="breadcrumb-item">All</div>
            </div>
        </div>

        <div class="row">
            <form method="GET" action="{{ route('admin.categories.index') }}"
                class="row d-flex align-content-center justify-content-center align-items-baseline w-100">

                <div class="form-group col-md-4 pr-0">
                    <input type="text" id="name" name="name" class="form-control"
                        value="{{ request()->get('name') }}" placeholder="Search by name">
                </div>


                <div class="form-group col-md-4 pr-0">
                    <select id="category" name="category" class="form-control">

                        <option value="">Search By Parent Categories</option>

                        @include('frontend.categories._category', [
                            'categories' => $categories,
                            'depth' => 0,
                        ])

                    </select>

                </div>


                <button type="submit" class="btn btn-primary col-md-1 mx-3">Search</button>
                @if (request()->hasAny(['name', 'category']))
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-danger col-md-1 mr-3">Clear</a>
                @endif

                <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">Create Category</a>
            </form>


        </div>


        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID </th>
                                            <th>Name</th>
                                            <th>Parent</th>
                                            <th>Icon</th>
                                            <th>H.m Articles</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse ($categories as $key=> $category)
                                            <tr>
                                                <td class="p-0 text-center">
                                                    {{ $key + 1 }}
                                                </td>

                                                <td>{{ $category->name }}</td>

                                                <td>{{ $category->parent->name }}</td>

                                                <td>
                                                    <img src="{{ asset('storage/' . $category->icon) }}" alt=""
                                                        width="100px">
                                                </td>

                                                <td>{{ $category->articles_count }}</td>


                                                <td>
                                                    <a href="{{ route('admin.categories.edit', $category->id) }}"
                                                        class="btn btn-primary">
                                                        <i class="far fa-edit"></i>
                                                    </a>

                                                    <form action="{{ route('admin.categories.destroy', $category->id) }}"
                                                        method="post" class="d-inline-block">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a href="{{ route('admin.categories.destroy', $category->id) }}"
                                                            class="btn btn-danger "
                                                            onclick="event.preventDefault(); this.closest('form').submit();">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </a>
                                                    </form>

                                                </td>
                                            </tr>
                                        @empty
                                            <td colspan="8"
                                                class="text-center text-capitalize font-weight-bold lead bg-secondary">
                                                No Available data in this table
                                            </td>
                                        @endforelse
                                    </tbody>
                                </table>

                                {{ $categories->appends(request()->input())->links() }}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
