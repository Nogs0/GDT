@extends('app.layouts.basico')
@section('conteudo')
<div style="width: 100%;">
    <h1>Clientes</h1>
    <div class="contentContainer">    
        <div class="tableContainer">
            <table>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Objetivo</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pagedResultDto->items as $index => $cliente)
                        <tr>
                            <td>{{ $cliente->nome }}</td>
                            <td>{{ $cliente->email }}</td>
                            <td>{{ $cliente->objetivo }}</td>
                            <td>
                                <ul style="list-style: none">
                                    <li>Editar</li>
                                    <li>Excluir</li>
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @component('app.layouts._components.pagination', ['rota'=> 'app.clientes.getAll', 'totalItems' => $pagedResultDto->totalItems, 'paginaAtual' => $pagedResultDto->paginaAtual])
            @endcomponent
        </div>
    </div>
    <div align="right" style="padding-top: 20px; padding-right: 5%;">
        <button onclick={{ route('app.clientes.create') }} class="buttonAddRegister">Novo registro</button>
    </div>
</div>
@endsection