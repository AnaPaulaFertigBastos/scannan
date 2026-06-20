@extends('layouts.app')

@section('title', $title)

@section('content')

<div class="container">


<h2 class="mb-4">
    Meus Favoritos
</h2>

<div class="row g-4">

    @forelse($favoritos as $favorito)

        <div class="col-6 col-md-4 col-lg-3">

            <a
                href="{{ route('obras.visualizar', $favorito->obra->id) }}"
                class="text-decoration-none">

                <div class="card border-0 shadow-sm h-100">

                    <div
                        class="bg-dark text-white d-flex align-items-center justify-content-center"
                        style="height: 180px; border-radius: 8px 8px 0 0;">

                        @if($favorito->obra->tipo === 'Livro')
                            <i class="bi bi-book" style="font-size: 3rem;"></i>
                        @elseif($favorito->obra->tipo === 'Serie')
                            <i class="bi bi-tv" style="font-size: 3rem;"></i>
                        @else
                            <i class="bi bi-film" style="font-size: 3rem;"></i>
                        @endif

                    </div>

                    <div class="card-body text-center">

                        <h6 class="fw-bold">
                            {{ $favorito->obra->titulo }}
                        </h6>

                        <i class="bi bi-heart-fill text-danger"></i>

                    </div>

                </div>

            </a>

        </div>

    @empty

        <div class="col-12">

            <div class="alert alert-info">

                Você ainda não possui favoritos.

            </div>

        </div>

    @endforelse

</div>


</div>

@endsection
