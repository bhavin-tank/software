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
                        {{ __('Softwares List') }}
                        <a href="{{ route('software.create') }}">Add New</a>
                    </div>
                    <div class="card-body table-responsive p-0">
                        @if($softwares->count())
                            <table class="table table-bordered m-0">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Icon</th>
                                    <th scope="col">File</th>
                                    <th scope="col">Version</th>
                                    <th scope="col">Date Time</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($softwares as $software)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $software->name }}</td>
                                        <td><img src="{{ $software->icon }}" width="100"/></td>
                                        <td><img src="{{ $software->icon }}" width="100"/></td>
                                        <td>{{ $software->version }}</td>
                                        <td>{{ $software->date_time }}</td>
                                        <td>{{ $software->category->name }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button class="btn btn-danger btn-sm"
                                                        onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this item: {{ $software->name }}') === true) { document.getElementById('software_{{ $software->id }}').submit() }">
                                                    {{ __('Delete') }}
                                                </button>
                                            </div>
                                            <form id="software_{{ $software->id }}"
                                                  action="{{ route('software.destroy', $software->id) }}"
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
