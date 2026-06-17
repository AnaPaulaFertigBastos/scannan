@extends('layouts.app')

@section('title', 'Novo Autor')

@section('content')

<div class="container">

    <div class="card">

        <div class="card-header">
            <h3 class="mb-0">Novo Autor</h3>
        </div>

        <div class="card-body">

            <form action="{{ route('autores.salvar') }}" method="POST">

                @csrf

                <div class="mb-3">

                    <label class="form-label">
                        Nome do Autor
                    </label>

                    <input
                        type="text"
                        name="nome"
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
                        href="{{ route('autores.listar') }}"
                        class="btn btn-outline-secondary">
                        Cancelar
                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection