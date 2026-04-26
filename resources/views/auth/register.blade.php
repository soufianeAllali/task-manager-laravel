<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <h3 class="fw-bold mb-4 text-center">Join TaskFlow</h3>

        <!-- Name -->
        <div class="mb-3">
            <x-input-label for="name" class="fw-bold"><i class="fa-solid fa-user me-2"></i>{{ __('Full Name') }}</x-input-label>
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="soufiane allali" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mb-3">
            <x-input-label for="email" class="fw-bold"><i class="fa-solid fa-envelope me-2"></i>{{ __('Email Address') }}</x-input-label>
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="name@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mb-3">
            <x-input-label for="password" class="fw-bold"><i class="fa-solid fa-lock me-2"></i>{{ __('Password') }}</x-input-label>
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" placeholder="Create a password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mb-4">
            <x-input-label for="password_confirmation" class="fw-bold"><i class="fa-solid fa-shield-check me-2"></i>{{ __('Confirm Password') }}</x-input-label>
            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" placeholder="Repeat password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="d-grid gap-2">
            <x-primary-button class="btn-primary">
                {{ __('Create Account') }}
            </x-primary-button>
        </div>

        <p class="text-center mt-4 mb-0 text-sm text-gray-600">
            Already registered? 
            <a href="{{ route('login') }}" class="text-primary text-decoration-none fw-bold">{{ __('Log in') }}</a>
        </p>
    </form>
</x-guest-layout>
