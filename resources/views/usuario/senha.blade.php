@extends('layouts.app')

@section('title', 'Alterar Senha')

@section('content')

<div class="container">

    <div class="row justify-content-center align-items-center"
         style="min-height: 80vh;">

        <div class="col-lg-6">

            <div class="text-center mb-4">

                <h1 class="fw-bold">
                    Alterar Senha
                </h1>

                <p class="text-secondary">
                    Defina uma nova senha para sua conta.
                </p>

            </div>

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body p-5">

                    <form method="POST"
                          action="/usuario/alterar-senha">

                        @csrf
                        @method('PATCH')

                        <div class="mb-4">

                          <label class="form-label fw-semibold">
                              Senha Atual
                          </label>

                          <div class="position-relative">

                              <input
                                  type="password"
                                  id="senha_atual"
                                  name="senha_atual"
                                  class="form-control form-control-lg pe-5 @error('senha_atual') is-invalid @enderror">

                              <button
                                  type="button"
                                  onclick="mostrarSenha('senha_atual', this)"
                                  class="btn position-absolute top-50 end-0 translate-middle-y border-0 bg-transparent">

                                  <i class="bi bi-eye-fill"></i>

                              </button>

                          </div>

                          @error('senha_atual')
                              <div class="invalid-feedback d-block">
                                  {{ $message }}
                              </div>
                          @enderror

                      </div>

                        <div class="mb-4">

                            <label class="form-label fw-semibold">
                                Nova Senha
                            </label>

                            <div class="position-relative">

                                <input
                                    type="password"
                                    id="nova_senha"
                                    name="nova_senha"
                                    class="form-control form-control-lg pe-5 @error('nova_senha') is-invalid @enderror">

                                <button
                                    type="button"
                                    onclick="mostrarSenha('nova_senha', this)"
                                    class="btn position-absolute top-50 end-0 translate-middle-y border-0 bg-transparent">

                                    <i class="bi bi-eye-fill"></i>

                                </button>

                            </div>

                            @error('nova_senha')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        <div class="mb-4">

                          <label class="form-label fw-semibold">
                              Confirmar Nova Senha
                          </label>

                          <div class="position-relative">

                              <input
                                  type="password"
                                  id="nova_senha_confirmation"
                                  name="nova_senha_confirmation"
                                  class="form-control form-control-lg pe-5">

                              <button
                                  type="button"
                                  onclick="mostrarSenha('nova_senha_confirmation', this)"
                                  class="btn position-absolute top-50 end-0 translate-middle-y border-0 bg-transparent">

                                  <i class="bi bi-eye-fill"></i>

                              </button>

                          </div>

                      </div>

                        <button
                            type="submit"
                            class="btn btn-scannan btn-lg w-100">

                            Alterar Senha

                        </button>

                    </form>

                    @error('erro')
                        <div class="alert alert-danger mt-3 mb-0">
                            {{ $message }}
                        </div>
                    @enderror

                    @if(session('sucesso'))
                        <div class="alert alert-success mt-3 mb-0">
                            {{ session('sucesso') }}
                        </div>
                    @endif

                </div>

            </div>

        </div>

    </div>

</div>
<script>

</script>
@endsection