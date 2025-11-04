@extends('layouts.base')

@section('title', 'Setores | Listagem de Setores')

@section('content')
    <section style="display:flex; justify-content: space-between; align-items: center; gap: 1rem; margin: .5rem 0 1rem;">
        <div>
            <h1 style="margin:0; font-size: 1.25rem;">Setores</h1>
            <p style="margin:.25rem 0 0; color:#cfe8f0;">Lista de setores cadastrados.</p>
        </div>
        <div>
            <a href="{{ url('/setores/novo') }}" class="btn btn-primary">Novo Setor</a>
        </div>
    </section>

    <section class="card" style="padding: 1rem;">
        <div style="display:grid; grid-template-columns: 1fr auto; gap:.75rem; align-items:center; margin-bottom: .75rem;">
            <input type="search" class="input" placeholder="Buscar setor..." style="width:100%;" />
            <div style="display:flex; gap:.5rem;">
                <button class="btn btn-ghost" type="button">Filtrar</button>
                <button class="btn btn-ghost" type="button">Exportar</button>
            </div>
        </div>

        <div style="display:grid; grid-template-columns: repeat(auto-fill, minmax(240px, 1fr)); gap: 1rem;">
            @forelse($setores as $setor)
                <article class="card" style="padding: 1rem;">
                    <div style="display:flex; justify-content: space-between; align-items: center; gap:.5rem;">
                        <div>
                            <div style="font-weight:700;">{{ $setor->nome }}</div>
                        </div>
                    </div>

                    <div style="display:flex; gap:.5rem; margin-top: .75rem;">
                        <a href="#" class="btn btn-ghost">Abrir</a>
                        <a href="setores/editar/{{$setor->id}}" class="btn btn-ghost">Editar</a>
                    </div>
                </article>
            @empty
                <div class="card" style="padding:1rem; text-align:center;">Nenhum setor encontrado.</div>
            @endforelse
        </div>
    </section>
@endsection


