@extends('layouts.base')

@section('title', 'Fornecedores | Fornecedores do Item')

@section('content')
    <section class="card" style="padding: 1.25rem;">
        <header style="display:flex; justify-content: space-between; align-items:center; gap:1rem; margin-bottom: .75rem;">
            <h1 style="margin:0; font-size: 1.25rem;">Fornecedores do Item {{ $itemFornecedor->first()->item->nome }}</h1>
            <form method="GET" action="{{ url()->current() }}" style="display:flex; gap:.5rem; align-items:center;">
                <input
                    type="search"
                    name="q"
                    class="input"
                    placeholder="Buscar por nome/descrição"
                    value="{{ request('q') }}"
                    style="min-width: 220px;"
                    aria-label="Buscar itens"
                />
                <button type="submit" class="btn btn-ghost">Buscar</button>
            </form>
        </header>

            <div id="itens-setor-list" class="table-like">
                <div class="table-row table-head" style="display:grid; grid-template-columns: 80px 1.2fr 2fr 1.5fr 1fr 160px; gap:.75rem; padding:.6rem .75rem; border-bottom:1px solid rgba(254,252,251,.08); color:#cfe8f0;">
                    <div style="font-weight:600;">Código</div>
                    <div style="font-weight:600;">Nome do Item</div>
                    <div style="font-weight:600;">Descricao</div>
                    <div style="font-weight:600;">Fornecedor</div>
                    <div style="font-weight:600;">É cliente Segmetre?</div>
                    <div style="font-weight:600; text-align:right;">Valor Unitário</div>
                </div>

                @forelse($itemFornecedor as $item)
                    <div class="table-row" style="display:grid; grid-template-columns: 80px 1.2fr 2fr 1.5fr 1fr 160px; gap:.75rem; align-items:center; padding:.6rem .75rem; border-bottom:1px solid rgba(254,252,251,.06);">
                        <div>#{{ $item->id }}</div>
                        <div>{{ $item->item->nome }}</div>
                        <div>{{ $item->item->descricao }}</div>
                        <div>{{ $item->fornecedor->cliente_segmetre ? 'Sim' : 'Não' }}</div>
                        <div>{{ $item->fornecedor->nome }}</div>
                        <form method="POST" action="{{route('itens.fornecedores-atualiza-valor')}}" style="display:flex; justify-content:flex-end; gap:.5rem;">
                            @csrf
                            <input type="hidden" name="itemFornecedor_id" value="{{ $item->id }}" />
                            <input
                                type="number"
                                name="valor_unitario"
                                min="0"
                                step="1"
                                class="input"
                                style="max-width: 160px; text-align:right;"
                                value="{{ $item->valor_unitario ?? 0}}"
                                aria-label="Valor Unitario"
                                onchange="this.form.submit()"
                            />
                        </form>
                    </div>
                @empty
                    <div class="card" style="padding: .9rem;">Nenhum item encontrado.</div>
                @endforelse
            </div>
    </section>
@endsection


