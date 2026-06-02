@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('category.show', $donation->category->slug) }}">{{ $donation->category->name }}</a></li>
                    <li class="breadcrumb-item active text-truncate" style="max-width: 200px;">{{ $donation->title }}</li>
                </ol>
            </nav>

            <div class="card shadow-sm border-0 overflow-hidden">
                <div class="row g-0">
                    <div class="col-md-6">
                        <img src="{{ asset($donation->image) }}" class="img-fluid w-100 h-100" style="object-fit: cover; min-height: 400px;" alt="{{ $donation->title }}" onerror="this.src='https://via.placeholder.com/600x600?text=No+Image'">
                    </div>
                    <div class="col-md-6">
                        <div class="card-body p-4">
                            <span class="badge bg-primary mb-2">{{ $donation->category->name }}</span>
                            <h1 class="card-title h2 mb-3">{{ $donation->title }}</h1>
                            
                            <div class="mb-4">
                                <p class="text-muted" style="white-space: pre-line;">{{ $donation->description }}</p>
                            </div>

                            <hr>

                            <div class="row mb-4">
                                <div class="col-6">
                                    <p class="mb-1 text-muted small"><i class="fas fa-user me-1"></i> Donneur</p>
                                    <p class="fw-bold">{{ $donation->user->name }}</p>
                                </div>
                                <div class="col-6">
                                    <p class="mb-1 text-muted small"><i class="fas fa-map-marker-alt me-1"></i> Localisation</p>
                                    <p class="fw-bold">{{ $donation->location }}</p>
                                </div>
                                <div class="col-6">
                                    <p class="mb-1 text-muted small"><i class="fas fa-sort-numeric-up me-1"></i> Quantité</p>
                                    <p class="fw-bold">{{ $donation->quantity }}</p>
                                </div>
                            </div>

                            <div class="d-grid gap-2">
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $donation->whatsapp) }}" class="btn btn-success btn-lg" target="_blank">
                                    <i class="fab fa-whatsapp me-2"></i> Contacter via WhatsApp
                                </a>
                                <a href="{{ route('home') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-arrow-left me-2"></i> Retour à l'accueil
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
