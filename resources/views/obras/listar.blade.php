@extends('layouts.app')

@section('title', $title)

@section('content')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2 class="mb-0">
            Obras
        </h2>

        <a href="{{ route('obras.criar') }}"
            class="btn btn-scannan"
            >

            <i class="bi bi-plus-lg"></i>
            Nova Obra

        </a>

    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first('erro') }}
        </div>
    @endif

    <div class="row g-4">

        @foreach($obras as $obra)

            @php
                // converte nota de 0–10 para 0–5
                $nota = ($obra->avaliacoes_avg_nota ?? 0) / 2;

                $cheias = floor($nota);
                $meia = ($nota - $cheias) >= 0.5;
                $vazias = 5 - $cheias - ($meia ? 1 : 0);
            @endphp

            <div class="col-6 col-md-4 col-lg-3">

                <a href="/obras/visualizar/{{ $obra->id }}"
                class="text-decoration-none">

                    <div class="card border-0 shadow-sm h-100">

                        <div class="bg-dark text-white d-flex align-items-center justify-content-center"
                            style="height: 180px; border-radius: 8px 8px 0 0;">

                            @if($obra->tipo === 'Livro')
                                <i class="bi bi-book" style="font-size: 3rem;"></i>
                            @elseif($obra->tipo === 'Serie')
                                <i class="bi bi-tv" style="font-size: 3rem;"></i>
                            @else
                                <i class="bi bi-film" style="font-size: 3rem;"></i>
                            @endif

                        </div>

                        <div class="card-body text-center">

                            <h6 class="fw-bold mb-2">
                                {{ $obra->titulo }}
                            </h6>

                            <div class="text-warning">

                                @for($i = 0; $i < $cheias; $i++)
                                    <i class="bi bi-star-fill"></i>
                                @endfor

                                @if($meia)
                                    <i class="bi bi-star-half"></i>
                                @endif

                                @for($i = 0; $i < $vazias; $i++)
                                    <i class="bi bi-star"></i>
                                @endfor

                            </div>

                        </div>

                    </div>

                </a>

            </div>

        @endforeach

    </div>

    {{-- PAGINAÇÃO --}}
    <div class="mt-4">
        {{ $obras->links() }}
    </div>

</div>

@endsection