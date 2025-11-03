@extends('layouts.base')

@section('title', 'Usuários | Cadastro de Usuário')

@section('content')
    <nav aria-label="breadcrumb" style="margin: .25rem 0 1rem;">
        <ol style="display:flex; gap:.35rem; align-items:center; list-style:none; padding:0; margin:0; color:#cfe8f0;">
            <li><a class="nav-link" href="/usuarios" style="padding:0;">Usuários</a></li>
            <li style="opacity:.6;">/</li>
            <li>Novo</li>
        </ol>
    </nav>

    <section class="card card-center" style="padding: 1.25rem; max-width: 720px; width: 100%;">
        <header style="margin-bottom: 1rem; display:flex; align-items:center; justify-content: space-between; gap:.75rem;">
            <div>
                <h1 style="margin:0; font-size: 1.25rem;">Cadastrar Usuario</h1>
                <p style="margin:.25rem 0 0; color:#cfe8f0;">Informe os dados básicos do Usuário.</p>
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
        <form method="post" action="{{route('usuarios.create')}}" style="display:grid; gap: 1rem; text: align-center">
            @csrf

            <div style="display:grid; gap:.5rem;">
                <label for="nome" style="font-weight:600;">Nome do Usuário</label>
                <input id="nome" name="nome" type="text" class="input" placeholder="Ex.: João da Silva Sauro" required style="width:100%;" />
            </div>
            <div style="display:grid; gap:.5rem;">
                <label for="login" style="font-weight:600;">Login do Usuário</label>
                <input id="login" name="login" type="text" class="input" placeholder="Ex.: Joao.Silva" required style="width:100%;" />
            </div>
            <div style="display:grid; gap:.5rem;">
                <label for="email" style="font-weight:600;">Email do Usuário</label>
                <input id="email" name="email" type="text" class="input" placeholder="Ex.: joao@example.com.br" required style="width:100%;" />
            </div>
            <div style="display:grid; gap:.5rem;">
                <label for="senha" style="font-weight:600;">Senha do Usuário</label>
                <input id="senha" name="senha" type="password" class="input" placeholder="Ex.: J0ao@2532" required style="width:100%;" />
            </div>
            <div style="display:grid; gap:.5rem;">
                <label for="setor" style="font-weight:600;">Setor do Usuário</label>
                <select name="setor_id" id="setor" required style="width:100%;">
                    @foreach($setores as $setor)
                        <option value="{{$setor->id}}">{{$setor->nome}}</option>
                    @endforeach
                </select>
            </div>
            <div style="display:grid; gap:.5rem;">
                <label for="senha" style="font-weight:600;">Permissão do Usuário</label>
                <div style="display: inline-flex; align-items: center; gap: 6px;">
                    <input type="radio" name="is_administrator" id="administrator" value="1">
                    <label for="administrator" style="font-weight: 600; margin: 0;">Administrador</label>
                         <input type="radio" name="is_administrator" id="administrator" value="0">
                    <label for="administrator" style="font-weight: 600; margin: 0;">Comum</label>
                </div>
            </div>
            <div style="display:flex; gap:.5rem; justify-content:flex-end; margin-top:.5rem;">
                <a href="/usuarios" class="btn btn-ghost" type="button">Cancelar</a>
                <button class="btn btn-primary" type="submit">Salvar</button>
            </div>
        </form>
    </section>
@endsection


