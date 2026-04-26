<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <h3 class="fw-bold mb-4 text-center">Welcome Back</h3>

        <!-- Email Address -->
        <div class="mb-3">
            <x-input-label for="email" class="fw-bold"><i class="fa-solid fa-envelope me-2"></i>{{ __('Email Address') }}</x-input-label>
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="name@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mb-4">
            <x-input-label for="password" class="fw-bold"><i class="fa-solid fa-lock me-2"></i>{{ __('Password') }}</x-input-label>
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="d-flex justify-content-between align-items-center mb-4" style="position: relative; z-index: 10;">
            <label for="remember_me" class="d-flex align-items-center m-0" style="cursor: pointer;">
                <input id="remember_me" type="checkbox" class="form-check-input m-0" name="remember" 
                       style="cursor: pointer; width: 1.2rem; height: 1.2rem; z-index: 20; position: relative;">
                <span class="ms-2 text-sm text-gray-600" style="user-select: none;">{{ __('Remember me') }}</span>
            </label>
            @if (Route::has('password.request'))
                <a class="text-sm text-primary text-decoration-none fw-semibold" href="{{ route('password.request') }}">
                    {{ __('Forgot password?') }}
                </a>
            @endif
        </div>

        <div class="d-grid gap-2">
            <x-primary-button class="btn-primary">
                <i class="fa-solid fa-right-to-bracket me-2"></i>{{ __('Log in') }}
            </x-primary-button>
        </div>

        <p class="text-center mt-4 mb-0 text-sm text-gray-600">
            Don't have an account? 
            <a href="{{ route('register') }}" class="text-primary text-decoration-none fw-bold">{{ __('Register') }}</a>
        </p>
    </form>
</x-guest-layout>
