@extends('main')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">{{ __('Add Address') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('address.store') }}">  
                            @csrf

                            <!-- User ID (Hidden Field) -->
                            <input type="hidden" name="user_id" value="{{ Auth::id() }}">

                            <!-- Address Field -->
                            <div class="form-group mb-3">
                                <label for="address" class="form-label">{{ __('Address') }}</label>
                                <input id="address" type="text"
                                    class="form-control @error('address') is-invalid @enderror" name="address"
                                    value="{{ old('address') }}" required autocomplete="address" autofocus>
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- City Field -->
                            <div class="form-group mb-3">
                                <label for="city" class="form-label">{{ __('City') }}</label>
                                <input id="city" type="text"
                                    class="form-control @error('city') is-invalid @enderror" name="city"
                                    value="{{ old('city') }}" required autocomplete="city">
                                @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <div class="form-group mb-0">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Add Address') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
