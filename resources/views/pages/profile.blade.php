<x-app-layout>
    <div class="container py-5">
        
        <div class="mb-5">
            <h2 class="fw-bold text-dark">Profil Saya</h2>
            <p class="text-muted">Kelola informasi profil Anda untuk mengamankan akun.</p>
        </div>

        <div class="row g-4">
            <div class="col-lg-4">
                <div class="card shadow-sm border-0 rounded-4 text-center p-4">
                    <div class="card-body">
                        <div class="position-relative d-inline-block mb-3">
                            @if($user->profile_picture)
                                <img src="{{ Str::startsWith($user->profile_picture, 'http') ? $user->profile_picture : Storage::disk('cloudinary')->url($user->profile_picture) }}"
                                     alt="{{ $user->name }}" 
                                     class="rounded-circle object-fit-cover shadow-sm"
                                     style="width: 120px; height: 120px;">
                            @else
                                <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center shadow-sm mx-auto"
                                     style="width: 120px; height: 120px; font-size: 3rem;">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                            @endif
                        </div>
                        
                        <h5 class="fw-bold mb-1">{{ $user->name }}</h5>
                        <p class="text-muted small mb-3">{{ $user->email }}</p>
                        
                        <div class="d-grid">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger w-100 rounded-pill">
                                    <i class="bi bi-box-arrow-right me-2"></i> Log Out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                
                <div class="card shadow-sm border-0 rounded-4 mb-4">
                    <div class="card-body p-4">
                        @include('breeze.profile.partials.update-profile-information-form')
                    </div>
                </div>

                <div class="card shadow-sm border-0 rounded-4 mb-4">
                    <div class="card-body p-4">
                        @include('breeze.profile.partials.update-password-form')
                    </div>
                </div>

                <div class="card shadow-sm border-0 rounded-4 bg-danger-subtle">
                    <div class="card-body p-4">
                        @include('breeze.profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>