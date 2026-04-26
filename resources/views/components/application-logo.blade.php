<div {{ $attributes->merge(['class' => 'd-flex flex-column align-items-center justify-content-center text-center gap-1']) }}>
    <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" style="width: 60px; height: 60px;">
        <!-- Background Circle with Gradient -->
        <defs>
            <linearGradient id="logoGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                <stop offset="0%" style="stop-color:#6366f1;stop-opacity:1" />
                <stop offset="100%" style="stop-color:#a855f7;stop-opacity:1" />
            </linearGradient>
        </defs>
        <rect width="100" height="100" rx="24" fill="url(#logoGradient)" />
        <!-- Stack of Tasks Icon -->
        <path d="M30 35H70M30 50H70M30 65H50" stroke="white" stroke-width="8" stroke-linecap="round" />
        <!-- Checkmark -->
        <circle cx="70" cy="70" r="15" fill="white" />
        <path d="M63 70L68 75L77 65" stroke="#6366f1" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" fill="none" />
    </svg>
    <span style="font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 800; font-size: 1.6rem; background: linear-gradient(135deg, #6366f1, #a855f7); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">TaskFlow</span>
</div>
