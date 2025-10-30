@extends('layouts.base')

@section('title', 'Setores | Inventário por Setores')

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
        @php
            // Variáveis genéricas enquanto o backend é confeccionado
            $setores = $setores ?? [
                ['id' => 1, 'nome' => 'Administração', 'itens' => 0],
                ['id' => 2, 'nome' => 'Financeiro', 'itens' => 0],
                ['id' => 3, 'nome' => 'TI', 'itens' => 0],
                ['id' => 4, 'nome' => 'Operações', 'itens' => 0],
            ];
        @endphp

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
                            <div style="font-weight:700;">{{ $setor['nome'] }}</div>
                            <div style="font-size:.9rem; color:#cfe8f0;">{{ $setor['itens'] }} itens</div>
                        </div>
                        <span style="display:inline-flex; width: 34px; height: 34px; border-radius: .6rem; background: var(--c-accent);"></span>
                    </div>

                    <div style="display:flex; gap:.5rem; margin-top: .75rem;">
                        <a href="#" class="btn btn-ghost">Abrir</a>
                        <a href="#" class="btn btn-ghost">Editar</a>
                    </div>
                </article>
            @empty
                <div class="card" style="padding:1rem; text-align:center;">Nenhum setor encontrado.</div>
            @endforelse
        </div>
    </section>
@endsection


