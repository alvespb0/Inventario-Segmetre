@extends('layouts.base')

@section('title', 'Item | Listagem de Itens do Setor')

@section('content')
    <section style="display:flex; justify-content: space-between; align-items: center; gap: 1rem; margin: .5rem 0 1rem;">
        <div>
            <h1 style="margin:0; font-size: 1.25rem;"></h1>
            <p style="margin:.25rem 0 0; color:#cfe8f0;">.</p>
        </div>
        <div>
            <a href="/itens-setor/novo" class="btn btn-primary">Novo Registro</a>
        </div>
    </section>

    <section class="card" style="padding: 1rem;">
        <div style="display:grid; grid-template-columns: 1fr auto; gap:.75rem; align-items:center; margin-bottom: .75rem;">
            <input type="search" class="input" placeholder="Buscar Item no Setor..." style="width:100%;" />
            <div style="display:flex; gap:.5rem;">
                <button class="btn btn-ghost" type="button">Filtrar</button>
                <button class="btn btn-ghost" type="button">Exportar</button>
            </div>
        </div>

    </section>
@endsection


