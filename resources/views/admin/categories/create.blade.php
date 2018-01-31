@extends('layouts.admin')

@section('content')
    <h1>Create Categories</h1>
    {!! Form::open(['method'=>'POST','action'=>'AdminCategoriesController@store']) !!}

        {!! Form::token() !!}
        <div class="form-group">
            {!! Form::label('name','Name:'); !!}
        {!! Form::text('name',null,['class'=>'form-control','required','placeholder'=>'']) !!}<br>

        {!! Form::submit('Create Category',['class'=>'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
@stop