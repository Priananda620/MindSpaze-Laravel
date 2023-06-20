

@extends('layout')

@section('content')
<section id="forgot-password-email" class="section-child py-5 mt-5 container mb-4 px-5 justify-content-center d-flex">
    <div class="m-5 base-color-lifted-1 p-5">
        <h2 class="mx-4 mt-3">{{ __('Reset Your Password') }}</h2>
        <form class="d-flex flex-column mx-4 mb-3" method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="mb-3">
                <label for="email" class="form-label">{{ __('Email Address') }}</label>
                <input id="email2" class="d-none" type="email" name="email" value="{{ $email ?? old('email') }}" required>
                <input id="email" type="email" class="border-0 display-font-color form-control @error('email') is-invalid @enderror" value="{{ $email ?? old('email') }}" required disabled>
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">{{ __('Password') }}</label>
                <input id="password" type="password" class="display-font-color form-control @error('password') is-invalid @enderror" name="password" required autofocus>
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                <input id="password-confirm" type="password" class="display-font-color form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required>
                @error('password_confirmation')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="d-inline-flex align-items-center justify-content-between mt-4">
                <button type="submit" class="button me-2" style="width: 100%;">{{ __('Reset Password') }}</button>
            </div>
        </form>
    </div>
</section>
@endsection
{{-- @extends('layout')

@section('content')
<section id="forgot-password-email" class="section-child py-5 mt-5 container mb-4 px-5">
    <div class="card base-color-lifted-1 p-5">
        <div class="card-header">{{ __('Reset Password') }}</div>

        <div class="card-body">
            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('Email Address') }}</label>
                    <input id="email" type="email" class="form-control display-font-color @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autofocus>
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">{{ __('Password') }}</label>
                    <input id="password" type="password" class="form-control display-font-color @error('password') is-invalid @enderror" name="password" required>
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                    <input id="password-confirm" type="password" class="form-control display-font-color" name="password_confirmation" required>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">{{ __('Reset Password') }}</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection --}}
