@extends('layouts.app')

@section('title', 'Autores')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>Autores</h2>

        <a
            href="{{ route('autores.criar.form') }}"
            class="btn btn-scannan">
            Novo Autor
        </a>

    </div>

    <div class="card">

        <div class="card-body">

            <table class="table table-striped align-middle">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th width="180">Ações</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($autores as $autor)

                        <tr>

                            <td>{{ $autor->id }}</td>

                            <td>{{ $autor->nome }}</td>

                            <td>

                                <div class="d-flex gap-2">

                                    <a
                                        href="{{ route('autores.editar.form', $autor->id) }}"
                                        class="btn btn-warning btn-sm">
                                        Editar
                                    </a>

                                    <form
                                        action="{{ route('autores.deletar', $autor->id) }}"
                                        method="POST"
                                        class="form-excluir m-0">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-danger btn-sm">

                                            Excluir

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="3" class="text-center">
                                Nenhum autor encontrado
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection