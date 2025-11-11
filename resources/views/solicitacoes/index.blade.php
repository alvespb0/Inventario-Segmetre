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
                    <tr style="border-bottom:1px solid rgba(254,252,251,.05);">
                        <td style="padding:.75rem 1rem; text-align:left;">{{ $solicitacao->id }}</td>
                        <td style="padding:.75rem 1rem; text-align:left;">{{ $solicitacao->item->nome }}</td>
                        <td style="padding:.75rem 1rem; text-align:center;">{{ $solicitacao->setor->nome ?? '-' }}</td>
                        <td style="padding:.75rem 1rem; text-align:center;">
                            <span class="status-badge status-{{ strtolower($solicitacao->status) }}">{{ $solicitacao->status }}</span>
                        </td>
                        <td style="padding:.75rem 1rem; text-align:center;">{{ $solicitacao->quantidade }}</td>
                        <td style="padding:.75rem 1rem; text-align:right;">
                            <button type="button" class="btn btn-ghost" style="padding:.4rem .8rem;" onclick="abrirModal({{ $solicitacao->id }})">Abrir</button>
                            <button type="button" class="btn btn-ghost" style="padding:.4rem .8rem;"><a href="" style="text-decoration:none;color:white">Editar</a></button>
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

@foreach($solicitacoes as $solicitacao)
<!-- Modal de Detalhes da Solicitação {{ $solicitacao->id }} -->
<div id="modalSolicitacao{{ $solicitacao->id }}" class="modal-overlay" style="display:none;">
    <div class="modal-content">
        <div class="modal-header">
            <h2 style="margin:0; font-size: 1.25rem;">Detalhes da Solicitação</h2>
            <button type="button" class="modal-close" onclick="fecharModal({{ $solicitacao->id }})" aria-label="Fechar">&times;</button>
        </div>
        <div class="modal-body">
            <div style="display:grid; gap:1rem;">
                <div style="display:grid; gap:.5rem;">
                    <label style="font-weight:600; color:#cfe8f0;">ID da Solicitação</label>
                    <div style="color:#fefcfb;">{{ $solicitacao->id }}</div>
                </div>
                <div style="display:grid; gap:.5rem;">
                    <label style="font-weight:600; color:#cfe8f0;">Item</label>
                    <div style="color:#fefcfb;">{{ $solicitacao->item->nome }}</div>
                </div>
                <div style="display:grid; gap:.5rem;">
                    <label style="font-weight:600; color:#cfe8f0;">Descrição do Item</label>
                    <div style="color:#fefcfb;">{{ $solicitacao->item->descricao ?? 'Sem descrição' }}</div>
                </div>
                <div style="display:grid; gap:.5rem;">
                    <label style="font-weight:600; color:#cfe8f0;">Setor</label>
                    <div style="color:#fefcfb;">{{ $solicitacao->setor->nome ?? '-' }}</div>
                </div>
                <div style="display:grid; gap:.5rem;">
                    <label style="font-weight:600; color:#cfe8f0;">Quantidade</label>
                    <div style="color:#fefcfb;">{{ $solicitacao->quantidade }}</div>
                </div>
                <div style="display:grid; gap:.5rem;">
                    <label style="font-weight:600; color:#cfe8f0;">Status</label>
                    <div style="color:#fefcfb;">
                        <span class="status-badge status-{{ strtolower($solicitacao->status) }}">{{ $solicitacao->status }}</span>
                    </div>
                </div>
                <div style="display:grid; gap:.5rem;">
                    <label style="font-weight:600; color:#cfe8f0;">Sugestão de Fornecedor</label>
                    <div style="color:#fefcfb;">Fornecedor: {{ $solicitacao->item->getFornecedorMaisBaratoAttribute() }} | Valor: R${{ $solicitacao->item->getMenorValorUnitarioAttribute() }}</div>
                    <div style="color:#fefcfb;">Fornecedor Parceiro: {{ $solicitacao->item->getParceiroMaisBaratoAttribute() }} | Valor: R${{ $solicitacao->item->getMenorValorParceiroAttribute() }}</div>
                </div>
                <div style="display:grid; gap:.5rem;">
                    <label style="font-weight:600; color:#cfe8f0;">Data da Solicitação</label>
                    <div style="color:#fefcfb;">
                        @if($solicitacao->data_solicitacao)
                            {{ date('d/m/Y H:i', strtotime($solicitacao->data_solicitacao)) }}
                        @else
                            -
                        @endif
                    </div>
                </div>
                <div style="display:grid; gap:.5rem;">
                    <label style="font-weight:600; color:#cfe8f0;">Observação</label>
                    <div style="color:#fefcfb; min-height:60px; padding:.75rem; background:rgba(10,17,40,.3); border-radius:.5rem; border:1px solid rgba(254,252,251,.1);">{{ $solicitacao->observacao ?? 'Sem observações' }}</div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-ghost" onclick="fecharModal({{ $solicitacao->id }})">Fechar</button>
        </div>
    </div>
