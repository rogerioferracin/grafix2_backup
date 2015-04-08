@extends('templates.master')

@section('content')
    {!! Form::open(array('url'=>'usuarios/novo', 'class'=>'form-horizontal')) !!}
    <div class="form-group">
        {!! Form::label('username', 'Usuário', array('class'=>'col-md-2 control-label')) !!}
        <div class="col-md-4">
            {!! Form::text('username', null, array('class'=>'form-control')) !!}
            @if($errors->has('username')) <span class="text-danger small"> {!! $errors->first('username') !!} </span> @endif
        </div>

        {!! Form::label('email', 'Email', array('class'=>'col-md-2 control-label')) !!}
        <div class="col-md-4">
            {!! Form::text('email', null, array('class'=>'form-control')) !!}
            @if($errors->has('email')) <span class="text-danger small"> {!! $errors->first('email') !!} </span> @endif
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('password', 'Senha', array('class'=>'col-md-2 control-label')) !!}
        <div class="col-md-4">
            {!! Form::text('password', null, array('class'=>'form-control')) !!}
            @if($errors->has('password')) <span class="text-danger small"> {!! $errors->first('password') !!} </span> @endif
        </div>

        {!! Form::label('password_confirmation', 'Confirma senha', array('class'=>'col-md-2 control-label')) !!}
        <div class="col-md-4">
            {!! Form::text('password_confirmation', null, array('class'=>'form-control')) !!}
            @if($errors->has('password_confirmation')) <span class="text-danger small"> {!! $errors->first('password_confirmation') !!} </span> @endif
        </div>
    </div>
    {{--BUTTON--}}
    <div class="col-md-12 clearfix">
        {!! Form::submit('Cadastrar', array('class'=>'btn btn-primary pull-right')) !!}
    </div>

    {!! Form::close() !!}
@stop


@section('sidebar')
    @include('usuarios.sidebar')
@stop