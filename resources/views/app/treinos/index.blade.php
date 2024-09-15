@extends('app.layouts.basico')
@section('conteudo')
<div style="width: 100%;">
    <h1>Treinos</h1>
    <div class="tableContainer">
        <table>
            <thead>
                <tr>
                    <th>Grupamento muscular</th>
                    <th>Foco</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pagedResultDto->items as $index => $treino)
                    @if ($index < 5)
                        <tr>
                            <td>{{ $treino->grupamento_muscular }}</td>
                            <td>{{ $treino->foco }}</td>
                            <td>
                                <ul style="list-style: none">
                                    <li>Editar</li>
                                    <li>Excluir</li>
                                </ul>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
        @component('app.layouts._components.pagination', ['rota'=> 'app.treinos.getAll', 'totalItems' => $pagedResultDto->totalItems, 'paginaAtual' => $pagedResultDto->paginaAtual])
        @endcomponent
    </div>
    <div align="right" style="padding-top: 20px; padding-right: 5%;">
        <button class="buttonAddRegister">Novo registro</button>
    </div>
</div>
@endsection