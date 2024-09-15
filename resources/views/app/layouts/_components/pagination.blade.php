<div class="paginationContainer">
    <div style="padding-left: 50px">
        <p>Total de itens: {{$totalItems}}</p>
    </div>
    <div style="width: 180px; padding-right: 50px; color: white; font-size: 24px; display: flex; align-items:center; justify-content: space-between;">
        <button style="height: 35px; width: 60px" onclick="window.location.href='{{route($rota, ['pagina' => $paginaAtual - 1])}}'">Anterior</button>
        <span style="font-weight: bold">{{$paginaAtual}}</span>
        <button style="height: 35px; width: 60px" onclick="window.location.href='{{route($rota, ['pagina' => $paginaAtual + 1])}}'">Próxima</button>
    </div>
</div>