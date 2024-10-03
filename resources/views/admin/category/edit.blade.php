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
            <h2 class="section-title">Edit Category</h2>


            <div class="row">
                <div class="col-12 col-md-12 col-lg-12 m-auto">
                    <div class="card">
                        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')

                            <div class="card-header">
                                <h4>Edit Category</h4>
                            </div>

                            <div class="card-body">
                                <!--Icon -->
                                <div class="form-group">
                                    <label for="icon">Icon</label>
                                    <input type="file" @class(['form-control-file', 'is-invalid' => $errors->has('icon')]) id="icon" name="icon">
                                    @if ($category->icon)
                                        <div class="">
                                            <img src="{{ asset('storage/' . $category->icon) }}" alt=""
                                                width="400px" height="300px">
                                        </div>
                                    @endif

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
                                        <input type="text" @class(['form-control', 'is-invalid' => $errors->has('name')]) name="name"
                                            value="{{ $category->name }}">
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6 ">
                                        <label>Parent Category</label>


                                        <select name="parent_id" class="form-control">
                                            @if ($category->parent_id == null)
                                            <option value="">Primary Category</option>
                                            @endif

                                            @foreach ($parents as $parent)
                                                <option value="{{ $category->id }}" @selected($category->parent_id == $parent->id)>
                                                    {{ $parent->name }} </option>
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
                                    <textarea rows="5" @class(['form-control', 'is-invalid' => $errors->has('description')]) name="description">{{ $category->description }}</textarea>

                                    @error('description')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </section>
@endsection
