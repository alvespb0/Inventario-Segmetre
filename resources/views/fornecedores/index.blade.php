@extends('layouts.base')

@section('title', 'Fornecedores | Listagem de Fornecedores')

@section('content')
    <section style="display:flex; justify-content: space-between; align-items: center; gap: 1rem; margin: .5rem 0 1rem;">
        <div>
            <h1 style="margin:0; font-size: 1.25rem;">Fornecedores</h1>
            <p style="margin:.25rem 0 0; color:#cfe8f0;">Lista de Fornecedores cadastrados.</p>
        </div>
        <div>
            <a href="/fornecedores/novo" class="btn btn-primary">Novo Fornecedor</a>
        </div>
    </section>

    <section class="card" style="padding: 1rem;">
        <form action="{{route('fornecedores.filter')}}" method="GET">
            <div style="display:flex; justify-content: space-between; align-items: center; gap:.75rem; margin-bottom: .75rem;">
                <input type="search" class="input" name="busca" placeholder="Buscar Item..." style="width:100%;" />
                <div style="display:flex; gap:.5rem;">
                    <button class="btn btn-ghost" type="submit">Filtrar</button>
                </div>
            </div>
        </form>

        <div style="display:grid; grid-template-columns: repeat(auto-fill, minmax(240px, 1fr)); gap: 1rem;">
            @forelse($fornecedores as $fornecedor)
                <article class="card" style="padding: 1rem;">
                    <div style="display:flex; justify-content: space-between; align-items: center; gap:.5rem;">
                        <div>
                            <div style="font-weight:700;">{{ $fornecedor->nome }}</div>
                            <div style="font-weight:700;">{{ $fornecedor->cnpj }}</div>

                        </div>
                    </div>

                    <div style="display:flex; gap:.5rem; margin-top: .75rem;">
                        <a href="#" class="btn btn-ghost">Abrir</a>
                        <a href="/fornecedores/editar/{{$fornecedor->id}}" class="btn btn-ghost">Editar</a>
                    </div>
                </article>
            @empty
                <div class="card" style="padding:1rem; text-align:center;">Nenhum fornecedor encontrado.</div>
            @endforelse
        </div>
    </section>
@endsection


