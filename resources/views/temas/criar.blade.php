@extends('layouts.app')

@section('title', 'Novo Tema')

@section('content')

<div class="card">

    <div class="card-header">
        <h3>Novo Tema</h3>
    </div>

    <div class="card-body">

        <form
            action="{{ route('temas.salvar') }}"
            method="POST">

            @csrf

            <div class="mb-3">

                <label class="form-label">
                    Descrição
                </label>

                <input
                    type="text"
                    name="descricao"
                    class="form-control"
                    required>

            </div>

            <div class="d-flex gap-2">

                <button
                    type="submit"
                    class="btn btn-scannan">
                    Salvar
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