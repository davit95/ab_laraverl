@extends('admin.auth.layout')

@section('content')
    <div class="col-md-4 col-md-offset-4">
        <div class="login-panel panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Please Sign In</h3>
            </div>
            <div class="panel-body">
                @include('alerts.messages')

                {!! Form::open([ 'url' => url('login') , 'method' => 'POST' , 'class' => 'form' ]) !!}

                    <div class="form-group">
                        {!! Form::email('email', null ,[ 'class' => 'form-control', 'placeholder' => 'E-mail' ]) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) !!}
                    </div>

                    <div class="checkbox">
                        <label>
                            {!! Form::checkbox('remember') !!} Remember Me
                        </label>
                    </div>

                    <div class="form-group">
                        {!! Form::submit('Login',['class' => 'btn btn-lg btn-success btn-block' ]) !!}
                    </div>
                    
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop