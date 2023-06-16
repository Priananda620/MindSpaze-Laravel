@extends('layout')

@section('content')
<section id="forgot-password-email" class="section-child py-5 mt-5 container mb-4 px-5 justify-content-center d-flex">

    <div class="m-5 base-color-lifted-1 p-5">
        <h2 class="mx-4 mt-3">{{ __('Reset Password') }}</h2>
        <form class="d-flex flex-column mx-4 mb-3" method="POST" action="{{ route('password.email') }}">

            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">{{ __('Email Address') }}</label>
                <input id="email" type="email" class="display-font-color form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        
            <div class="d-inline-flex align-items-center justify-content-between mt-4">
                <button type="submit" class="button me-2" style="width: 100%;">Send Password Link</button>
            </div>
    
        </form>
    </div>
{{-- 
    <div class="card base-color-lifted-1 p-5 w-50">
        <div class="card-header">{{ __('Reset Password') }}</div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('Email Address') }}</label>
                    <input id="email" type="email" class="display-font-color form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">{{ __('Send Password Reset Link') }}</button>
                </div>
            </form>
        </div>
    </div> --}}
</section>
@endsection
