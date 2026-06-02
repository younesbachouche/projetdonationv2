@extends('layouts.app')

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
                    <li class="breadcrumb-item active">{{ $category->name }}</li>
                </ol>
            </nav>
            <h2 class="mb-4">Donations dans la catégorie: {{ $category->name }}</h2>
        </div>
    </div>

    <div class="row">
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
            <div class="col-12 text-center py-5">
                <p class="text-muted">Aucune donation trouvée dans cette catégorie.</p>
                <a href="{{ route('home') }}" class="btn btn-primary">Retour à l'accueil</a>
            </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $donations->links() }}
    </div>
@endsection
