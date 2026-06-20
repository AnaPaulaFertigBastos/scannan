@extends('layouts.app')

@section('title', $title)

@section('content')

<div class="container">

    @if($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first('erro') }}
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h1 class="fw-bold mb-1">
                {{ $obraTitulo }}
            </h1>

            <p class="text-secondary mb-0">
                Avaliações da obra
            </p>

        </div>

        <div class="d-flex gap-3">
          <a href="/avaliacoes/criar/{{ $obraId }}"
              class="btn btn-scannan">
                <i class="bi bi-plus-lg"></i>
                Avaliar
            </a>
            <a href="{{ route('obras.visualizar', $obraId) }}"
              class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i>
                Voltar
            </a>
            
        </div>

    </div>

    @forelse($avaliacoes as $avaliacao)

        <div class="card border-0 shadow-sm mb-3">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-start">

                    <div>

                        <h5 class="fw-bold mb-1">
                            {{ $avaliacao->apelido }}
                        </h5>

                        @php
                            $nota = $avaliacao->nota / 2;

                            $cheias = floor($nota);
                            $meia = ($nota - $cheias) >= 0.5;
                            $vazias = 5 - $cheias - ($meia ? 1 : 0);
                        @endphp

                        <div class="text-warning mb-2">

                            @for($i = 0; $i < $cheias; $i++)
                                <i class="bi bi-star-fill"></i>
                            @endfor

                            @if($meia)
                                <i class="bi bi-star-half"></i>
                            @endif

                            @for($i = 0; $i < $vazias; $i++)
                                <i class="bi bi-star"></i>
                            @endfor

                            <span class="ms-2">
                                {{ $avaliacao->nota }}/10
                            </span>

                        </div>

                    </div>

                    @if($avaliacao->usuario_id == $usuario)

                        <div class="d-flex gap-2">

                            <a 
                            href="/avaliacoes/atualizar/{{ $avaliacao->id }}"
                               class="btn btn-outline-primary btn-sm">

                                <i class="bi bi-pencil"></i>
                                Alterar

                            </a>

                             
                            <form
                                action="{{ route('avaliacoes.deletar', $avaliacao->id) }}"
                                method="POST"
                                class="form-excluir m-0">

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="btn btn-outline-danger btn-sm">

                                    <i class="bi bi-trash"></i>
                                    Excluir

                                </button>

                            </form>

                            

                        </div>

                    @endif

                </div>

                @if($avaliacao->comentario)

                    <hr>

                    <p class="mb-0">
                        {{ $avaliacao->comentario }}
                    </p>

                @endif

            </div>

        </div>



    @empty

        <div class="card border-0 shadow-sm">

            <div class="card-body text-center py-5">

                <i class="bi bi-chat-square-text fs-1 text-secondary"></i>

                <h5 class="mt-3">
                    Nenhuma avaliação encontrada
                </h5>

                <p class="text-secondary mb-0">
                    Esta obra ainda não possui avaliações.
                </p>

            </div>

        </div>

    @endforelse

    @if($avaliacoes->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $avaliacoes->links() }}
        </div>
    @endif
</div>

@endsection