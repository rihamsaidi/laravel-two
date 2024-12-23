@extends('layouts.app')

@section('content')
    <h1>Edit Post</h1>
    <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="4" required>{{ $post->description }}</textarea>
        </div>

        <div class="mb-3">
            <label for="current-images" class="form-label">Current Images:</label>
            <div>
                @foreach ($post->images as $image)
                    <div class="d-flex align-items-center mb-2">
                        <img src="{{ asset('storage/' . $image->image_path) }}" alt="Post Image" width="100" class="me-2">
                        <label>
                            <input type="checkbox" name="delete_images[]" value="{{ $image->id }}">
                            Delete
                        </label>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="mb-3">
            <label for="images" class="form-label">Upload New Images</label>
            <input type="file" class="form-control" id="images" name="images[]" multiple>
        </div>

        <button type="submit" class="btn btn-primary">Update Post</button>
        <a href="{{ route('posts.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
