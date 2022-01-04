@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        {{ __('Category List') }}
                        <a href="{{ route('category.create') }}">Add New</a>
                    </div>
                    <div class="card-body table-responsive p-0">
                        @if($categories->count())
                            <table class="table table-bordered m-0">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($categories as $category)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $category->name }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button class="btn btn-danger btn-sm"
                                                        onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this item: {{ $category->name }}') === true) { document.getElementById('category_{{ $category->id }}').submit() }">
                                                    {{ __('Delete') }}
                                                </button>
                                            </div>
                                            <form id="category_{{ $category->id }}"
                                                  action="{{ route('category.destroy', $category->id) }}"
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
                        @else
                            <div class="card-body text-center">
                                No data found
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
