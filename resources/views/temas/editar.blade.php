@extends('layouts.app')

@section('title', 'Editar Tema')

@section('content')

<div class="card">

    <div class="card-header">
        <h3>Editar Tema</h3>
    </div>

    <div class="card-body">

        <form
            action="{{ route('temas.salvar.edicao', $tema->id) }}"
            method="POST">

            @csrf
            @method('PUT')

            <div class="mb-3">

                <label class="form-label">
                    Descrição
                </label>

                <input
                    type="text"
                    name="descricao"
                    class="form-control"
                    value="{{ old('descricao', $tema->descricao) }}"
                    required>

            </div>

            <div class="d-flex gap-2">

                <button
                    type="submit"
                    class="btn btn-scannan">
                    Salvar Alterações
                </button>

                <a
                    href="{{ route('temas.listar') }}"
                    class="btn btn-outline-secondary">
                    Cancelar
                </a>

            </div>

        </form>

    </div>

</div>

@endsection