@extends('layouts.base')

@section('title', 'Itens | Edição de Item')

@section('content')
    <nav aria-label="breadcrumb" style="margin: .25rem 0 1rem;">
        <ol style="display:flex; gap:.35rem; align-items:center; list-style:none; padding:0; margin:0; color:#cfe8f0;">
            <li><a class="nav-link" href="/itens" style="padding:0;">Itens</a></li>
            <li style="opacity:.6;">/</li>
            <li>Novo</li>
        </ol>
    </nav>

    <section class="card card-center" style="padding: 1.25rem; max-width: 720px; width: 100%;">
        <header style="margin-bottom: 1rem; display:flex; align-items:center; justify-content: space-between; gap:.75rem;">
            <div>
                <h1 style="margin:0; font-size: 1.25rem;">Editar Item</h1>
                <p style="margin:.25rem 0 0; color:#cfe8f0;">Informe os dados básicos do Item.</p>
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
        <form method="post" action="{{route('itens.update', $item->id)}}" style="display:grid; gap: 1rem; text: align-center">
            @csrf

            <div style="display:grid; gap:.5rem;">
                <label for="nome" style="font-weight:600;">Nome do Item</label>
                <input id="nome" name="nome" type="text" class="input" placeholder="Ex.: Caneta" required style="width:100%;" value="{{$item->nome}}"/>
            </div>
            <div style="display:grid; gap:.5rem;">
                <label for="" style="font-weight:600;">Descrição</label>
                <input id="descricao" name="descricao" type="text" class="input" placeholder="Ex.: Caneta Esfereográfica de cor azul ciano" required style="width:100%;" value="{{$item->descricao}}"/>
            </div>
            <div style="display:flex; gap:.5rem; justify-content:flex-end; margin-top:.5rem;">
                <a href="/itens/excluir/{{$item->id}}" class="btn btn-ghost" type="button" onclick="return confirm('Tem certeza que deseja excluir esse item?')">Excluir</a>
                <a href="/itens" class="btn btn-ghost" type="button">Cancelar</a>
                <button class="btn btn-primary" type="submit">Salvar</button>
            </div>
        </form>
    </section>
@endsection


