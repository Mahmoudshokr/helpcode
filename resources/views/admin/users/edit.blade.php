@extends('layouts.admin')
@section('content')
    <h1>Edit user page</h1>

    <div class="row">

        <div class="col-sm-3">

            <img src="http://localhost/helpcode/public/images/{{$user->photo ? $user->photo->path:'default.jpg'}}"
                 class="img-rounded img-responsive" >

        </div>

        <div class="col-sm-9">
        {!! Form::model($user,['method'=>'PUT','action'=>['AdminUserController@update',$user->id],'files'=>true]) !!}

        {!! Form::token() !!}

            {!! Form::label('name','name:'); !!}
            {!! Form::text('name',null,['class'=>'form-control','placeholder'=>'']) !!}<br>

            {!! Form::label('email','Email:'); !!}
            {!! Form::email('email',null,['class'=>'form-control','placeholder'=>'']) !!}<br>

            {!! Form::label('password','password:') !!}<br>
            {!! Form::password('password',null,['class'=>'form-control','placeholder'=>'']) !!}<br>

            {!! Form::label('photo','photo:') !!}<br>
            {!! Form::file('photo_id',null,['class'=>'form-control','placeholder'=>'']) !!}<br>

            {!! Form::label('active','Status:'); !!}
            {!! Form::select('active', array(1 =>'Active', 0 =>'not Active'),null,['class'=>'form-control','placeholder'=>'']) !!}<br>

            {!! Form::label('role_id','Role:') !!}
            {!! Form::select('role_id',['choose options']+ $roles ,null,['class'=>'form-control','placeholder'=>'']) !!}<br>

            {!! Form::submit('Edit user',['class'=>'btn btn-primary col-sm-3']) !!}

        {!! Form::close() !!}

        {!! Form::open(['align'=>'center','method'=>'DELETE','action'=>['AdminUserController@destroy',$user->id]]) !!}
            {!! Form::token() !!}
            {!! Form::submit('Delete user',['class'=>'btn btn-danger col-sm-3']) !!}
            {!! Form::close() !!}

    </div>

    <div class="row">
        @if(count($errors)>0)
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <ul>
                        <li>{{$error}}</li>
                    </ul>
                @endforeach
            </div>
        @endif
    </div>


@stop