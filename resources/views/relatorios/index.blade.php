@extends('layouts.base')

@section('content')
<main>
  <div class="container">
    <div class="card card-center" style="padding:2rem;">
      <h2 style="margin-bottom:1.5rem;">📊 Gerar Relatórios</h2>

      <form id="formRelatorios" method="GET" action="{{route('relatorio.gerar')}}" class="grid gap-md">
        
        {{-- Tipo de Relatório --}}
        <div>
          <label for="tipoRelatorio" class="form-label">Tipo de Relatório</label>
          <select id="tipoRelatorio" name="tipoRelatorio">
            <option value="">Selecione...</option>
            <option value="solicitacao">Relatório de Solicitação</option>
            <option value="itens_fornecedores">Relatório de Itens e Fornecedores</option>
            <option value="estoque">Relatório de Estoque</option>
          </select>
        </div>

        {{-- Relatório de Solicitação --}}
        <div id="camposSolicitacao" class="parametros-relatorio" style="display:none;">
          <hr style="opacity:.15;margin:1rem 0;">
          <h3 style="margin-bottom:.5rem;">Filtros — Solicitação</h3>

          <div class="grid grid-auto">
            <div>
              <label for="setorSolicitacao">Setor</label>
              <select id="setorSolicitacao" name="setorSolicitacao">
                <option value="">Todos</option>

                @foreach($setores as $setor)
                  <option value="{{$setor->id}}">{{$setor->nome}}</option>
                @endforeach
              </select>
            </div>

            <div>
              <label>Data Inicial</label>
              <input type="date" name="dataInicialSolicitacao">
            </div>

            <div>
              <label>Data Final</label>
              <input type="date" name="dataFinalSolicitacao">
            </div>

            <div>
              <label for="statusSolicitacao">Status</label>
              <select id="statusSolicitacao" name="statusSolicitacao">
                <option value="">Todos</option>
                  @foreach (\App\Models\SolicitacaoItem::getStatuses() as $key => $label)
                      <option value="{{ $key }}">
                          {{ $label }}
                      </option>
                  @endforeach
              </select>
            </div>
          </div>
        </div>

        {{-- Relatório de Itens e Fornecedores --}}
        <div id="camposItensFornecedores" class="parametros-relatorio" style="display:none;">
          <hr style="opacity:.15;margin:1rem 0;">
          <h3 style="margin-bottom:.5rem;">Filtros — Itens e Fornecedores</h3>

          <div class="grid grid-auto">
            <div>
              <label for="nomeItem">Nome do Item</label>
              <input type="text" id="nomeItem" name="nomeItem" placeholder="Ex: Papel A4">
            </div>

            <div>
              <label for="fornecedor">Fornecedor</label>
              <select id="fornecedor" name="fornecedor">
                <option value="">Todos</option>
                @forelse($fornecedores as $fornecedor)
                  <option value="{{$fornecedor->id}}">{{$fornecedor->nome}}</option>
                @empty
                @endforelse 
              </select>
            </div>
          </div>
        </div>

        {{-- Relatório de Estoque --}}
        <div id="camposEstoque" class="parametros-relatorio" style="display:none;">
          <hr style="opacity:.15;margin:1rem 0;">
          <h3 style="margin-bottom:.5rem;">Filtros — Estoque</h3>

          <div class="grid grid-auto">
            <div>
              <label for="setorEstoque">Setor</label>
              <select id="setorEstoque" name="setorEstoque">
                <option value="">Todos</option>
                @foreach($setores as $setor)
                  <option value="{{$setor->id}}">{{$setor->nome}}</option>
                @endforeach
              </select>
            </div>

            <div>
              <label for="limiteTolerancia">Limite de Tolerância</label>
              <input type="number" id="limiteTolerancia" name="limiteTolerancia" placeholder="Ex: 10">
            </div>

            <div>
              <label for="nomeItemEstoque">Nome do Item</label>
              <input type="text" id="nomeItemEstoque" name="nomeItemEstoque" placeholder="Ex: Toner HP">
            </div>
          </div>
        </div>

        {{-- Botão --}}
        <div style="margin-top:1rem;">
          <button type="submit" class="btn btn-primary">Gerar Relatório</button>
        </div>
      </form>
    </div>
  </div>
</main>

<script>
  const selectTipo = document.getElementById('tipoRelatorio');
  const grupos = {
    solicitacao: document.getElementById('camposSolicitacao'),
    itens_fornecedores: document.getElementById('camposItensFornecedores'),
    estoque: document.getElementById('camposEstoque')
  };

  selectTipo.addEventListener('change', () => {
    Object.values(grupos).forEach(div => div.style.display = 'none');
    const selecionado = grupos[selectTipo.value];
    if (selecionado) selecionado.style.display = 'block';
  });
</script>
@endsection
