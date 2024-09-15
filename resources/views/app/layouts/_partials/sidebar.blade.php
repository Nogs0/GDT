<div class="sideBarContainer">
    <div style="display:flex; justify-content: center; align-items:center;">
        <img style="width: 300px; max-height: fit-content;" src="{{ asset('images/gdt.png') }}">
    </div>
    <div class="menu">
        <ul>
            <li>
                <a href="{{ route('app.clientes.getAll', ['pagina' => 1]) }}">
                    <div style="width: 100%; padding: 10px;">
                        Clientes
                    </div>
                </a>
            </li>
            <li>
                <a href="{{ route('app.treinos.getAll', ['pagina' => 1]) }}">
                    <div style="width: 100%; padding: 10px;">
                        Treinos
                    </div>
                </a>
            </li>
            <li>
                <a href="{{ route('app.exercicios.getAll', ['pagina' => 1]) }}">
                    <div style="width: 100%; padding: 10px;">
                        Exercícios
                    </div>
                </a>
            </li>
        </ul>
    </div>
</div>