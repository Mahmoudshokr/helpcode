@extends('layouts.admin')
@section('content')
    <h1>Create user page</h1>
    {!! Form::open(['method'=>'POST','action'=>'AdminUserController@store','files'=>true]) !!}

        {!! Form::token() !!}
        <div class="form-group">
            {!! Form::label('name','name:'); !!}
        {!! Form::text('name',null,['class'=>'form-control','placeholder'=>'']) !!}<br>

            {!! Form::label('email','Email:'); !!}
            {!! Form::email('email',null,['class'=>'form-control','placeholder'=>'']) !!}<br>

            {!! Form::label('password','password:') !!}<br>
        {!! Form::password('password',null,['class'=>'form-control','placeholder'=>'']) !!}<br>

            {!! Form::label('photo','photo:') !!}<br>
            {!! Form::file('photo_id',null,['class'=>'form-control','placeholder'=>'']) !!}<br>

            {!! Form::label('active','Status:'); !!}
        {!! Form::select('active', array(1 =>'Active', 0 =>'not Active'),0,['class'=>'form-control','placeholder'=>'']) !!}<br>

            {!! Form::label('role_id','Role:') !!}
        {!! Form::select('role_id',['choose options']+ $roles ,null,['class'=>'form-control','placeholder'=>'']) !!}<br>

        {!! Form::submit('Create user',['class'=>'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}

     @if(count($errors)>0)
             <div class="alert alert-danger">
                 @foreach($errors->all() as $error)
                     <ul>
                         <li>{{$error}}</li>
                     </ul>
                 @endforeach
             </div>
         @endif


@stop