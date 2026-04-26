<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fa-solid fa-user-gear text-primary me-2"></i>{{ __('Profile Settings') }}
        </h2>
    </x-slot>

    <!-- Bootstrap 5 & Font Awesome for Profile -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        .profile-container { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-panel {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.4);
            border-radius: 24px;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.05);
            transition: all 0.3s ease;
        }
        .section-header {
            border-bottom: 1px solid rgba(0,0,0,0.05);
            padding-bottom: 1.5rem;
            margin-bottom: 2rem;
        }
        /* Target Breeze Components */
        .profile-container input[type="text"], 
        .profile-container input[type="email"], 
        .profile-container input[type="password"],
        .profile-container select {
            border-radius: 12px !important;
            padding: 0.75rem 1rem !important;
            border: 1px solid #e5e7eb !important;
            background: rgba(255, 255, 255, 0.5) !important;
            transition: all 0.3s ease !important;
        }
        .profile-container input:focus {
            background: white !important;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1) !important;
            border-color: #6366f1 !important;
        }
        .profile-container button {
            border-radius: 12px !important;
            padding: 0.7rem 1.5rem !important;
            font-weight: 600 !important;
            text-transform: none !important;
            letter-spacing: normal !important;
            transition: all 0.3s ease !important;
        }
        .profile-container button[type="submit"]:not(.btn-outline-danger) {
            background: linear-gradient(135deg, #6366f1, #a855f7) !important;
            border: none !important;
        }
        .profile-container button:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 5px 15px rgba(99, 102, 241, 0.3) !important;
        }
    </style>

    <div class="py-12 profile-container">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-6 sm:p-10 glass-panel">
                <div class="max-w-xl">
                    <div class="section-header">
                        <h4 class="fw-bold"><i class="fa-solid fa-id-card text-primary me-2"></i>Profile Information</h4>
                        <p class="text-muted small">Update your account's profile information and email address.</p>
                    </div>
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-6 sm:p-10 glass-panel">
                <div class="max-w-xl">
                    <div class="section-header">
                        <h4 class="fw-bold"><i class="fa-solid fa-lock text-warning me-2"></i>Update Password</h4>
                        <p class="text-muted small">Ensure your account is using a long, random password to stay secure.</p>
                    </div>
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-6 sm:p-10 glass-panel border border-danger-subtle">
                <div class="max-w-xl">
                    <div class="section-header border-danger-subtle">
                        <h4 class="fw-bold text-danger"><i class="fa-solid fa-user-slash me-2"></i>Delete Account</h4>
                        <p class="text-muted small">Once your account is deleted, all of its resources and data will be permanently deleted.</p>
                    </div>
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
