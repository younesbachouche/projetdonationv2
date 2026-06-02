@extends('layouts.app')

@section('content')
    <!-- Slider -->
    <div id="heroCarousel" class="carousel slide mb-5" data-bs-ride="carousel">
        <div class="carousel-inner rounded shadow">
            <div class="carousel-item active">
                <img src="https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" class="d-block w-100" style="height: 400px; object-fit: cover;" alt="Donation">
                <div class="carousel-caption d-none d-md-block" style="background: rgba(0,0,0,0.5); border-radius: 10px;">
                    <h3>Aidez ceux qui en ont besoin</h3>
                    <p>Votre don peut changer une vie aujourd'hui.</p>
                    <a href="{{ auth()->check() ? route('donate.create') : route('login') }}" class="btn btn-primary">Faire un don</a>
                </div>
            </div>
            <div class="carousel-item">
                <img src="https://images.unsplash.com/photo-1532629345422-7515f3d16bb6?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" class="d-block w-100" style="height: 400px; object-fit: cover;" alt="Aide">
                <div class="carousel-caption d-none d-md-block" style="background: rgba(0,0,0,0.5); border-radius: 10px;">
                    <h3>Solidarité et Entraide</h3>
                    <p>Rejoignez notre communauté de donateurs.</p>
                    <a href="{{ auth()->check() ? route('donate.create') : route('login') }}" class="btn btn-primary">Faire un don</a>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>

    <!-- Categories Section -->
    <div class="row mb-5 text-center">
        <h2 class="mb-4">Catégories</h2>
        @foreach($categories as $cat)
            <div class="col-md-3 col-6 mb-3">
                <a href="{{ route('category.show', $cat->slug) }}" class="text-decoration-none">
                    <div class="card h-100 border-0 shadow-sm hover-shadow transition">
                        <div class="card-body">
                            <i class="fas fa-box-open fa-2x text-primary mb-2"></i>
                            <h5 class="card-title text-dark">{{ $cat->name }}</h5>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

    <!-- Search Section -->
    <div class="row mb-5 justify-content-center">
        <div class="col-md-8">
            <form action="{{ route('home') }}" method="GET" class="d-flex">
                <input type="text" name="search" class="form-control form-control-lg me-2" placeholder="Rechercher par titre ou localisation..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary px-4">Rechercher</button>
            </form>
        </div>
    </div>

    <!-- Latest Donations Section -->
    <div class="row">
        <h2 class="mb-4">Dernières donations</h2>
        @forelse($donations as $donation)
            <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset($donation->image) }}" class="card-img-top" alt="{{ $donation->title }}" onerror="this.src='https://via.placeholder.com/400x300?text=No+Image'">
                    <div class="card-body">
                        <h5 class="card-title text-truncate">{{ $donation->title }}</h5>
                        <p class="card-text text-muted small mb-1">
                            <i class="fas fa-user me-1"></i> {{ $donation->user->name }}<br>
                            <i class="fas fa-map-marker-alt me-1"></i> {{ $donation->location }}<br>
                            <i class="fas fa-sort-numeric-up me-1"></i> Quantité: {{ $donation->quantity }}
                        </p>
                        <div class="d-grid gap-2 mt-3">
                            <a href="{{ route('donation.show', $donation->id) }}" class="btn btn-outline-primary btn-sm">Détails</a>
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $donation->whatsapp) }}" class="btn btn-success btn-sm" target="_blank">
                                <i class="fab fa-whatsapp me-1"></i> WhatsApp
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <p class="text-muted">Aucune donation trouvée.</p>
            </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $donations->links() }}
    </div>
@endsection
