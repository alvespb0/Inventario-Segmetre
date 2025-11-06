@extends('layouts.base')

@section('title', 'Entrar | Inventário por Setores')

@section('content')
    <section class="card card-center" style="padding: 1.25rem; max-width: 720px;">
        <header style="margin-bottom: 1rem;">
            <h1 style="margin: 0 0 .25rem; font-size: 1.4rem;">Acessar conta</h1>
            <p style="margin: 0; color: #cfe8f0;">Use seu login ou e-mail e sua senha para entrar.</p>
        </header>

        <form method="post" action="{{route('try.login')}}" style="display:grid; gap: 1rem;">
            @csrf
            <div>
                <label for="login" style="font-weight:600;">Login ou E-mail</label>
                <input
                    id="login"
                    name="login"
                    type="text"
                    class="input"
                    placeholder="seu.login ou voce@empresa.com"
                    required
                    autofocus
                />
            </div>

            <div>
                <label for="password" style="font-weight:600;">Senha</label>
                <input
                    id="password"
                    name="senha"
                    type="password"
                    class="input"
                    placeholder="••••••••"
                    required
                />
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%;">Entrar</button>
        </form>
    </section>
@endsection

