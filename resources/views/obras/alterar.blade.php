@extends('layouts.app')

@section('title', $title)

@section('content')

<div class="container">

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="text-center mb-4">

                <h1 class="fw-bold">
                    Editar Obra
                </h1>

                <p class="text-secondary">
                    Atualize as informações da obra.
                </p>

            </div>

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body p-5">

                    <form method="POST"
                        action="/obras/atualizar/{{ $obra->id }}">

                        @csrf
                        @method('PUT')

                        <div class="mb-4">

                            <label class="form-label fw-semibold">
                                Título
                            </label>

                            <input
                                type="text"
                                name="titulo"
                                value="{{ old('titulo', $obra->titulo) }}"
                                class="form-control form-control-lg @error('titulo') is-invalid @enderror">

                            @error('titulo')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        <div class="mb-4">

                            <label class="form-label fw-semibold">
                                Tipo
                            </label>

                            <select
                                id="tipo"
                                name="tipo"
                                class="form-select form-select-lg @error('tipo') is-invalid @enderror">

                                <option value="">
                                    Selecione
                                </option>

                                <option
                                    value="Filme"
                                    @selected(old('tipo', $obra->tipo) == 'Filme')>
                                    Filme
                                </option>

                                <option
                                    value="Serie"
                                    @selected(old('tipo', $obra->tipo) == 'Serie')>
                                    Série
                                </option>

                                <option
                                    value="Livro"
                                    @selected(old('tipo', $obra->tipo) == 'Livro')>
                                    Livro
                                </option>

                            </select>

                            @error('tipo')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        <div class="mb-4">

                            <label class="form-label fw-semibold">
                                Descrição
                            </label>

                            <textarea
                                name="descricao"
                                rows="4"
                                class="form-control @error('descricao') is-invalid @enderror">{{ old('descricao', $obra->descricao) }}</textarea>

                            @error('descricao')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        <div id="campoDuracao"
                            class="mb-4 d-none">

                            <label class="form-label fw-semibold">
                                Duração (minutos)
                            </label>

                            <input
                                type="number"
                                name="duracao"
                                value="{{ old('duracao', $obra->duracao) }}"
                                class="form-control form-control-lg @error('duracao') is-invalid @enderror">

                            @error('duracao')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        <div id="campoPaginas"
                            class="mb-4 d-none">

                            <label class="form-label fw-semibold">
                                Páginas
                            </label>

                            <input
                                type="number"
                                name="paginas"
                                value="{{ old('paginas', $obra->paginas) }}"
                                class="form-control form-control-lg @error('paginas') is-invalid @enderror">

                            @error('paginas')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        <div id="campoTemporada"
                            class="mb-4 d-none">

                            <label class="form-label fw-semibold">
                                Temporadas
                            </label>

                            <input
                                type="number"
                                name="temporada"
                                value="{{ old('temporada', $obra->temporada) }}"
                                class="form-control form-control-lg @error('temporada') is-invalid @enderror">

                            @error('temporada')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        <div class="row">

                            <div class="col-md-6 mb-4">

                                <label class="form-label fw-semibold">
                                    Autor
                                </label>

                                <select
                                    name="autor_id"
                                    class="form-select form-select-lg @error('autor_id') is-invalid @enderror">

                                    <option value="">
                                        Selecione um autor
                                    </option>

                                    @foreach($autores as $autor)

                                        <option
                                            value="{{ $autor->id }}"
                                            @selected(old('autor_id', $obra->autor_id) == $autor->id)>

                                            {{ $autor->nome }}

                                        </option>

                                    @endforeach

                                </select>

                                @error('autor_id')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            <div class="col-md-6 mb-4">

                                <label class="form-label fw-semibold">
                                    Tema
                                </label>

                                <select
                                    name="tema_id"
                                    class="form-select form-select-lg @error('tema_id') is-invalid @enderror">

                                    <option value="">
                                        Selecione um tema
                                    </option>

                                    @foreach($temas as $tema)

                                        <option
                                            value="{{ $tema->id }}"
                                            @selected(old('tema_id', $obra->tema_id) == $tema->id)>

                                            {{ $tema->descricao }}

                                        </option>

                                    @endforeach

                                </select>

                                @error('tema_id')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

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

<script>

function atualizarCampos() {

    const tipo = document.getElementById('tipo').value;

    document.getElementById('campoDuracao').classList.add('d-none');
    document.getElementById('campoPaginas').classList.add('d-none');
    document.getElementById('campoTemporada').classList.add('d-none');

    if (tipo === 'Filme') {
        document.getElementById('campoDuracao').classList.remove('d-none');
    }

    if (tipo === 'Livro') {
        document.getElementById('campoPaginas').classList.remove('d-none');
    }

    if (tipo === 'Serie') {
        document.getElementById('campoTemporada').classList.remove('d-none');
    }

}

document.addEventListener('DOMContentLoaded', () => {

    atualizarCampos();

    document
        .getElementById('tipo')
        .addEventListener('change', atualizarCampos);

});

</script>

@endsection
