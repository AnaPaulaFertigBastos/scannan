@extends('layouts.app')

@section('title', $title)

@section('content')

<div class="container">

    @if($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first('erro') }}
        </div>
    @endif

    @php
        $nota = ($obra->nota_media ?? 0) / 2;

        $cheias = floor($nota);
        $meia = ($nota - $cheias) >= 0.5;
        $vazias = 5 - $cheias - ($meia ? 1 : 0);
    @endphp

    <div class="card border-0 shadow-sm">

        <div class="card-body p-4">

            <div class="row">

                {{-- CAPA --}}
                <div class="col-md-3">

                    <div
                        class="bg-dark text-white d-flex align-items-center justify-content-center h-100 rounded"
                        style="min-height: 300px;">

                        @if($obra->tipo === 'Livro')
                            <i class="bi bi-book" style="font-size: 5rem;"></i>
                        @elseif($obra->tipo === 'Serie')
                            <i class="bi bi-tv" style="font-size: 5rem;"></i>
                        @else
                            <i class="bi bi-film" style="font-size: 5rem;"></i>
                        @endif

                    </div>

                </div>

                {{-- DADOS --}}
                <div class="col-md-9">

                    <h1 class="fw-bold mb-2">
                        {{ $obra->titulo }}
                    </h1>

                    <span class="badge bg-secondary mb-3">
                        {{ $obra->tipo }}
                    </span>

                    <div class="text-warning mb-3">

                        @for($i = 0; $i < $cheias; $i++)
                            <i class="bi bi-star-fill"></i>
                        @endfor

                        @if($meia)
                            <i class="bi bi-star-half"></i>
                        @endif

                        @for($i = 0; $i < $vazias; $i++)
                            <i class="bi bi-star"></i>
                        @endfor

                        <span class="text-body ms-2">
                            {{ number_format($obra->nota_media, 1) }}/10
                        </span>

                    </div>

                    <div class="mb-3">

                        <strong>Descrição:</strong>

                        <p class="mt-2 mb-0">
                            {{ $obra->descricao }}
                        </p>

                    </div>

                    {{-- LIVRO --}}
                    @if($obra->tipo === 'Livro')

                        <div class="mb-2">

                            <strong>Páginas:</strong>
                            {{ $obra->paginas }}

                        </div>

                    @endif

                    {{-- SÉRIE --}}
                    @if($obra->tipo === 'Serie' && $obra->temporada)

                        <div class="mb-2">

                            <strong>Temporadas:</strong>
                            {{ $obra->temporada }}

                        </div>

                    @endif

                    {{-- FILME --}}
                    @if($obra->tipo === 'Filme')

                        <div class="mb-2">

                            <strong>Duração:</strong>
                            {{ $obra->duracao }} min

                        </div>

                    @endif

                </div>

            </div>

        </div>

    </div>

</div>

@endsection