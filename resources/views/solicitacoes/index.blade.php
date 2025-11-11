@extends('layouts.base')

@section('title', 'Solicitações | Solicitações do Setor')

@section('content')
    <section style="display:flex; justify-content: space-between; align-items: center; gap: 1rem; margin: .5rem 0 1rem;">
        <div>
            <h1 style="margin:0; font-size: 1.25rem;">Solicitações</h1>
            <p style="margin:.25rem 0 0; color:#cfe8f0;">Lista de Itens Solicitados.</p>
        </div>
        <div>
            <a href="" class="btn btn-primary">Nova Solicitação</a>
        </div>
    </section>

<section class="card" style="padding: 1rem;">        
    <form action="{{route('itens.filter')}}" method="GET">
        <div style="display:flex; justify-content: space-between; align-items: center; gap:.75rem; margin-bottom: .75rem;">
                <input type="search" class="input" name="busca" placeholder="Buscar Solicitação..." style="width:100%;" />
                <div style="display:flex; gap:.5rem;">
                    <button class="btn btn-ghost" type="submit">Filtrar</button>
                    <button class="btn btn-ghost" type="button">Exportar</button>
                </div>
        </div>
    </form>

    <div style="overflow-x:auto;">
        <table style="width:100%; border-collapse:collapse; min-width:600px;">
            <thead>
                <tr style="background:rgba(254,252,251,.08);">
                    <th style="padding:.75rem 1rem; border-bottom:1px solid rgba(254,252,251,.1); text-align:left;">#</th>
                    <th style="padding:.75rem 1rem; border-bottom:1px solid rgba(254,252,251,.1); text-align:left;">Item</th>
                    <th style="padding:.75rem 1rem; border-bottom:1px solid rgba(254,252,251,.1); text-align:center;">Setor</th>
                    <th style="padding:.75rem 1rem; border-bottom:1px solid rgba(254,252,251,.1); text-align:center;">Status</th>
                    <th style="padding:.75rem 1rem; border-bottom:1px solid rgba(254,252,251,.1); text-align:center;">Quantidade</th>
                    <th style="padding:.75rem 1rem; border-bottom:1px solid rgba(254,252,251,.1); text-align:right;">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($solicitacoes as $solicitacao)
                    <tr 
                        class="solicitacao-row" 
                        data-id="{{ $solicitacao->id }}"
                        data-item-nome="{{ e($solicitacao->item->nome) }}"
                        data-item-descricao="{{ e($solicitacao->item->descricao ?? 'Sem descrição') }}"
                        data-setor="{{ e($solicitacao->setor->nome ?? '-') }}"
                        data-status="{{ e($solicitacao->status) }}"
                        data-quantidade="{{ $solicitacao->quantidade }}"
                        data-data-solicitacao="{{ $solicitacao->data_solicitacao }}"
                        data-observacao="{{ e($solicitacao->observacao ?? 'Sem observações') }}"
                        style="border-bottom:1px solid rgba(254,252,251,.05);">
                        <td style="padding:.75rem 1rem; text-align:left;">{{ $solicitacao->id }}</td>
                        <td style="padding:.75rem 1rem; text-align:left;">{{ $solicitacao->item->nome }}</td>
                        <td style="padding:.75rem 1rem; text-align:center;">{{ $solicitacao->setor->nome ?? '-' }}</td>
                        <td style="padding:.75rem 1rem; text-align:center;">
                            <span class="status-badge status-{{ strtolower($solicitacao->status) }}">{{ $solicitacao->status }}</span>
                        </td>
                        <td style="padding:.75rem 1rem; text-align:center;">{{ $solicitacao->quantidade }}</td>
                        <td style="padding:.75rem 1rem; text-align:right;">
                            <button type="button" class="btn btn-ghost btn-abrir-modal" style="padding:.4rem .8rem;" data-id="{{ $solicitacao->id }}">Abrir</button>
                            <a href="" class="btn btn-ghost" style="padding:.4rem .8rem;">Editar</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="padding:1rem; text-align:center; color:#cfe8f0;">Nenhum item encontrado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($solicitacoes->hasPages())
        <div class="pagination-wrapper" style="margin-top: 1.5rem; padding-top: 1rem; border-top: 1px solid rgba(254,252,251,.08);">
            {{ $solicitacoes->links('pagination.custom') }}
        </div>
    @endif
