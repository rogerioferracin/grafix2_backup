@extends('templates.master')

@section('content')
    <table class="table table-striped" id="tabela-usuarios">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Username</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Grupo</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>ferracin</td>
                <td>ferracin@email.com</td>
                <td>(12) 98854-2458</td>
                <td>Usuario</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@stop

@section('sidebar')
    @include('usuarios.sidebar')
@stop

@section('scripts')
    <script>
        $(document).ready(function(){
            MakeDataTable('#tabela-usuarios');
        });
    </script>
@stop