@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2>{{ $post->title }}</h2>
        </div>
        <div class="card-body">
            <p><strong>Description:</strong></p>
            <p>{{ $post->description }}</p>

            <div class="mb-3">
                <p><strong>Images:</strong></p>
                @if ($post->images->count() > 0)
                    @foreach ($post->images as $image)
                        <img src="{{ asset('storage/' . $image->image_path) }}" alt="Post Image" width="100" class="me-2">
                    @endforeach
                @else
                    <p>No images uploaded.</p>
                @endif
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ route('posts.index') }}" class="btn btn-secondary">Back to Posts</a>
        </div>
    </div>
@endsection
