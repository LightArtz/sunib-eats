<section>
    <header class="mb-4">
        <h4 class="fw-bold text-dark">Perbarui Password</h4>
        <p class="text-muted small">
            Pastikan akun Anda menggunakan password yang panjang dan acak agar tetap aman.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-4">
        @csrf
        @method('put')

        <div class="row g-3">
            
            <div class="col-12">
                <div class="form-floating">
                    <input type="password" class="form-control @error('current_password', 'updatePassword') is-invalid @enderror" 
                           id="current_password" name="current_password" placeholder="Current Password"
                           autocomplete="current-password">
                    <label for="current_password">Password Saat Ini</label>
                    @error('current_password', 'updatePassword')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-floating">
                    <input type="password" class="form-control @error('password', 'updatePassword') is-invalid @enderror" 
                           id="password" name="password" placeholder="New Password"
                           autocomplete="new-password">
                    <label for="password">Password Baru</label>
                    @error('password', 'updatePassword')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-floating">
                    <input type="password" class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror" 
                           id="password_confirmation" name="password_confirmation" placeholder="Confirm Password"
                           autocomplete="new-password">
                    <label for="password_confirmation">Konfirmasi Password</label>
                    @error('password_confirmation', 'updatePassword')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="d-flex align-items-center gap-3 mt-4">
            <button type="submit" class="btn btn-warning text-white rounded-pill px-4 fw-bold">
                Update Password
            </button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-success small mb-0 fw-bold"
                ><i class="bi bi-check-circle-fill"></i> Password Berhasil Diubah.</p>
            @endif
        </div>
    </form>
</section>