</div>
@endforeach

@push('styles')
<style>
.status-badge {
    display: inline-block;
    padding: 0.25rem 0.75rem;
    border-radius: 0.5rem;
    font-size: 0.875rem;
    font-weight: 500;
    text-transform: uppercase;
}

.status-pendente {
    background: rgba(255, 193, 7, 0.2);
    color: #ffc107;
    border: 1px solid rgba(255, 193, 7, 0.3);
}

.status-aprovado, .status-aprovada {
    background: rgba(40, 167, 69, 0.2);
    color: #28a745;
    border: 1px solid rgba(40, 167, 69, 0.3);
}

.status-rejeitado, .status-rejeitada {
    background: rgba(220, 53, 69, 0.2);
    color: #dc3545;
    border: 1px solid rgba(220, 53, 69, 0.3);
}

.status-em-andamento {
    background: rgba(18, 130, 162, 0.2);
    color: #1282A2;
    border: 1px solid rgba(18, 130, 162, 0.3);
}

/* Modal Styles */
.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.7);
    backdrop-filter: blur(4px);
    z-index: 1000;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 1rem;
}

.modal-content {
    background: rgba(0, 31, 84, 0.95);
    border: 1px solid rgba(254, 252, 251, 0.15);
    border-radius: 1rem;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5);
    max-width: 600px;
    width: 100%;
    max-height: 90vh;
    overflow-y: auto;
    display: flex;
    flex-direction: column;
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.25rem;
    border-bottom: 1px solid rgba(254, 252, 251, 0.1);
}

.modal-close {
    background: transparent;
    border: none;
    color: #fefcfb;
    font-size: 1.5rem;
    cursor: pointer;
    padding: 0;
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 0.5rem;
    transition: background 0.2s;
}

.modal-close:hover {
    background: rgba(254, 252, 251, 0.1);
}

.modal-body {
    padding: 1.25rem;
    flex: 1;
    overflow-y: auto;
}

.modal-footer {
    padding: 1rem 1.25rem;
    border-top: 1px solid rgba(254, 252, 251, 0.1);
    display: flex;
    justify-content: flex-end;
    gap: 0.5rem;
}
</style>
@endpush

@push('body-end')
<script>
function abrirModal(id) {
    const modal = document.getElementById('modalSolicitacao' + id);
    if (modal) {
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
}

function fecharModal(id) {
    const modal = document.getElementById('modalSolicitacao' + id);
    if (modal) {
        modal.style.display = 'none';
        document.body.style.overflow = 'auto';
    }
}

document.addEventListener('DOMContentLoaded', function() {
    // Fechar modal ao clicar no overlay
    document.querySelectorAll('.modal-overlay').forEach(modal => {
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                const id = modal.id.replace('modalSolicitacao', '');
                fecharModal(id);
            }
        });
    });

    // Fechar com ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            document.querySelectorAll('.modal-overlay').forEach(modal => {
                if (modal.style.display === 'flex') {
                    const id = modal.id.replace('modalSolicitacao', '');
                    fecharModal(id);
                }
            });
        }
    });
});
</script>
@endpush
@endsection


