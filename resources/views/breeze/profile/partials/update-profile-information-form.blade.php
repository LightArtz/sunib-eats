<section>
    <header class="mb-4">
        <h4 class="fw-bold text-dark">Informasi Profil</h4>
        <p class="text-muted small">
            Perbarui informasi profil akun dan alamat email Anda.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-4">
        @csrf
        @method('patch')

        <div class="row g-3">
            
            <div class="col-12 mb-3">
                <label for="profile_picture" class="form-label fw-bold small text-muted">Foto Profil</label>
                <input class="form-control form-control-sm" type="file" id="profile_picture" name="profile_picture" accept="image/*">
                @error('profile_picture')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <div class="form-floating">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                           id="name" name="name" placeholder="Nama"
                           value="{{ old('name', $user->name) }}" required autocomplete="name">
                    <label for="name">Nama Lengkap</label>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-floating">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                           id="email" name="email" placeholder="Email"
                           value="{{ old('email', $user->email) }}" required autocomplete="username">
                    <label for="email">Email Address</label>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                        <div class="mt-2 text-warning small">
                            <p>Alamat email Anda belum diverifikasi.</p>
                            <button form="send-verification" class="btn btn-link p-0 m-0 align-baseline small">
                                Klik di sini untuk mengirim ulang email verifikasi.
                            </button>
                            @if (session('status') === 'verification-link-sent')
                                <p class="mt-2 text-success fw-bold">
                                    Tautan verifikasi baru telah dikirim ke email Anda.
                                </p>
                            @endif
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-floating">
                    <input type="text" class="form-control @error('phone_number') is-invalid @enderror" 
                           id="phone_number" name="phone_number" placeholder="0812..."
                           value="{{ old('phone_number', $user->phone_number) }}" required>
                    <label for="phone_number">Nomor Telepon</label>
                    @error('phone_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-floating">
                    <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror" 
                           id="date_of_birth" name="date_of_birth"
                           value="{{ old('date_of_birth', $user->date_of_birth) }}">
                    <label for="date_of_birth">Tanggal Lahir</label>
                    @error('date_of_birth')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-floating">
                    <select class="form-select @error('gender') is-invalid @enderror" id="gender" name="gender">
                        <option value="" disabled>Pilih Gender</option>
                        <option value="male" {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="female" {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>Perempuan</option>
                        <option value="other" {{ old('gender', $user->gender) == 'other' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                    <label for="gender">Jenis Kelamin</label>
                    @error('gender')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-12">
                <div class="form-floating">
                    <textarea class="form-control @error('bio') is-invalid @enderror" 
                              placeholder="Tulis bio..." id="bio" name="bio" style="height: 100px">{{ old('bio', $user->bio) }}</textarea>
                    <label for="bio">Bio Singkat</label>
                    @error('bio')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="d-flex align-items-center gap-3 mt-4">
            <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold">
                Simpan Perubahan
            </button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-success small mb-0 fw-bold"
                ><i class="bi bi-check-circle-fill"></i> Tersimpan.</p>
            @endif
        </div>
    </form>
</section>