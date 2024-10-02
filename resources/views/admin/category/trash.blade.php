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
                <div class="breadcrumb-item">Trash </div>
            </div>
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


                                                <td style="width: 200px">
                                                    <form action="{{ route('admin.categories.restore', $category->id) }}"
                                                        method="post" class="d-inline-block">
                                                        @csrf
                                                        @method('Put')
                                                        <a href="{{ route('admin.categories.restore', $category->id) }}"
                                                            class="btn btn-success "
                                                            onclick="event.preventDefault(); this.closest('form').submit();">
                                                            <i class="fas fa-trash-alt"></i> Restore
                                                        </a>
                                                    </form>

                                                    <form
                                                        action="{{ route('admin.categories.forcedelete', $category->id) }}"
                                                        method="post" class="d-inline-block">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a href="{{ route('admin.categories.forcedelete', $category->id) }}"
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

                                {{ $categories->links() }}


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
