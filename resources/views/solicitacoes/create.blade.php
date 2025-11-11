@extends('layouts.base')

@section('title', 'Solicitações | Lançar Solicitação de Item')

@section('content')
    <nav aria-label="breadcrumb" style="margin: .25rem 0 1rem;">
        <ol style="display:flex; gap:.35rem; align-items:center; list-style:none; padding:0; margin:0; color:#cfe8f0;">
            <li><a class="nav-link" href="/" style="padding:0;">Item</a></li>
            <li style="opacity:.6;">/</li>
            <li>Solicitar Item ao Setor</li>
        </ol>
    </nav>

    <section class="card card-center" style="padding: 1.25rem; max-width: 720px; width: 100%;">
        <header style="margin-bottom: 1rem; display:flex; align-items:center; justify-content: space-between; gap:.75rem;">
            <div>
                <h1 style="margin:0; font-size: 1.25rem;">Solicitar Item ao Setor</h1>
                <p style="margin:.25rem 0 0; color:#cfe8f0;">Informe o item e a quantidade.</p>
            </div>
        </header>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="post" action="{{route('solicitacoes.create')}}" style="display:grid; gap: 1rem; text: align-center">
            @csrf

            <div style="display:grid; gap:.5rem;">
                <label for="item" style="font-weight:600;">Item</label>
                <select name="item_id" id="item" required style="width:100%;">
                    @foreach($itens as $item)
                        <option value="{{$item->id}}">{{$item->nome}}</option>
                    @endforeach
                </select>
            </div>

            <div style="display:grid; gap:.5rem;">
                <label for="setor" style="font-weight:600;">Setor</label>
                @if(auth()->user()->is_administrator)
                    <select name="setor_id" id="setor" required style="width:100%;">
                        @foreach($setores as $setor)
                            <option value="{{$setor->id}}">{{$setor->nome}}</option>
                        @endforeach
                    </select>
                @else
                    <input type="hidden" name="setor_id" value="{{auth()->user()->setor_id}}">
                    <select name="setor_id" id="setor" required style="width:100%;" disabled>
                        @foreach($setores as $setor)
                            <option value="">{{auth()->user()->setor->nome}}</option>
                        @endforeach
                    </select>
                @endif
            </div>

            <div style="display:grid; gap:.5rem;">
                <label for="qtd" style="font-weight:600;">Quantidade</label>
                <input id="qtd" name="qtd" type="number" min=0 class="input" placeholder="Ex.: 5" required style="width:100%;" />
            </div>

            <div style="display:grid; gap:.5rem;">
                <label for="data_solicitacao" style="font-weight:600;">Data de Solicitação</label>
                <input id="data_solicitacao" name="data_solicitacao" type="date" class="input" required style="width:100%;" />
            </div>

            <div style="display:grid; gap:.5rem;">
                <label for="observacao" style="font-weight:600;">Observações</label>
                <input id="observacao" name="observacao" type="text" min=0 class="input" placeholder="Ex.: Caixa de 50 cm" style="width:100%;" />
            </div>

            <div style="display:flex; gap:.5rem; justify-content:flex-end; margin-top:.5rem;">
                <a href="/" class="btn btn-ghost" type="button">Cancelar</a>
                <button class="btn btn-primary" type="submit">Salvar</button>
            </div>
        </form>
    </section>
@endsection


