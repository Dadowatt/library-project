@extends('layouts.user')

@section('content')
    <h3 class="text-success mb-4">Mes livres favoris</h3>

    <div class="row">
        @forelse($favoris as $livre)
            <div class="col-12 col-sm-6 col-md-3 mb-4 mx-auto" style="max-width: 300px;">
                    <div class="card shadow">
                       <a href="{{ route('user.livres.show', $livre->id) }}">
                        <img src="{{ $livre->image_couverture ? asset('storage/'.$livre->image_couverture) : asset('default-cover.jpg') }}"
                             class="card-img-top" alt="Couverture" style="height: 15rem; object-fit:cover;">
                    </a>
                        <div class="card-body">
                            <h5 class="card-title">{{ $livre->titre }}</h5>
                            <p class="card-text text-muted small mb-1">{{ $livre->auteur->nom ?? 'Auteur inconnu' }}</p>
                             <div class="d-flex align-items-center text-warning">
                            <i class="fa-solid fa-star me-1"></i>
                            @php
                                $moyenne = $livre->notes->avg('valeur');
                            @endphp
                            <span class="me-auto text-dark">{{ $moyenne ? number_format($moyenne, 1) : '0' }}</span>
                        </div>
                        <div class="text-center">
                            <a href="{{ route('user.livres.lecture', $livre->id) }}" target="_blank" class="btn btn-success me-3 mt-2">
                            <i class="fas fa-book-open me-2"></i>Reprendre</a>
                        </div>
                        </div>
                    </div>
                </div>
        @empty
            <p class="text-muted">Vous n'avez aucun livre en favori.</p>
        @endforelse
    </div>
@endsection
