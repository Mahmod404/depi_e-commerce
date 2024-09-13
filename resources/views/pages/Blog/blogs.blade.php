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
                            <a href="{{ route('blogs.myBlogs') }}"
                                class="btn btn-primary btn-block">{{ __('My Blogs') }}</a>
                        </div>
                        <form class="form-inline" method="GET" action="{{ route('blogs.index') }}">
                            <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search"
                                aria-label="Search" value="{{ request('search') }}">
                            <button class="btn btn-outline-light mt-3" type="submit">{{ __('Search') }}</button>
                        </form>
                    </div>
                </div>

                @if ($blogs->count())
                    @foreach ($blogs as $blog)
                        <div class="card mb-3 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">{{ $blog->title }}</h5>
                                <p class="card-text">{{ Str::limit($blog->description, 150) }}</p>
                                <a href="{{ route('blogs.show', $blog->id) }}"
                                    class="btn btn-primary">{{ __('Read More') }}</a>
                            </div>
                            <div class="card-footer text-muted">
                                {{ $blog->created_at->format('F j, Y') }} by {{ $blog->user->name }}
                            </div>
                        </div>
                    @endforeach

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center">
                        {{ $blogs->links() }}
                    </div>
                @else
                    <div class="alert alert-info" role="alert">
                        {{ __('No blogs found.') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
