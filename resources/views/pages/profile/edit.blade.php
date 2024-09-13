@extends('main')
@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white">{{ __('Update Profile') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('user.update') }}">
                            @csrf
                            @method('PUT')

                            <!-- Name Field -->
                            <div class="form-group row mb-3">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        <input id="name" type="text"
                                            class="form-control @error('name') is-invalid @enderror" name="name"
                                            value="{{ old('name', $user->name) }}" required autocomplete="name" autofocus>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Phone Field -->
                            <div class="form-group row mb-3">
                                <label for="phone"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                        <input id="phone" type="text"
                                            class="form-control @error('phone') is-invalid @enderror" name="phone"
                                            value="{{ old('phone', $user->phone) }}" required>
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Gender Field -->
                            <div class="form-group row mb-3">
                                <label for="gender"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-venus-mars"></i></span>
                                        <select id="gender" class="form-select @error('gender') is-invalid @enderror"
                                            name="gender" required>
                                            <option value="male"
                                                {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>Male
                                            </option>
                                            <option value="female"
                                                {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>
                                                Female</option>
                                        </select>
                                        @error('gender')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- New Password Field -->
                            <div class="form-group row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            minlength="8" autocomplete="new-password" pattern=".{8,}"
                                            title="Password must be at least 8 characters long">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <div class="invalid-feedback">Password must be at least 8 characters long.</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Confirm New Password Field -->
                            <div class="form-group row mb-3">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Confirm New Password') }}</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                        <input id="password-confirm" type="password" class="form-control"
                                            name="password_confirmation" minlength="8" autocomplete="new-password"
                                            pattern=".{8,}" title="Password must be at least 8 characters long">
                                        <div class="invalid-feedback">Passwords do not match.</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Current Password Field -->
                            <div class="form-group row mb-4">
                                <label for="current-password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Current Password') }}</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                        <input id="current-password" type="password"
                                            class="form-control @error('current_password') is-invalid @enderror"
                                            name="current_password" required autocomplete="current-password">
                                        @error('current_password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update Profile') }}
                                    </button>
                                </div>
                            </div>

                            <!-- Success Message -->
                            @if (session('success'))
                                <div class="alert alert-success mt-3" role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('updateProfileForm');
            const password = document.getElementById('password');
            const passwordConfirm = document.getElementById('password-confirm');

            form.addEventListener('submit', function(event) {
                // Clear previous custom validity messages
                password.setCustomValidity("");
                passwordConfirm.setCustomValidity("");

                // Check if password meets minimum length
                if (password.value.length < 8) {
                    password.setCustomValidity("Password must be at least 8 characters long.");
                } else {
                    password.setCustomValidity("");
                }

                // Check if passwords match
                if (password.value !== passwordConfirm.value) {
                    passwordConfirm.setCustomValidity("Passwords do not match.");
                } else {
                    passwordConfirm.setCustomValidity("");
                }

                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }

                form.classList.add('was-validated');
            });

            // Real-time validation feedback for matching passwords
            password.addEventListener('input', function() {
                if (password.value !== passwordConfirm.value) {
                    passwordConfirm.setCustomValidity("Passwords do not match.");
                } else {
                    passwordConfirm.setCustomValidity("");
                }
            });

            passwordConfirm.addEventListener('input', function() {
                if (password.value !== passwordConfirm.value) {
                    passwordConfirm.setCustomValidity("Passwords do not match.");
                } else {
                    passwordConfirm.setCustomValidity("");
                }
            });
        });
    </script>
@endsection
