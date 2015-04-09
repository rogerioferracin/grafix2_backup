@extends('templates.master')

@section('content')
    {!! Form::open(array('url'=>'usuarios/novo', 'class'=>'form-horizontal')) !!}
    <div class="panel-group" id="accordion">
        {{--PANEL DADOS ------------------------------------------------------- --}}
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="#dados" data-toggle="collapse" data-parent="#accordion">
                    <span class="panel-title">Dados de acesso</span>
                </a>
            </div>
            <div class="panel-collapse collapse in" id="dados">
                <div class="panel-body">
                    <div class="form-group">
                        {!! Form::label('username', 'Usuário*', array('class'=>'col-md-2 control-label')) !!}
                        <div class="col-md-4">
                            {!! Form::text('username', null, array('class'=>'form-control')) !!}
                            @if($errors->has('username')) <span class="text-danger small"> {!! $errors->first('username') !!} </span> @endif
                        </div>

                        {!! Form::label('email', 'Email*', array('class'=>'col-md-2 control-label')) !!}
                        <div class="col-md-4">
                            {!! Form::text('email', null, array('class'=>'form-control')) !!}
                            @if($errors->has('email')) <span class="text-danger small"> {!! $errors->first('email') !!} </span> @endif
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('password', 'Senha*', array('class'=>'col-md-2 control-label')) !!}
                        <div class="col-md-4">
                            {!! Form::password('password', array('class'=>'form-control')) !!}
                            @if($errors->has('password')) <span class="text-danger small"> {!! $errors->first('password') !!} </span> @endif
                        </div>

                        {!! Form::label('password_confirmation', 'Confirma senha*', array('class'=>'col-md-2 control-label')) !!}
                        <div class="col-md-4">
                            {!! Form::password('password_confirmation', array('class'=>'form-control')) !!}
                            @if($errors->has('password_confirmation')) <span class="text-danger small"> {!! $errors->first('password_confirmation') !!} </span> @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--PANEL CONTATO ------------------------------------------------------- --}}
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="#contato" data-toggle="collapse" data-parent="#accordion">
                    <span class="panel-title">Contato</span>
                </a>
            </div>
            <div class="panel-collapse collapse" id="contato">
                <div class="panel-body">
                    <div class="form-group">
                        {!! Form::label('nome', 'Nome*', array('class'=>'col-md-2 control-label')) !!}
                        <div class="col-md-4">
                            {!! Form::text('nome', null, array('class'=>'form-control')) !!}
                            @if($errors->has('nome')) <span class="text-danger small"> {!! $errors->first('nome') !!} </span> @endif
                        </div>
                        {!! Form::label('sobrenome', 'Sobrenome', array('class'=>'col-md-2 control-label')) !!}
                        <div class="col-md-4">
                            {!! Form::text('sobrenome', null, array('class'=>'form-control')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('cargo', 'Cargo', array('class'=>'col-md-2 control-label')) !!}
                        <div class="col-md-4">
                            {!! Form::text('cargo', null, array('class'=>'form-control')) !!}
                        </div>
                        {!! Form::label('setor', 'Setor', array('class'=>'col-md-2 control-label')) !!}
                        <div class="col-md-4">
                            {!! Form::text('setor', null, array('class'=>'form-control')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('telefone', 'Telefone*', array('class'=>'col-md-2 control-label')) !!}
                        <div class="col-md-4">
                            {!! Form::text('telefone', null, array('class'=>'form-control')) !!}
                            @if($errors->has('telefone')) <span class="text-danger small"> {!! $errors->first('telefone') !!} </span> @endif
                        </div>
                        {!! Form::label('celular', 'Celular', array('class'=>'col-md-2 control-label')) !!}
                        <div class="col-md-4">
                            {!! Form::text('celular', null, array('class'=>'form-control')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('skype', 'Skype', array('class'=>'col-md-2 control-label')) !!}
                        <div class="col-md-4">
                            {!! Form::text('skype', null, array('class'=>'form-control')) !!}
                        </div>
                        {!! Form::label('aniversario', 'Aniversário', array('class'=>'col-md-2 control-label')) !!}
                        <div class="col-md-4">
                            {!! Form::text('aniversario', null, array('class'=>'form-control')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('observacoes', 'Observações', array('class'=>'col-md-2 control-label')) !!}
                        <div class="col-md-10">
                            {!! Form::textarea('observacoes', null, array('class'=>'form-control', 'rows'=>'3')) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--PANEL ENDERECO ------------------------------------------------------- --}}
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="#endereco" data-toggle="collapse" data-parent="#accordion">
                    <span class="panel-title">Endereço</span> <span class="badge-errors"></span>
                </a>
            </div>
            <div class="panel-collapse collapse" id="endereco">
                <div class="panel-body">
                    <div class="form-group">
                        <div class="col-md-12 clearfix text-right">
                            <button class="btn btn-default btn-sm" id="btn-busca-endereco" type="button"><i class="fa fa-search"></i> Busca endereço</button>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('logradouro', 'Logradouro*', array('class'=>'col-md-2 control-label')) !!}
                        <div class="col-md-6">
                            {!! Form::text('logradouro', null, array('class'=>'form-control')) !!}
                            @if($errors->has('logradouro')) <span class="text-danger small"> {!! $errors->first('logradouro') !!} </span> @endif
                        </div>
                        {!! Form::label('numero', 'Número', array('class'=>'col-md-2 control-label')) !!}
                        <div class="col-md-2">
                            {!! Form::text('numero', null, array('class'=>'form-control')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('complemento', 'Complemento*', array('class'=>'col-md-2 control-label')) !!}
                        <div class="col-md-4">
                            {!! Form::text('complemento', null, array('class'=>'form-control')) !!}
                        </div>
                        {!! Form::label('bairro', 'Bairro', array('class'=>'col-md-2 control-label')) !!}
                        <div class="col-md-4">
                            {!! Form::text('bairro', null, array('class'=>'form-control')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('cidade', 'Cidade', array('class'=>'col-md-2 control-label')) !!}
                        <div class="col-md-4">
                            {!! Form::text('cidade', null, array('class'=>'form-control')) !!}
                        </div>
                        {!! Form::label('uf', 'UF', array('class'=>'col-md-2 control-label')) !!}
                        <div class="col-md-2">
                            {!! Form::text('uf', null, array('class'=>'form-control')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('cep', 'CEP', array('class'=>'col-md-2 control-label')) !!}
                        <div class="col-md-2">
                            {!! Form::text('cep', null, array('class'=>'form-control')) !!}
                        </div>
                        {!! Form::label('referencia', 'Referência', array('class'=>'col-md-2 control-label')) !!}
                        <div class="col-md-6">
                            {!! Form::text('referencia', null, array('class'=>'form-control')) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>{{--END PANEL GROUP--}}


    {{--BUTTON--}}
    <div class="col-md-12 clearfix">
        {!! Form::submit('Cadastrar', array('class'=>'btn btn-primary pull-right submit-confirm')) !!}
    </div>

    <div class="modal fade">

    </div>

    {!! Form::close() !!}
@stop


@section('sidebar')
    @include('usuarios.sidebar')
@stop

@section('scripts')
    <script>
        $(document).ready(function(){
            var panels = $('.panel-group').find('.panel-body');
            $(panels).each(function(){
                var errors = $(this).find('.text-danger');
                if(errors.length > 0) {
                    $(errors).closest('.panel-body').parent().siblings().append('<span class="badge">' + errors.length + '</div>');
//                    $(errors).parent().siblings().find('.badge-errors').append('<span class="badge"> sss' + errors.length + '</div>');
                }
            });
        })
    </script>
@stop