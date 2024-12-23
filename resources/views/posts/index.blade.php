@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Posts</h1>
        <a href="{{ route('posts.create') }}" class="btn btn-primary">Add Post</a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Description</th>
                <th>Images</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
            <tr>
                <td>{{ $post->id }}</td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->description }}</td>
                <td>
                    @if($post->images->count() > 0)
                        @foreach($post->images as $image)
                            <img src="{{ asset('storage/' . $image->image_path) }}" width="50" class="me-2">
                        @endforeach
                    @else
                        No Image
                    @endif
                </td>
                <td>
                    <a href="{{ route('posts.show', $post) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('posts.edit', $post) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
