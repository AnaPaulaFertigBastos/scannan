@extends('layouts.app')

@section('title', $title)

@section('content')

<div class="container">

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="text-center mb-4">

                <h1 class="fw-bold">
                    Alterar Avaliação
                </h1>

                <p class="text-secondary">
                    Atualize sua avaliação para "{{ $obraTitulo }}"
                </p>

            </div>

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body p-5">

                    <form method="POST"
                          action="/avaliacoes/atualizar/{{ $avaliacao->id }}">

                        @csrf
                        @method('PUT')

                        <input
                            type="hidden"
                            name="obra_id"
                            value="{{ $avaliacao->obra_id }}">

                        <div class="mb-4">

                            <label class="form-label fw-semibold">
                                Nota (1 a 10)
                            </label>

                            <input
                                type="number"
                                min="1"
                                max="10"
                                name="nota"
                                value="{{ old('nota', $avaliacao->nota) }}"
                                class="form-control form-control-lg @error('nota') is-invalid @enderror">

                            @error('nota')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        <div class="mb-4">

                            <label class="form-label fw-semibold">
                                Comentário
                            </label>

                            <textarea
                                name="comentario"
                                rows="5"
                                class="form-control @error('comentario') is-invalid @enderror">{{ old('comentario', $avaliacao->comentario) }}</textarea>

                            @error('comentario')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        <button
                            type="submit"
                            class="btn btn-scannan btn-lg w-100">

                            Salvar Alterações

                        </button>

                    </form>

                    @error('erro')
                        <div class="alert alert-danger mt-3 mb-0">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

            </div>

        </div>

    </div>

</div>

@endsection