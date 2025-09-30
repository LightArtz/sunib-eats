<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container-fluid px-4">
        <a class="navbar-brand d-flex align-items-center" href="/">
            <!-- Logo -->
            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg" class="me-2">
                <circle cx="20" cy="20" r="18" stroke="#0d6efd" stroke-width="4" />
                <path d="M16 28V18C16 15.5 14.5 14 12 14C9.5 14 8 15.5 8 18V28" fill="#0d6efd" />
                <path d="M24 28V18C24 15.5 25.5 14 28 14C30.5 14 32 15.5 32 18V28" fill="#0d6efd" />
                <circle cx="20" cy="20" r="6" fill="#fff" />
            </svg>
            <span style="font-family: 'Fredoka', sans-serif; font-weight: 700; font-size: 1.5rem; color: #0d6efd;">sunib eats</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link active fw-medium px-3" aria-current="page" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-medium px-3" href="/reviews">Reviews</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-medium px-3" href="/restaurants">Restaurants</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-primary text-white fw-medium px-4 py-2 ms-2" href="/add-review">Add Review</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Fredoka font dari google fonts -->
<link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300..700&display=swap" rel="stylesheet">

<style>
    .navbar {
        transition: all 0.3s ease;
    }

    .navbar-brand:hover {
        color: #005cbf !important;
    }

    .nav-link {
        color: #333 !important;
        transition: color 0.2s ease;
    }

    .nav-link:hover {
        color: #0d6efd !important;
    }

    .nav-link.active {
        color: #0d6efd !important;
    }

    .nav-link.btn-primary {
        background-color: #0d6efd !important;
        border-color: #0d6efd !important;
        color: #fff !important;
        transition: background-color 0.2s ease, border-color 0.2s ease;
    }

    .nav-link.btn-primary:hover {
        background-color: #005cbf !important;
        border-color: #005cbf !important;
        color: #fff !important;
    }
</style>