@extends('admin.layout')

@section('content')

<div id="login-form" class="container">
    {{ Form::open(array('url' => '/admin/login', 'method' => 'post', 'class' => 'form-horizontal')) }}
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Username</label>
            <div class="col-sm-10">
                {{ Form::text('username', '', array('class' => 'form-control', 'id' => 'username', 'placeholder' => 'Username')); }}
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
            <div class="col-sm-10">
                {{ Form::password('password', array('class' => 'form-control', 'id' => 'password', 'placeholder' => 'password')); }}
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                {{ Form::submit('Sign in', array('class' => 'btn btn-primary')); }}
            </div>
        </div>
    {{ Form::close() }}
</div>

@stop