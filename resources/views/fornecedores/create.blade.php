@extends('layouts.base')

@section('title', 'Fornecedores | Cadastro de Fornecedor')

@section('content')
    <nav aria-label="breadcrumb" style="margin: .25rem 0 1rem;">
        <ol style="display:flex; gap:.35rem; align-items:center; list-style:none; padding:0; margin:0; color:#cfe8f0;">
            <li><a class="nav-link" href="/fornecedores" style="padding:0;">Fornecedores</a></li>
            <li style="opacity:.6;">/</li>
            <li>Novo</li>
        </ol>
    </nav>

    <section class="card card-center" style="padding: 1.25rem; max-width: 720px; width: 100%;">
        <header style="margin-bottom: 1rem; display:flex; align-items:center; justify-content: space-between; gap:.75rem;">
            <div>
                <h1 style="margin:0; font-size: 1.25rem;">Cadastrar Fornecedor</h1>
                <p style="margin:.25rem 0 0; color:#cfe8f0;">Informe os dados básicos do Fornecedor.</p>
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
        <form method="post" action="{{route('fornecedores.create')}}" style="display:grid; gap: 1rem; text: align-center">
            @csrf

            <div style="display:grid; gap:.5rem;">
                <label for="nome" style="font-weight:600;">Nome do Fornecedor</label>
                <input id="nome" name="nome" type="text" class="input" placeholder="Ex.: Lojinha do tião" required style="width:100%;" />
            </div>
            <div style="display:grid; gap:.5rem;">
                <label for="cnpj" style="font-weight:600;">CNPJ do Fornecedor <small style="font-size:smaller; color:#555;"><span style="color:red;">*</span>Sem pontos e traços</small></label>
                <input id="cnpj" name="cnpj" type="text" class="input" placeholder="Ex.: 06080215000146" required style="width:100%;" />
            </div>
            <div style="display:grid; gap:.5rem;">
                <label for="cliente_segmetre" style="font-weight:600;">É cliente Segmetre?</label>
                <div style="display: inline-flex; align-items: center; gap: 6px;">
                    <input type="radio" name="cliente_segmetre" id="cliente_segmetre" value="1">
                    <label for="cliente_segmetre" style="font-weight: 600; margin: 0;">Sim</label>
                         <input type="radio" name="cliente_segmetre" id="cliente_segmetre" value="0">
                    <label for="cliente_segmetre" style="font-weight: 600; margin: 0;">Não</label>
                </div>
            </div>
            <div style="display:flex; gap:.5rem; justify-content:flex-end; margin-top:.5rem;">
                <a href="/fornecedores" class="btn btn-ghost" type="button">Cancelar</a>
                <button class="btn btn-primary" type="submit">Salvar</button>
            </div>
        </form>
    </section>
@endsection


