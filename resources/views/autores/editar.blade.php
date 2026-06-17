@extends('layouts.app')

@section('title', 'Editar Autor')

@section('content')

<div class="container">

    <div class="card">

        <div class="card-header">
            <h3 class="mb-0">Editar Autor</h3>
        </div>

        <div class="card-body">

            <form
                action="{{ route('autores.salvar.edicao', $autor->id) }}"
                method="POST">

                @csrf
                @method('PUT')

                <div class="mb-3">

                    <label class="form-label">
                        Nome do Autor
                    </label>

                    <input
                        type="text"
                        name="nome"
                        class="form-control"
                        value="{{ $autor->nome }}"
                        required>

                </div>

                <div class="d-flex gap-2">

                    <button
                        type="submit"
                        class="btn btn-warning">
                        Atualizar
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