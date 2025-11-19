@extends('layouts.base')

@section('title', 'Itens por Setor | Inventário por Setores')

@section('content')
    <section class="card" style="padding: 1.25rem;">
        <header style="display:flex; justify-content: space-between; align-items:center; gap:1rem; margin-bottom: .75rem;">
            <h1 style="margin:0; font-size: 1.25rem;">Itens do Setor {{$itensSetor->first() ? $itensSetor->first()->setor->nome : ''}}</h1>
        <form action="{{route('itemSetor.filter', $itensSetor->first() ? $itensSetor->first()->setor->id : '')}}" method="GET">
            <div style="display:flex; justify-content: space-between; align-items: center; gap:.75rem; margin-bottom: .75rem;">
                <input type="search" class="input" name="busca" placeholder="Buscar Item..." style="width:100%;" />
                <div style="display:flex; gap:.5rem;">
                    <button class="btn btn-ghost" type="submit">Filtrar</button>
                </div>
            </div>
        </form>
        </header>

            <div id="itens-setor-list" class="table-like">
                <div class="table-row table-head" style="display:grid; grid-template-columns: 120px 1fr 2fr 180px 100px; gap:.75rem; padding:.6rem .75rem; border-bottom:1px solid rgba(254,252,251,.08); color:#cfe8f0;">
                    <div style="font-weight:600;">Código</div>
                    <div style="font-weight:600;">Nome do Item</div>
                    <div style="font-weight:600;">Descricao</div>
                    <div style="font-weight:600; text-align:right;">Qtd. em estoque</div>
                    <div style="font-weight:600; text-align:center">#</div>
                </div>

                @forelse($itensSetor as $item)
                    <div class="table-row" style="display:grid; grid-template-columns: 120px 1fr 2fr 180px 100px; gap:.75rem; align-items:center; padding:.6rem .75rem; border-bottom:1px solid rgba(254,252,251,.06);">
                        <div>#{{ $item->id }}</div>
                        <div>{{ $item->item->nome }}</div>
                        <div>{{ $item->item->descricao }}</div>
                        <form method="POST" action="{{route('itemSetor.update-estoque')}}" style="display:flex; justify-content:flex-end; gap:.5rem;">
                            @csrf
                            <input type="hidden" name="itemSetor_id" value="{{ $item->id }}" />
                            <input
                                type="number"
                                name="qtd_estoque"
                                min="0"
                                step="1"
                                class="input"
                                style="max-width: 160px; text-align:right;"
                                value="{{ $item->qtd_estoque }}"
                                aria-label="Quantidade em estoque"
                                onchange="this.form.submit()"
                            />
                        </form>
                        <div style="display:flex; justify-content:center;">
                            <form method="POST" action="{{route('itemSetor.delete')}}" style="margin:0;">
                                @csrf
                                <input type="hidden" name="itemSetor_id" value="{{ $item->id }}" />
                                <button type="submit" class="btn btn-ghost">Deletar</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="card" style="padding: .9rem;">Nenhum item encontrado.</div>
                @endforelse
            </div>
    </section>
@endsection