</section>

<!-- Modal de Detalhes da Solicitação -->
<div id="modalSolicitacao" class="modal-overlay" style="display:none;">
    <div class="modal-content">
        <div class="modal-header">
            <h2 style="margin:0; font-size: 1.25rem;">Detalhes da Solicitação</h2>
            <button type="button" class="modal-close" onclick="fecharModal()" aria-label="Fechar">&times;</button>
        </div>
        <div class="modal-body" id="modalBody">
            <div style="display:grid; gap:1rem;">
                <div style="display:grid; gap:.5rem;">
                    <label style="font-weight:600; color:#cfe8f0;">ID da Solicitação</label>
                    <div id="modalId" style="color:#fefcfb;">{{$solicitacao->id}}</div>
                </div>
                <div style="display:grid; gap:.5rem;">
                    <label style="font-weight:600; color:#cfe8f0;">Item</label>
                    <div id="modalItem" style="color:#fefcfb;">{{$solicitacao->item->nome}}</div>
                </div>
                <div style="display:grid; gap:.5rem;">
                    <label style="font-weight:600; color:#cfe8f0;">Descrição do Item</label>
                    <div id="modalItemDescricao" style="color:#fefcfb;">{{$solicitacao->item->descricao}}</div>
                </div>
                <div style="display:grid; gap:.5rem;">
                    <label style="font-weight:600; color:#cfe8f0;">Setor</label>
                    <div id="modalSetor" style="color:#fefcfb;">{{$solicitacao->setor->nome}}</div>
                </div>
                <div style="display:grid; gap:.5rem;">
                    <label style="font-weight:600; color:#cfe8f0;">Quantidade</label>
                    <div id="modalQuantidade" style="color:#fefcfb;">{{$solicitacao->quantidade}}</div>
                </div>
                <div style="display:grid; gap:.5rem;">
                    <label style="font-weight:600; color:#cfe8f0;">Status</label>
                    <div id="modalStatus" style="color:#fefcfb;">{{$solicitacao->status}}</div>
                </div>
                <div style="display:grid; gap:.5rem;">
                    <label style="font-weight:600; color:#cfe8f0;">Data da Solicitação</label>
                    <div id="modalData" style="color:#fefcfb;">{{$solicitacao->data_solicitacao}}</div>
                </div>
                <div style="display:grid; gap:.5rem;">
                    <label style="font-weight:600; color:#cfe8f0;">Observação</label>
                    <div id="modalObservacao" style="color:#fefcfb; min-height:60px; padding:.75rem; background:rgba(10,17,40,.3); border-radius:.5rem; border:1px solid rgba(254,252,251,.1);">{{$solicitacao->observacao}}</div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-ghost" onclick="fecharModal()">Fechar</button>
        </div>
    </div>
</div>

@push('body-end')
<script>
function abrirModal(id) {
    const row = document.querySelector(`tr.solicitacao-row[data-id="${id}"]`);
    if (!row) return;

    
    if (dados.dataSolicitacao) {
        const dataSolicitacao = new Date(dados.dataSolicitacao);
        document.getElementById('modalData').textContent = dataSolicitacao.toLocaleDateString('pt-BR', {
            day: '2-digit',
            month: '2-digit',
            year: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        });
    } else {
        document.getElementById('modalData').textContent = '-';
    }
    
    document.getElementById('modalObservacao').textContent = dados.observacao;

    document.getElementById('modalSolicitacao').style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function fecharModal() {
    document.getElementById('modalSolicitacao').style.display = 'none';
    document.body.style.overflow = 'auto';
}

document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('modalSolicitacao');
    
    document.querySelectorAll('.btn-abrir-modal').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            abrirModal(id);
        });
    });

    if (modal) {
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                fecharModal();
            }
        });
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && modal && modal.style.display === 'flex') {
            fecharModal();
        }
    });
});
</script>
@endpush
@endsection


