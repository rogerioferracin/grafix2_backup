@extends('templates.master')

@section('content')
    {!! Form::model($user, array('url'=>['usuarios/atualiza', 'id'=>$user->id], 'class'=>'form-horizontal', 'method'=>'put')) !!}
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
                            {!! Form::text('username', $user->username, array('class'=>'form-control')) !!}
                            @if($errors->has('username')) <span class="text-danger small"> {!! $errors->first('username') !!} </span> @endif
                        </div>

                        {!! Form::label('email', 'Email*', array('class'=>'col-md-2 control-label')) !!}
                        <div class="col-md-4">
                            {!! Form::text('email', $user->email, array('class'=>'form-control')) !!}
                            @if($errors->has('email')) <span class="text-danger small"> {!! $errors->first('email') !!} </span> @endif
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('grupo', 'Grupo*', array('class'=>'col-md-2 control-label')) !!}
                        <div class="col-md-4">
                            {!! Form::select('grupo', $grupos ,$user->grupo, array('class'=>'form-control')) !!}
                            @if($errors->has('grupo')) <span class="text-danger small"> {!! $errors->first('grupo') !!} </span> @endif
                        </div>
                        {!! Form::label('dica_senha', 'Dica da senha', array('class'=>'col-md-2 control-label')) !!}
                        <div class="col-md-4">
                            {!! Form::text('dica_senha', $user->dica_senha, array('class'=>'form-control')) !!}
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
                            {!! Form::text('nome', $user->contato->nome, array('class'=>'form-control')) !!}
                            @if($errors->has('nome')) <span class="text-danger small"> {!! $errors->first('nome') !!} </span> @endif
                        </div>
                        {!! Form::label('sobrenome', 'Sobrenome', array('class'=>'col-md-2 control-label')) !!}
                        <div class="col-md-4">
                            {!! Form::text('sobrenome', $user->contato->sobrenome, array('class'=>'form-control')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('cargo', 'Cargo', array('class'=>'col-md-2 control-label')) !!}
                        <div class="col-md-4">
                            {!! Form::text('cargo', $user->contato->cargo, array('class'=>'form-control')) !!}
                        </div>
                        {!! Form::label('setor', 'Setor', array('class'=>'col-md-2 control-label')) !!}
                        <div class="col-md-4">
                            {!! Form::text('setor', $user->contato->setor, array('class'=>'form-control')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('telefone', 'Telefone*', array('class'=>'col-md-2 control-label')) !!}
                        <div class="col-md-4">
                            {!! Form::text('telefone', $user->contato->telefone, array('class'=>'form-control')) !!}
                            @if($errors->has('telefone')) <span class="text-danger small"> {!! $errors->first('telefone') !!} </span> @endif
                        </div>
                        {!! Form::label('celular', 'Celular', array('class'=>'col-md-2 control-label')) !!}
                        <div class="col-md-4">
                            {!! Form::text('celular', $user->contato->celular, array('class'=>'form-control')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('skype', 'Skype', array('class'=>'col-md-2 control-label')) !!}
                        <div class="col-md-4">
                            {!! Form::text('skype', $user->contato->skype, array('class'=>'form-control')) !!}
                        </div>
                        {!! Form::label('aniversario', 'Aniversário', array('class'=>'col-md-2 control-label')) !!}
                        <div class="col-md-4">
                            {!! Form::text('aniversario', $user->contato->aniversario, array('class'=>'form-control')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('observacoes', 'Observações', array('class'=>'col-md-2 control-label')) !!}
                        <div class="col-md-10">
                            {!! Form::textarea('observacoes', $user->contato->observacoes, array('class'=>'form-control', 'rows'=>'3')) !!}
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
                            {!! Form::text('logradouro', $user->endereco->logradouro, array('class'=>'form-control')) !!}
                            @if($errors->has('logradouro')) <span class="text-danger small"> {!! $errors->first('logradouro') !!} </span> @endif
                        </div>
                        {!! Form::label('numero', 'Número', array('class'=>'col-md-2 control-label')) !!}
                        <div class="col-md-2">
                            {!! Form::text('numero', $user->endereco->numero, array('class'=>'form-control')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('complemento', 'Complemento*', array('class'=>'col-md-2 control-label')) !!}
                        <div class="col-md-4">
                            {!! Form::text('complemento', $user->endereco->complemento, array('class'=>'form-control')) !!}
                        </div>
                        {!! Form::label('bairro', 'Bairro', array('class'=>'col-md-2 control-label')) !!}
                        <div class="col-md-4">
                            {!! Form::text('bairro', $user->endereco->bairro, array('class'=>'form-control')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('cidade', 'Cidade', array('class'=>'col-md-2 control-label')) !!}
                        <div class="col-md-4">
                            {!! Form::text('cidade', $user->endereco->cidade, array('class'=>'form-control')) !!}
                        </div>
                        {!! Form::label('uf', 'UF', array('class'=>'col-md-2 control-label')) !!}
                        <div class="col-md-2">
                            {!! Form::text('uf', $user->endereco->uf, array('class'=>'form-control')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('cep', 'CEP', array('class'=>'col-md-2 control-label')) !!}
                        <div class="col-md-2">
                            {!! Form::text('cep', $user->endereco->cep, array('class'=>'form-control')) !!}
                        </div>
                        {!! Form::label('referencia', 'Referência', array('class'=>'col-md-2 control-label')) !!}
                        <div class="col-md-6">
                            {!! Form::text('referencia', $user->endereco->referencia, array('class'=>'form-control')) !!}
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