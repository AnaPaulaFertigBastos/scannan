<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','Scannan')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body id="app-body" class="theme-light">

  <nav class="navbar navbar-expand-lg bg-white border-bottom">
      <div class="container">

          <a class="navbar-brand d-flex align-items-center gap-2" href="/">
              <img src="{{ asset('images/scannan.png') }}"
                  alt="Scannan"
                  style="height: 40px">

              <span class="fw-bold fs-4">
                  Scannan
              </span>
          </a>

      </div>
      <div class="ms-auto d-flex align-items-center gap-3">

        @if(session('jwt_token'))

            <div class="dropdown">

                <button
                    class=" dropdown-toggle"
                    type="button"
                    data-bs-toggle="dropdown"
                    aria-expanded="false">

                    Minha Conta

                </button>

                <ul class="dropdown-menu dropdown-menu-end">

                    <li>
                        <a class="dropdown-item" href="/usuario/perfil">
                            Perfil
                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item" href="/usuario/alterar-senha">
                            Alterar Senha
                        </a>
                    </li>

                </ul>

            </div>

            <form action="/usuario/logout" method="POST">
                @csrf

                <button type="submit" class="btn btn-outline-danger">
                    Sair
                </button>
            </form>

        @endif

        <button
            id="theme-toggle"
            class="d-flex justify-content-center align-items-center btn">
        </button>

    </div>
  </nav>

  <div class="container py-5">
      @yield('content')
  </div>

</body>
</html>