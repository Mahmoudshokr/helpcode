@extends('layouts.admin')

@section('content')
    @include('includes.tinymce')
    <h1>Create post</h1>
   <div class="row">



    {!! Form::open(['align'=>'','method'=>'','action'=>'AdminPostController@store','files'=>true]) !!}
        {!! Form::token() !!}
        <div class="form-group">
            {!! Form::label('title','Title:'); !!}
        {!! Form::text('title',null,['class'=>'form-control','placeholder'=>'']) !!}

            {!! Form::label('category_id','Category:'); !!}
            {!! Form::select('category_id',[''=>'choose option']+ $categories,null,['class'=>'form-control','placeholder'=>'']) !!}<br>

            {!! Form::label('tag_id','Select tag:'); !!}<br>
            @foreach($tags as $tag)
            <label><input type="checkbox" name="tags[]" value="{{$tag->id}}"> {{$tag->name}}</label><br>

            @endforeach

            {!! Form::label('photo_id','Main photo:'); !!}
            {!! Form::file('photo_id',null,['class'=>'form-control','placeholder'=>'']) !!}<br>

            {!! Form::label('body','Description:') !!}
        {!! Form::textarea('body',null,['class'=>'form-control','placeholder'=>'','rows'=>6]) !!}<br>

        {!! Form::submit('Create post',['class'=>'btn btn-primary']) !!}
        </div>
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