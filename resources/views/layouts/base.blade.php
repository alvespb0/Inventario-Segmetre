<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Inventário por Setores')</title>
    <link rel="stylesheet" href="{{ asset('assets/app.css') }}">
    @stack('head')
    @yield('head')
    @stack('styles')
    @yield('styles')
    <meta name="theme-color" content="#0A1128">
    <meta name="color-scheme" content="dark light">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
<body>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- se necessário -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <div class="app-shell">
        <header class="site-header">
            <div class="container navbar">
                <a class="brand" href="'/'" aria-label="Página inicial">
                    <span class="brand-text">
                        <span class="brand-title">Inventário Segmetre</span>
                        <span class="brand-sub">Controle simples, visão completa</span>
                    </span>
                </a>

                <button class="nav-toggle" aria-expanded="false" aria-controls="primary-nav">
                    <span class="nav-toggle-bar"></span>
                    <span class="nav-toggle-bar"></span>
                    <span class="nav-toggle-bar"></span>
                </button>

                @if(auth()->user())
                <nav id="primary-nav" class="nav-links" aria-label="Navegação principal">
                    <a href="{{ url('/') }}" class="nav-link {{ request()->is('/') ? 'is-active' : '' }}">Início</a>
                    <a href="/setores" class="nav-link {{ request()->is('setores') ? 'is-active' : '' }}">Setores</a>
                    <a href="#" class="nav-link {{ request()->is('itens') ? 'is-active' : '' }}">Itens</a>
                    <a href="#" class="nav-link {{ request()->is('fornecedores') ? 'is-active' : '' }}">Fornecedores</a>
                    <a href="#" class="nav-link {{ request()->is('relatorios') ? 'is-active' : '' }}">Relatórios</a>
                    <a href="/usuarios" class="nav-link {{ request()->is('usuarios') ? 'is-active' : '' }}">Usuários</a>
                    <div class="nav-actions">
                        <a href="#"><button class="btn btn-ghost" type="button">Ajuda</button></a>
                        <a href="/logout"><button class="btn btn-primary" type="button">Sair</button></a>
                    </div>
                </nav>
                @endif
            </div>
        </header>

        <main>
            <div class="container">
                @yield('content')
            </div>
        </main>

        <footer class="footer">
            <div class="container" style="display:flex; justify-content: space-between; align-items:center; gap: 1rem;">
                <span>© {{ date('Y') }} Inventário por Setores</span>
                <span>Feito com <span aria-hidden>💙</span> usando Laravel</span>
            </div>
        </footer>
    </div>

    <script>
        @if(session('mensagem'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "timeOut": "4000"
            };
            toastr.success("{{ session('mensagem') }}");
        @endif
        @if(session('error'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "timeOut": "4000"
            };
            toastr.error("{{ session('error') }}");
        @endif
    </script>

    @stack('body-end')
    @yield('body-end')
</body>
</html>


