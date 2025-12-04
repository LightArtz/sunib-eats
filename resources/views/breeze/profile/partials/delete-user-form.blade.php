<section class="space-y-6">
    <header class="mb-4">
        <h4 class="fw-bold text-danger">Hapus Akun</h4>
        <p class="text-muted small">
            Setelah akun Anda dihapus, semua sumber daya dan data akan dihapus secara permanen.
        </p>
    </header>

    <button class="btn btn-danger rounded-pill fw-bold"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
        Hapus Akun Saya
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-4">
            @csrf
            @method('delete')

            <h4 class="fw-bold text-dark mb-3">Apakah Anda yakin?</h4>
            <p class="text-muted small mb-4">
                Setelah akun dihapus, semua data tidak dapat dikembalikan. Silakan masukkan password Anda untuk konfirmasi.
            </p>

            <div class="form-floating mb-3">
                <input type="password" class="form-control @error('password', 'userDeletion') is-invalid @enderror"
                    id="password" name="password" placeholder="Password">
                <label for="password">Password</label>
                @error('password', 'userDeletion')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-end gap-2">
                <button type="button" class="btn btn-secondary rounded-pill" x-on:click="$dispatch('close')">
                    Batal
                </button>
                <button type="submit" class="btn btn-danger rounded-pill">
                    Hapus Permanen
                </button>
            </div>
        </form>
    </x-modal>
</section>