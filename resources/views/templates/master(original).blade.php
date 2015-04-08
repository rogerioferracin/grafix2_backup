
<!DOCTYPE html>
<html lang="pt_br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ URL::asset('img/favicon.ico') }}">

    <title>Dashboard Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ URL::asset('plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">

    <!--Plugins css-->
    <!--<link href="plugins/datatables/jquery.dataTables.min.css" rel="stylesheet">-->
    <link href="{{ URL::asset('plugins/datatables/dataTables.bootstrap.css') }}" rel="stylesheet">


    <!-- Custom styles for this template -->
    <link href="{{ URL::asset('css/dashboard.css') }}" rel="stylesheet">

    <link href='http://fonts.googleapis.com/css?family=Muli:300,400,300italic,400italic' rel='stylesheet' type='text/css'>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<!-- NAVBAR -------------------------------------------------------------------------------------------------------- -->
<nav class="navbar">
    <div class="container-fluid">
        <div class="row">
            <div id="logo" class="col-xs-12 col-md-2">
                <a href="#"><img src="img/grafix-logo-50.png"> Grafix <sup>v0.0.2</sup></a>
            </div>
            <div id="top-panel" class="col-xs-12 col-md-10">
                <div class="row">
                    <div class="col-xs-4 col-sm-8 top-panel-right pull-right">
                        <ul class="nav navbar-nav pull-right panel-menu">
                            <li>
                                <a href="#">
                                    <i class="fa fa-envelope"></i>
                                    <span class="badge">7</span>
                                </a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle account" data-toggle="dropdown">
                                    <div class="avatar">
                                        <img src="img/grafix-logo-50.png" class="img-circle">
                                    </div>
                                    <i class="fa fa-angle-down pull-right"></i>
                                    <div class="user-mini pull-right">
                                        <span class="welcome">Bem vindo,</span>
                                        <span>Administrador</span>
                                    </div>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">
                                            <i class="fa fa-power-off"></i> <span>Logout</span></a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<div class="container-fluid" id="content">
    <div class="row">
        <!-- SIDEBAR ----------------------------------------------------------------------------------------------- -->
        <div class="col-sm-3 col-md-2 sidebar">
            <div id="sidemenu">
                <div class="panel list-group nav-sidebar">
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
                            <a href="#" class="list-group-item" data-toggle="collapse" data-target="#clientes" data-parent="#cadastros">
                                <i class="fa fa-suitcase"></i>
                                Clientes
                            </a>
                            <div class="collapse submenu" id="clientes">
                                <a href="#" class="list-group-item">Lista todos</a>
                                <a href="#" class="list-group-item">Novo</a>
                            </div>
                            <a class="list-group-item" data-toggle="collapse" data-target="#usuarios" data-parent="#cadastros">
                                <i class="fa fa-users"></i>
                                Usuários
                            </a>
                            <div class="collapse" id="usuarios">
                                <a href="#" class="list-group-item">Lista todos</a>
                                <a href="#" class="list-group-item">Novo</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- BREADCRUMB -------------------------------------------------------------------------------------------- -->
        <div class="col-lg-10 col-md-offset-2">
            <div id="breadcrumb" class="row">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Clientes</a></li>
                    <li><a href="#">Novo</a></li>
                </ol>
            </div>
        </div>


        <!-- DASHBOARD --------------------------------------------------------------------------------------------- -->
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h1 class="page-header">Cliente</h1>

            <div class="row" id="info-panel">
                <div class="col-md-12">
                    <span class="sub-header">Novo cadastro</span>
                </div>
            </div>
            <div class="row">
                <div id="dashboard_links" class="col-md-2 pull-right">
                    <ul class="nav nav-pills nav-stacked">
                        <li class="active"><a href="#" class="tab-link  tab-link-title" id="overview"><span class="h4">Opções</span></a></li>
                        <li><a href="#" class="tab-link" id="clients">Lista todos</a></li>
                        <li><a href="#" class="tab-link" id="graph">Novo cliente</a></li>
                    </ul>
                </div>

                <div id="dashboard_tabs" class="col-md-10">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <table class="table table-bordered" id="tabela">
                                <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Sobrenome</th>
                                    <th>Email</th>
                                    <th>Telefone</th>
                                    <th><i class="fa fa-wrench"></i> </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Rogerio</td>
                                    <td>Ferracin</td>
                                    <td>rogerioferracin@gmail.com</td>
                                    <td>(12) 98854-2458</td>
                                    <td>
                                        <a href="#"><i class="fa fa-edit"></i></a>
                                        <a href="#"><i class="fa fa-tasks"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Rogerio</td>
                                    <td>Ferracin</td>
                                    <td>rogerioferracin@gmail.com</td>
                                    <td>(12) 98854-2458</td>
                                    <td>
                                        <a href="#"><i class="fa fa-edit"></i></a>
                                        <a href="#"><i class="fa fa-tasks"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Rogerio</td>
                                    <td>Ferracin</td>
                                    <td>rogerioferracin@gmail.com</td>
                                    <td>(12) 98854-2458</td>
                                    <td>
                                        <a href="#"><i class="fa fa-edit"></i></a>
                                        <a href="#"><i class="fa fa-tasks"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Rogerio</td>
                                    <td>Ferracin</td>
                                    <td>rogerioferracin@gmail.com</td>
                                    <td>(12) 98854-2458</td>
                                    <td>
                                        <a href="#"><i class="fa fa-edit"></i></a>
                                        <a href="#"><i class="fa fa-tasks"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Rogerio</td>
                                    <td>Ferracin</td>
                                    <td>rogerioferracin@gmail.com</td>
                                    <td>(12) 98854-2458</td>
                                    <td>
                                        <a href="#"><i class="fa fa-edit"></i></a>
                                        <a href="#"><i class="fa fa-tasks"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Rogerio</td>
                                    <td>Ferracin</td>
                                    <td>rogerioferracin@gmail.com</td>
                                    <td>(12) 98854-2458</td>
                                    <td>
                                        <a href="#"><i class="fa fa-edit"></i></a>
                                        <a href="#"><i class="fa fa-tasks"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Rogerio</td>
                                    <td>Ferracin</td>
                                    <td>rogerioferracin@gmail.com</td>
                                    <td>(12) 98854-2458</td>
                                    <td>
                                        <a href="#"><i class="fa fa-edit"></i></a>
                                        <a href="#"><i class="fa fa-tasks"></i></a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <span class="panel-title">Form de cadastro</span>
                        </div>
                        <div class="panel-body">
                            <form action="#" class="form-horizontal">
                                <div class="form-group">
                                    <label class="control-label col-md-2">Nome:</label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control">
                                    </div>
                                    <label class="control-label col-md-2">Sobrenome:</label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Telefone:</label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control">
                                    </div>
                                    <label class="control-label col-md-2">Email:</label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Emissão:</label>
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            <input type="text" class="form-control">
                                            <div class="input-group-btn">
                                                <button class="btn btn-default" type="button">
                                                    <i class="fa fa-calendar"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <label class="control-label col-md-2">Vencimento:</label>
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            <input type="text" class="form-control">
                                            <div class="input-group-btn">
                                                <button class="btn btn-default" type="button">
                                                    <i class="fa fa-calendar"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="panel-footer clearfix">
                            <button type="button" class="btn btn-primary pull-right">Cadastrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END DASHBOARD -->
    </div>
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="{{ URL::asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ URL::asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>

<!--Load js for page-->
<script src="{{ URL::asset('js/dashboard.js') }}"></script>

<script>
    $(document).ready(function(){
        MakeDataTable('#tabela', {
            aLengthMenu : [[5,10,-1], [5,10, 'Todos']]
        });
    })
</script>

</body>
</html>
