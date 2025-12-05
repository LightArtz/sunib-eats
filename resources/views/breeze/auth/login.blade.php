<x-guest-layout>
    <div class="text-center mb-4">
        <h4 class="fw-bold">Selamat Datang!</h4>
        <p class="text-muted small">Silakan login untuk melanjutkan perburuan kuliner.</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-floating mb-3">
            <input type="email" class="form-control @error('email') is-invalid @enderror"
                id="email" name="email" placeholder="name@example.com"
                value="{{ old('email') }}" required autofocus autocomplete="username">
            <label for="email">Email Address</label>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="form-floating mb-3">
            <input type="password" class="form-control @error('password') is-invalid @enderror"
                id="password" name="password" placeholder="Password"
                required autocomplete="current-password">
            <label for="password">Password</label>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="form-check">
                <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                <label for="remember_me" class="form-check-label small text-muted">Ingat Saya</label>
            </div>

            @if (Route::has('password.request'))
            <a class="small text-decoration-none fw-bold" href="{{ route('password.request') }}">
                Lupa Password?
            </a>
            @endif
        </div>

        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary btn-lg fw-bold">
                Masuk Sekarang
            </button>
        </div>

        <div class="text-center mt-4">
            <p class="small text-muted mb-0">Belum punya akun?</p>
            <a href="{{ route('register') }}" class="fw-bold text-decoration-none">Daftar Akun Baru</a>
        </div>
    </form>
</x-guest-layout>