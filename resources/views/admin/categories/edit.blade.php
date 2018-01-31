@extends('layouts.admin')

@section('content')
    <h1>Edit Categories</h1>
    <div class="row">
    {!! Form::model($categories,['method'=>'PUT','action'=>['AdminCategoriesController@update',$categories->id]]) !!}
    {!! Form::token() !!}
        {!! Form::label('name','Name:'); !!}
        {!! Form::text('name',null,['class'=>'form-control','placeholder'=>'']) !!}<br>

        {!! Form::submit('Update Category',['class'=>'btn btn-primary col-sm-3']) !!}
    {!! Form::close() !!}
        {!! Form::open(['method'=>'DELETE','action'=>['AdminCategoriesController@destroy',$categories->id]]) !!}
            {!! Form::token() !!}
            {!! Form::submit('Delete Category',['class'=>'btn btn-danger col-sm-3']) !!}
            {!! Form::close() !!}
    </div>

@stop