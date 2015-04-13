@extends('templates.master')

@section('content')
    <table class="table table-responsive">
        <tbody>
            {{--TABELA DADOS DE ACESSO--}}
            <tr>
                <th class="h3">Dados de acesso</th>
            </tr>
            <tr>
                <td>
                    <table class="table table-bordered tabela-ficha-dados">
                        <thead>
                            <tr>
                                <th>Nome completo:</th>
                                <td colspan="3"><span class="h4">{!! $user->contato->nome !!} {!! $user->contato->sobrenome !!}</span></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>Nome de usuário:</th>
                                <td>{!! $user->username !!}</td>
                                <th>Email:</th>
                                <td>{!! $user->email !!}</td>
                            </tr>
                            <tr>
                                <th>Grupo:</th>
                                <td>{!! $user->grupo !!}</td>
                                <th>Dica da senha:</th>
                                <td>{!! $user->dica_senha !!}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            {{--TABELA CONTATO--}}
            <tr>
                <th class="h3">Contato</th>
            </tr>
            <tr>
                <td>
                    <table class="table table-bordered tabela-ficha-dados">
                        <tbody>
                            <tr>
                                <th>Cargo:</th>
                                <td>{!! $user->contato->cargo !!}</td>
                                <th>Setor:</th>
                                <td>{!! $user->contato->setor !!}</td>
                            </tr>
                            <tr>
                                <th>Telefone:</th>
                                <td>{!! $user->contato->telefone !!}</td>
                                <th>Celular:</th>
                                <td>{!! $user->contato->celular !!}</td>
                            </tr>
                            <tr>
                                <th>Email:</th>
                                <td>{!! $user->contato->email !!}</td>
                                <th>Skype:</th>
                                <td>{!! $user->contato->skype !!}</td>
                            </tr>
                            <tr>
                                <th>Observações:</th>
                                <td colspan="3">{!! $user->contato->observacoes !!}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            {{--TABELA ENDERECO--}}
            <tr>
                <th class="h3">Endereço</th>
            </tr>
            <tr>
                <td>
                    <table class="table table-bordered tabela-ficha-dados">
                        <tbody>
                        <tr>
                            <th>Logradouro:</th>
                            <td>
                                {!! $user->endereco->logradouro !!},
                                {!! $user->endereco->numero !!} {!! ($user->endereco->complemento) ? ' - ' .$user->endereco->logradouro : '' !!}
                            </td>
                            <th>Bairro:</th> <td>{!! $user->endereco->bairro !!}</td>
                        </tr>
                        <tr>
                            <th>Cidade:</th>
                            <td>{!! $user->endereco->cidade !!}</td>
                            <th>UF:</th>
                            <td>{!! $user->endereco->uf !!}</td>
                        </tr>
                        <tr>
                            <th>Cep:</th>
                            <td>{!! $user->endereco->cep !!}</td>
                            <th>Referência:</th>
                            <td>{!! $user->endereco->referencia !!}</td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>



@stop

@section('sidebar')
    @include('usuarios.sidebar')

    <ul class="nav nav-pills nav-stacked">
        <li class="active"><a href="#" class="tab-link  tab-link-title" id="overview"><span class="h4">Usuário</span></a></li>
        <li>
            <a href="#" class="tab-link" id="btn-troca-senha">
                <i class="fa fa-lock"></i> Troca senha
            </a>
        </li>
    </ul>
@stop

@section('scripts')
    <script>
        $(document).ready(function(){
            $('#btn-troca-senha').click(function(e){
                MakeTrocaSenhaModal({!! $user->id !!});
            })
        });
    </script>
@stop