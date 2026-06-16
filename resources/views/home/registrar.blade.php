@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center align-items-center"
         style="min-height: 80vh;">

        <div class="col-lg-6">

            <div class="text-center mb-4">

                <h1 class="fw-bold">
                    Criar Conta
                </h1>

                <p class="text-secondary">
                    Cadastre-se para avaliar filmes, séries e livros.
                </p>

            </div>

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body p-5">

                    <form method="POST"
                          action="{{ route('usuario.registrar') }}">

                        @csrf

                        <div class="row">

                            <div class="col-md-6 mb-4">

                                <label class="form-label fw-semibold">
                                    Nome
                                </label>

                                <input
                                    type="text"
                                    name="nome"
                                    value="{{ old('nome') }}"
                                    class="form-control form-control-lg @error('nome') is-invalid @enderror">

                                @error('nome')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">

                                <label class="form-label fw-semibold">
                                    Sobrenome
                                </label>

                                <input
                                    type="text"
                                    name="sobrenome"
                                    value="{{ old('sobrenome') }}"
                                    class="form-control form-control-lg @error('sobrenome') is-invalid @enderror">

                                @error('sobrenome')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                        </div>

                        <div class="mb-4">

                            <label class="form-label fw-semibold">
                                Apelido
                            </label>

                            <input
                                type="text"
                                name="apelido"
                                value="{{ old('apelido') }}"
                                class="form-control form-control-lg @error('apelido') is-invalid @enderror">

                            @error('apelido')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4">

                            <label class="form-label fw-semibold">
                                E-mail
                            </label>

                            <input
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                class="form-control form-control-lg @error('email') is-invalid @enderror">

                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4">

                            <label class="form-label fw-semibold">
                                Data de Nascimento
                            </label>

                            <input
                                type="date"
                                name="nascimento"
                                value="{{ old('nascimento') }}"
                                class="form-control form-control-lg @error('nascimento') is-invalid @enderror">

                            @error('nascimento')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        

                        <div class="mb-4">

                            <label class="form-label fw-semibold">
                                Senha
                            </label>

                            <div class="position-relative">

                                <input
                                    type="password"
                                    id="senha"
                                    name="senha"
                                    class="form-control form-control-lg pe-5 @error('senha') is-invalid @enderror">


                                    
                                <button
                                    type="button"
                                    onclick="mostrarSenha('senha', this)"
                                    class="btn position-absolute top-50 end-0 translate-middle-y border-0 bg-transparent">

                                    <i class="bi bi-eye-fill"></i>

                                </button>

                                
                                
                            </div>

                            @error('senha')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button
                            type="submit"
                            class="btn btn-scannan btn-lg w-100">

                            Criar Conta

                        </button>

                    </form>

                    @error('erro')
                        <div class="alert alert-danger m-0 mt-2 pt-2 pb-2 pr-3 pl-3">
                            {{ $message }}
                        </div>
                    @enderror

                    <hr class="my-4">

                    <p class="text-center text-secondary mb-0">

                        Já possui uma conta?

                        <a href="{{ route('home.login') }}"
                           class="text-decoration-none fw-semibold text-scannan">

                            Entrar

                        </a>

                    </p>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection