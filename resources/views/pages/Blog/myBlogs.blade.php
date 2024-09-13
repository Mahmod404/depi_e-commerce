@extends('main')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <!-- Blog Posts -->
            <div class="col-md-12">
                <div class="card shadow-lg mb-3">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h4>{{ __('Blogs') }}</h4>
                        <div class="col-md-7 d-flex justify-content-around">
                            <a href="{{ route('blog.create') }}"
                                class="btn btn-primary btn-block">{{ __('Create New Blog') }}</a>
                            <a href="{{ route('blogs.myBlogs') }}" class="btn btn-primary btn-block">{{ __('My Blogs') }}</a>
                        </div>
                    </div>
                </div>
                @foreach ($blogs as $blog)
                    <div class="card mb-3 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ $blog->title }}</h5>
                            <p class="card-text">{{ Str::limit($blog->description, 250) }}</p>
                            <div class="row justify-content-between">
                                <div class="col-md-4">
                                    <a href="{{ route('blogs.show', $blog->id) }}"
                                        class="btn btn
                                        btn-primary">{{ __('Read More') }}</a>

                                </div>
                                <div class="col-md-4">
                                    <a href="{{ route('blog.edit', $blog->id) }}"
                                        class="btn btn
                                            btn-primary">
                                        <i class="fa-solid fa-user-pen"></i></a>
                                    <div class="col-md-5 col-sm-8 mt-1">
                                        <form action="{{ route('blog.destroy', $blog->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger py-1 px-4"><i class="fa-solid fa-trash"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-muted">
                            {{ $blog->created_at->format('F j, Y') }} by {{ $blog->user->name }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
