@extends('layouts.app')

@section('title', 'Temas')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>Temas</h2>

        <a
            href="{{ route('temas.criar.form') }}"
            class="btn btn-scannan">
            Novo Tema
        </a>

    </div>

    <div class="card">

        <div class="card-body">

            <table class="table table-striped align-middle">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Descrição</th>
                        <th width="180">Ações</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($temas as $tema)

                        <tr>

                            <td>{{ $tema->id }}</td>

                            <td>{{ $tema->descricao }}</td>

                            <td>

                                <div class="d-flex gap-2">

                                    <a
                                        href="{{ route('temas.editar.form', $tema->id) }}"
                                        class="btn btn-warning btn-sm">
                                        Editar
                                    </a>

                                    <form
                                        action="{{ route('temas.deletar', $tema->id) }}"
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
                                Nenhum tema encontrado
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection