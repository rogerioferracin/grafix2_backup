@extends('templates.master')

@section('content')
    {!! Form::model($model, array('url'=>['clientes/atualiza', 'id'=>$model->id], 'class'=>'form-horizontal', 'method'=>'put')) !!}
    <div class="panel-group" id="accordion">
        {{--PANEL DADOS ------------------------------------------------------- --}}
        <div class="panel panel-info">
            <div class="panel-heading">
                <a href="#dados" data-toggle="collapse" data-parent="#accordion">
                    <span class="panel-title">Dados do cliente</span>
                </a>
            </div>
            <div class="panel-collapse collapse in" id="dados">
                <div class="panel-body">
                    @include('clientes.dados_cliente_form')
                </div>
            </div>
        </div>
        {{--PANEL CONTATO ------------------------------------------------------- --}}
        <div class="panel panel-info">
            <div class="panel-heading">
                <a href="#contato" data-toggle="collapse" data-parent="#accordion">
                    <span class="panel-title">Contato</span>
                </a>
            </div>
            <div class="panel-collapse collapse" id="contato">
                <div class="panel-body">
                    @include('templates.partials.contato_update_form')
                </div>
            </div>
        </div>
        {{--PANEL ENDERECO ------------------------------------------------------- --}}
        <div class="panel panel-info">
            <div class="panel-heading">
                <a href="#endereco" data-toggle="collapse" data-parent="#accordion">
                    <span class="panel-title">Endereco</span>
                </a>
            </div>
            <div class="panel-collapse collapse" id="endereco">
                <div class="panel-body">
                    @include('templates.partials.endereco_update_form')
                </div>
            </div>
        </div>
    {{--END PANEL GROUP--}}
    </div>
    {{--BUTTON--}}
    <div class="col-md-12 clearfix">
        {!! Form::submit('Atualizar', array('class'=>'btn btn-primary pull-right submit-confirm')) !!}
    </div>
    {!! Form::close() !!}
@stop

@section('sidebar')
    @include('clientes.sidebar')
@stop

@section('scripts')
    <script>
        $(document).ready(function(){
            $('input[name="cnpj_cpf"]').on('blur', function(){
                MakeMaskedCnpjCpf($(this));
            })
        })
    </script>
@stop