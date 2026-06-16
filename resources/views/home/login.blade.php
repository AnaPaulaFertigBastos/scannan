@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center align-items-center"
         style="min-height: 80vh;">

        <div class="col-lg-5">

            <div class="text-center mb-4">

                <h1 class="fw-bold">
                    Bem-vindo de volta!
                </h1>

                <p class="text-secondary">
                    Entre para avaliar filmes, séries e livros.
                </p>

            </div>

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body p-5">

                    <form method="POST" action="/usuario/login">

                        @csrf

                        <div class="mb-4">

                            <label class="form-label fw-semibold">
                                E-mail
                            </label>

                            <input
                                type="email"
                                name="email"
                                class="form-control form-control-lg">

                        </div>

                        <div class="mb-4">

                            <label class="form-label fw-semibold">
                                Senha
                            </label>

                            <input
                                type="password"
                                name="senha"
                                class="form-control form-control-lg">

                        </div>

                        <button
                            type="submit"
                            class="btn btn-scannan btn-lg w-100" >

                            Entrar

                        </button>

                    </form>

                    <div class="mt-3">
                      @error('erro')
                          <div class="alert alert-danger m-0 pt-2 pb-2 pr-3 pl-3">
                              {{ $message }}
                          </div>
                      @enderror
                    </div>

                    <hr class="my-4">

                    <p class="text-center text-secondary mb-0">

                        Ainda não possui uma conta?

                        <a href="/registrar" class="text-decoration-none fw-semibold text-scannan">
                            Criar conta
                        </a>

                    </p>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection