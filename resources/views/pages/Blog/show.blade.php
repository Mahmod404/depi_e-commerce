@extends('main')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm mb-3">
                    <div class="card-header bg-primary text-white">
                        {{ $blog->title }}
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            {{ $blog->description }}
                        </p>
                    </div>
                    <div class="card-footer text-muted">
                        {{ __('Written by') }} {{ $blog->user->name }} {{ __('on') }}
                        {{ $blog->created_at->format('F j, Y') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
