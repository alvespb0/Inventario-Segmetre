@extends('layouts.base')

@section('title', 'Usuários | Listagem de Usuários')

@section('content')
    <section style="display:flex; justify-content: space-between; align-items: center; gap: 1rem; margin: .5rem 0 1rem;">
        <div>
            <h1 style="margin:0; font-size: 1.25rem;">Usuários</h1>
            <p style="margin:.25rem 0 0; color:#cfe8f0;">Lista de Usuários cadastrados.</p>
        </div>
        <div>
            <a href="/usuarios/novo" class="btn btn-primary">Novo Usuário</a>
        </div>
    </section>

    <section class="card" style="padding: 1rem;">
        <div style="display:grid; grid-template-columns: 1fr auto; gap:.75rem; align-items:center; margin-bottom: .75rem;">
            <input type="search" class="input" placeholder="Buscar usuário..." style="width:100%;" />
            <div style="display:flex; gap:.5rem;">
                <button class="btn btn-ghost" type="button">Filtrar</button>
                <button class="btn btn-ghost" type="button">Exportar</button>
            </div>
        </div>

        <div style="display:grid; grid-template-columns: repeat(auto-fill, minmax(240px, 1fr)); gap: 1rem;">
            @forelse($usuarios as $user)
                <article class="card" style="padding: 1rem;">
                    <div style="display:flex; justify-content: space-between; align-items: center; gap:.5rem;">
                        <div>
                            <div style="font-weight:700;">{{ $user->nome }}</div>
                        </div>
                    </div>

                    <div style="display:flex; gap:.5rem; margin-top: .75rem;">
                        <a href="#" class="btn btn-ghost">Abrir</a>
                        <a href="/usuario/editar/{{$user->id}}" class="btn btn-ghost">Editar</a>
                    </div>
                </article>
            @empty
                <div class="card" style="padding:1rem; text-align:center;">Nenhum usuário encontrado.</div>
            @endforelse
        </div>
    </section>
@endsection


