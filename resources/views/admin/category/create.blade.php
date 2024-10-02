@extends('admin.layouts.master')

@section('page-title', 'category')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Category</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">Categories</a></div>
                <div class="breadcrumb-item">Create</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Create New Category</h2>


            <div class="row">
                <div class="col-12 col-md-12 col-lg-12 m-auto">
                    <div class="card">
                        <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="card-header">
                                <h4>New Category</h4>
                            </div>

                            <div class="card-body">
                                <!--Icon -->
                                <div class="form-group">
                                    <label for="icon">Icon</label>
                                    <input type="file" @class(['form-control-file', 'is-invalid' => $errors->has('icon')]) id="icon" name="icon">
                                    @error('icon')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <!-- Name -->
                                    <div class="form-group col-md-6">
                                        <label>Name</label>
                                        <input type="text" @class(['form-control', 'is-invalid' => $errors->has('name')]) name="name">
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6 ">
                                        <label>Category</label>
                                        <select name="parent_id" @class(['form-control', 'is-invalid' => $errors->has('parent_id')])>
                                            <option >Choose Parent Category</option>
                                            <option value="">Primary Category</option>

                                            @foreach ($categories as $category)
                                                @include('admin.category.categories._category', ['categories' => $categories, 'depth' => 0])
                                            @endforeach
                                        </select>

                                        @error('parent_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- description -->
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea rows="5" @class(['form-control', 'is-invalid' => $errors->has('description')]) name="description"></textarea>

                                    @error('description')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </section>
@endsection
