<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 text-center">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4 text-center" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-4">
            <x-input-label for="email" class="fw-bold"><i class="fa-solid fa-envelope me-2"></i>{{ __('Email Address') }}</x-input-label>
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus placeholder="name@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="d-grid gap-2">
            <x-primary-button class="btn-primary w-100">
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('login') }}" class="text-sm text-primary text-decoration-none fw-bold">
                <i class="fa-solid fa-arrow-left me-1"></i> Back to Login
            </a>
        </div>
    </form>
</x-guest-layout>
