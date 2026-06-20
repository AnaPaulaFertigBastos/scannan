<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Scannan')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body id="app-body" class="theme-light">

    <nav class="navbar navbar-expand-lg bg-white border-bottom">

        <div class="container">

            <a class="navbar-brand d-flex align-items-center gap-2" href="/">
                <img
                    src="{{ asset('images/scannan.png') }}"
                    alt="Scannan"
                    style="height: 40px">

                <span class="fw-bold fs-4">
                    Scannan
                </span>
            </a>

            @if(session('jwt_token'))

                <div class="d-flex align-items-center gap-4 ms-auto">

                    <a
                        href="{{ route('autores.listar') }}"
                        class="text-decoration-none text-dark fw-semibold">

                        Autores

                    </a>

                    <a
                        href="{{ route('temas.listar') }}"
                        class="text-decoration-none text-dark fw-semibold">

                        Temas

                    </a>

                    <div class="dropdown">

                        <button
                            class="btn dropdown-toggle fw-semibold"
                            type="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false">

                            Minha Conta

                        </button>

                        <ul class="dropdown-menu dropdown-menu-end">

                            <li>
                                <a
                                    class="dropdown-item"
                                    href="{{ route('usuario.perfil') }}">

                                    Perfil

                                </a>
                            </li>

                            <li>
                                <a
                                    class="dropdown-item"
                                    href="{{ route('favoritos.listar') }}">

                                    Meus Favoritos

                                </a>
                            </li>

                            <li>
                                <a
                                    class="dropdown-item"
                                    href="{{ route('usuario.senha') }}">

                                    Alterar Senha

                                </a>
                            </li>

                        </ul>

                    </div>

                    <form action="{{ route('logout') }}" method="POST">

                        @csrf

                        <button
                            type="submit"
                            class="btn btn-outline-danger">

                            Sair

                        </button>

                    </form>
            @endif
            
                    <button
                        id="theme-toggle"
                        class="btn d-flex justify-content-center align-items-center">
                    </button>

                </div>

            

        </div>

    </nav>

        <div class="container mt-3">

            @if(session('success'))

                <div class="alert alert-success alert-dismissible fade show auto-close-alert">

                    {{ session('success') }}

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="alert">
                    </button>

                </div>

            @endif

            @if(session('error'))

                <div class="alert alert-danger alert-dismissible fade show auto-close-alert">

                    {{ session('error') }}

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="alert">
                    </button>

                </div>

            @endif

        </div>

    <div class="container py-5">
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
</body>
</html>