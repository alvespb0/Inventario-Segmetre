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
    @stack('scripts-head')
    @yield('scripts-head')
    <meta name="theme-color" content="#0A1128">
    <meta name="color-scheme" content="dark light">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="app-shell">
        <header class="site-header">
            <div class="container navbar">
                <a class="brand" href="{{ url('/') }}" aria-label="Página inicial">
                    <span class="brand-mark"></span>
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

                <nav id="primary-nav" class="nav-links" aria-label="Navegação principal">
                    <a href="{{ url('/') }}" class="nav-link is-active">Início</a>
                    <a href="#setores" class="nav-link">Setores</a>
                    <a href="#" class="nav-link">Itens</a>
                    <a href="#" class="nav-link">Relatórios</a>
                    <a href="#" class="nav-link">Configurações</a>
                    <div class="nav-actions">
                        <button class="btn btn-ghost" type="button">Ajuda</button>
                        <button class="btn btn-primary" type="button">Novo Registro</button>
                    </div>
                </nav>
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
    <script defer src="{{ asset('assets/app.js') }}"></script>
    @stack('body-end')
    @yield('body-end')
</body>
</html>


