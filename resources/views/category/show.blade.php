@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-3">
                <div class="d-grid">
                    <a class="btn btn-dark" href="{{ route('admin.category.index') }}">Back Category List</a>
                </div>
                <div class="card my-4">
                    <div class="card-header">
                        Category
                    </div>
                    <img src="{{ $category->image }}" class="card-img-top" alt="{{ $category->name }}">
                    <div class="card-body">
                        <ul>
                            <li>
                                <b>Name:</b> {{ $category->name }}
                            </li>
                            <li>
                                <b>Sub Category:</b> {{ $category->subCategories()->count() }}
                            </li>
                            <li>
                                <b>Product:</b> {{ $category->products()->count() }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        {{ __('Sub Category List') }}
                        <a href="{{ route('admin.sub-category.create') }}?category={{ $category->id }}">Add New</a>
                    </div>
                    @if($subCategories->count())
                        <div class="card-body table-responsive p-0">
                            <table class="table table-bordered m-0">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Product</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($subCategories as $subCategory)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td><img src="{{ $subCategory->image }}" width="100"/></td>
                                        <td>{{ $subCategory->name }}</td>
                                        <td>
                                            {{ $subCategory->products()->count() }}
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a class="btn btn-success btn-sm"
                                                   href="{{ route('admin.sub-category.show', $subCategory->id) }}">
                                                    View
                                                </a>
                                                <button class="btn btn-danger btn-sm"
                                                        onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this item: {{ $subCategory->name }}') === true) { document.getElementById('sub_category_{{ $subCategory->id }}').submit() }">
                                                    {{ __('Delete') }}
                                                </button>
                                            </div>
                                            <form id="sub_category_{{ $subCategory->id }}"
                                                  action="{{ route('admin.sub-category.destroy', $subCategory->id) }}"
                                                  method="POST"
                                                  class="d-none">
                                                @csrf
                                                @method('delete')
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="card-body text-center">
                            No data found
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
