@extends('app.layouts.basico')
@section('conteudo')
<div style="width: 100%;">
    <h1>Exercícios</h1>
    <div class="tableContainer">
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Usa aparelho</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pagedResultDto->items as $index => $exercicio)
                    @if ($index < 5)
                        <tr>
                            <td>{{ $exercicio->nome }}</td>
                            <td>{{ $exercicio->is_aparelho ? 'sim' : 'não' }}</td>
                            <td>
                                <ul style="list-style: none;">
                                    <li>Editar</li>
                                    <li>Excluir</li>
                                </ul>
                            </td>
                        </tr>
                    @endif        
                @endforeach
            </tbody>
        </table>
        @component('app.layouts._components.pagination', ['rota'=> 'app.exercicios.getAll', 'totalItems' => $pagedResultDto->totalItems, 'paginaAtual' => $pagedResultDto->paginaAtual])
        @endcomponent
    </div>
    <div align="right" style="padding-top: 20px; padding-right: 5%;">
        <button onclick={{ route('app.clientes.create') }} class="buttonAddRegister">Novo registro</button>
    </div>
</div>
@endsection