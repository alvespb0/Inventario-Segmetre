@extends('layouts.base')

@section('title', 'Itens | Listagem de Itens')

@section('content')
    <section style="display:flex; justify-content: space-between; align-items: center; gap: 1rem; margin: .5rem 0 1rem;">
        <div>
            <h1 style="margin:0; font-size: 1.25rem;">Itens</h1>
            <p style="margin:.25rem 0 0; color:#cfe8f0;">Lista de Itens cadastrados.</p>
        </div>
        <div>
            <a href="/itens/novo" class="btn btn-primary">Novo Item</a>
        </div>
    </section>

<section class="card" style="padding: 1rem;">
    <div style="display:flex; justify-content: space-between; align-items: center; gap:.75rem; margin-bottom: .75rem;">
        <input type="search" class="input" placeholder="Buscar Item..." style="width:100%;" />
        <div style="display:flex; gap:.5rem;">
            <button class="btn btn-ghost" type="button">Filtrar</button>
            <button class="btn btn-ghost" type="button">Exportar</button>
        </div>
    </div>

    <div style="overflow-x:auto;">
        <table style="width:100%; border-collapse:collapse; min-width:600px;">
            <thead>
                <tr style="background:rgba(254,252,251,.08); text-align:left;">
                    <th style="padding:.75rem 1rem; border-bottom:1px solid rgba(254,252,251,.1);">#</th>
                    <th style="padding:.75rem 1rem; border-bottom:1px solid rgba(254,252,251,.1);">Nome</th>
                    <th style="padding:.75rem 1rem; border-bottom:1px solid rgba(254,252,251,.1);">Descricao</th>
                    <th style="padding:.75rem 1rem; border-bottom:1px solid rgba(254,252,251,.1); text-align:right;">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($itens as $item)
                    <tr style="border-bottom:1px solid rgba(254,252,251,.05);">
                        <td style="padding:.75rem 1rem;">{{ $item->id }}</td>
                        <td style="padding:.75rem 1rem;">{{ $item->nome }}</td>
                        <td style="padding:.75rem 1rem;">{{ $item->descricao ?? '-' }}</td>
                        <td style="padding:.75rem 1rem; text-align:right;">
                            <a href="#" class="btn btn-ghost" style="padding:.4rem .8rem;">Abrir</a>
                            <a href="/itens/editar/{{ $item->id }}" class="btn btn-ghost" style="padding:.4rem .8rem;">Editar</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="padding:1rem; text-align:center; color:#cfe8f0;">Nenhum item encontrado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>
@endsection


