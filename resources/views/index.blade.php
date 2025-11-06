@extends('layouts.base')

@section('title', 'Início | Inventário por Setores')

@section('content')
    <section class="hero card" style="padding: 2rem; margin-bottom: 1.25rem;">
        <div style="display:flex; flex-wrap: wrap; gap: 1.25rem; align-items: center; justify-content: space-between;">
            <div style="min-width: 260px; flex: 1 1 420px;">
                <h1 style="margin: 0 0 .5rem; font-size: 1.75rem;">Inventário por Setores</h1>
                <p style="margin: 0; color: #cfe8f0; max-width: 60ch;">
                    Registre, organize e acompanhe os itens de cada setor da sua organização.
                    Comece criando um novo registro ou acessando um setor existente abaixo.
                </p>
                <div style="display:flex; gap:.5rem; margin-top: 1rem;">
                    <a href="#" class="btn btn-primary">Novo Registro</a>
                    <a href="#setores" class="btn btn-ghost">Ver Setores</a>
                </div>
            </div>
            <div style="flex: 1 1 280px; min-width: 260px;">
                <div class="card" style="padding:1rem;">
                    <div style="display:grid; grid-template-columns: repeat(3, 1fr); gap:.75rem;">
                        <div style="background: rgba(10,17,40,.45); border:1px solid rgba(254,252,251,.08); border-radius:.75rem; padding: .9rem; text-align:center;">
                            <div style="font-size: .8rem; color:#cfe8f0;">Setores</div>
                            <div style="font-size: 1.25rem; font-weight:700;">—</div>
                        </div>
                        <div style="background: rgba(10,17,40,.45); border:1px solid rgba(254,252,251,.08); border-radius:.75rem; padding: .9rem; text-align:center;">
                            <div style="font-size: .8rem; color:#cfe8f0;">Itens</div>
                            <div style="font-size: 1.25rem; font-weight:700;">—</div>
                        </div>
                        <div style="background: rgba(10,17,40,.45); border:1px solid rgba(254,252,251,.08); border-radius:.75rem; padding: .9rem; text-align:center;">
                            <div style="font-size: .8rem; color:#cfe8f0;">Pendências</div>
                            <div style="font-size: 1.25rem; font-weight:700;">—</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="setores">
        <div style="display:flex; justify-content: space-between; align-items: center; gap: 1rem; margin: .5rem 0 1rem;">
            <h2 style="margin:0; font-size: 1.15rem;">Setores</h2>
            <div>
                <button class="btn btn-ghost" type="button">Gerenciar Setores</button>
            </div>
        </div>

        <div style="display:grid; grid-template-columns: repeat(auto-fill, minmax(240px, 1fr)); gap: 1rem;">
            @forelse($setores as $setor)
                <a href="#" class="card" style="padding: 1rem; display:block; transition: transform .15s ease, box-shadow .15s ease;">
                    <div style="display:flex; justify-content: space-between; align-items: center; gap:.5rem;">
                        <div>
                            <div style="font-weight: 700;">{{ $setor->nome }}</div>
                            <div style="font-size:.9rem; color:#cfe8f0;"> itens</div>
                        </div>
                        <span style="display:inline-flex; width: 34px; height: 34px; border-radius: .6rem; background: var(--c-accent);"></span>
                    </div>
                </a>
                @empty
                <h3>teste</h3>
            @endforelse
        </div>
    </section>
@endsection




