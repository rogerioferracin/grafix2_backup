<div class="panel list-group nav-sidebar">
    <a href="#" class="list-group-item">
        <i class="fa fa-home"></i> <span>Home</span>
    </a>
    <!--MENU FINANCEIRO-->
    <a href="#" class="list-group-item" data-toggle="collapse" data-target="#financeiro" data-parent="#sidemenu">
        <i class="fa fa-dollar"></i> <span>Financeiro</span> <i class="fa fa-caret-down pull-right"></i>
    </a>
    <div id="financeiro" class="collapse submenu">
        <a href="#" class="list-group-item" data-toggle="collapse" data-target="#duplicatas" data-parent="#financeiro">
            <i class="fa fa-money"></i>
            Duplicatas
        </a>
        <div class="collapse submenu" id="duplicatas">
            <a href="#" class="list-group-item">Lista todos</a>
            <a href="#" class="list-group-item">Novo</a>
        </div>
    </div>
    <!--MENU CADASTROS-->
    <a href="#" class="list-group-item" data-toggle="collapse" data-target="#cadastros" data-parent="#sidemenu">
        <i class="fa fa-bars"></i> <span>Cadastros</span> <i class="fa fa-caret-down pull-right"></i>
    </a>
    <div id="cadastros" class="collapse submenu">
        <div class="panel list-group">
            {{--Clientes--}}
            <a href="#" class="list-group-item" data-toggle="collapse" data-target="#clientes" data-parent="#cadastros">
                <i class="fa fa-suitcase"></i>
                Clientes
            </a>
            <div class="collapse submenu" id="clientes">
                <a href="#" class="list-group-item">Lista todos</a>
                <a href="#" class="list-group-item">Novo</a>
            </div>
            {{--Usuarios--}}
            <a class="list-group-item" data-toggle="collapse" data-target="#usuarios" data-parent="#cadastros">
                <i class="fa fa-users"></i>
                Usuários
            </a>
            <div class="collapse" id="usuarios">
                <a href="{{ URL::to('usuarios') }}" class="list-group-item">Lista todos</a>
                <a href="{{ URL::to('usuarios/novo') }}" class="list-group-item">Novo</a>
            </div>
        </div>
    </div>
</div>