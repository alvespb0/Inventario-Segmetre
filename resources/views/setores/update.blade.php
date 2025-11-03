@extends('layouts.base')

@section('title', 'Editar Setor | Inventário por Setores')

@section('content')
    <nav aria-label="breadcrumb" style="margin: .25rem 0 1rem;">
        <ol style="display:flex; gap:.35rem; align-items:center; list-style:none; padding:0; margin:0; color:#cfe8f0;">
            <li><a class="nav-link" href="{{ url('/setores') }}" style="padding:0;">Setores</a></li>
            <li style="opacity:.6;">/</li>
            <li>Editar</li>
        </ol>
    </nav>

    <section class="card" style="padding: 1.25rem; max-width: 720px;">
        <header style="margin-bottom: 1rem; display:flex; align-items:center; justify-content: space-between; gap:.75rem;">
            <div>
                <h1 style="margin:0; font-size: 1.25rem;">Editar setor {{$setor->nome}}</h1>
                <p style="margin:.25rem 0 0; color:#cfe8f0;">Informe os dados básicos do setor.</p>
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
        <form method="post" action="{{route('setores.update')}}" style="display:grid; gap: 1rem;">
            @csrf
            <input type="hidden" name="setor_id" value="{{$setor->id}}">
            <div style="display:grid; gap:.5rem;">
                <label for="nome" style="font-weight:600;">Nome do Setor</label>
                <input id="nome" name="nome" type="text" class="input" placeholder="Ex.: Financeiro" required style="width:100%;" value="{{$setor->nome}}" />
            </div>

            <div style="display:flex; gap:.5rem; justify-content:flex-end; margin-top:.5rem;">
                <button class="btn btn-primary" type="submit">Editar</button>
        </form>
        <form method="post" action="{{route('setores.delete')}}">
                @csrf
                <input type="hidden" name="setor_id" value="{{$setor->id}}">
                <button class="btn btn-danger">Excluir</button>
            </div>
        </form>
    </section>
@endsection


