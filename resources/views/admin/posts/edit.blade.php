@extends('layouts.admin')

@section('content')
    <h1>Edit post</h1>
    <div class="col-sm-3">
        <img height="150" src="http://localhost/helpcode/public/images/{{$posts->photo ? $posts->photo->path : 'default.jpg'}}" alt="">
    </div>
    <div class="col-sm-9">
    <div class="row">
    {!! Form::model($posts,['method'=>'PUT','action'=>['AdminPostController@update',$posts->id],'files'=>true]) !!}
           {!! Form::token() !!}

            {!! Form::label('title','Title:'); !!}
            {!! Form::text('title',null,['class'=>'form-control','placeholder'=>'']) !!}

            {!! Form::label('category_id','Category:'); !!}
            {!! Form::select('category_id',[''=>'choose option']+ $categories,null,['class'=>'form-control','placeholder'=>'']) !!}

            {!! Form::label('photo_id','Photo:'); !!}
            {!! Form::file('photo_id',null,['class'=>'form-control','placeholder'=>'']) !!}

            {!! Form::label('body','Description:') !!}
            {!! Form::textarea('body',null,['class'=>'form-control','placeholder'=>'','rows'=>6]) !!}<br>

            {!! Form::submit('Update post',['class'=>'btn btn-primary col-sm-3']) !!}
    {!! Form::close() !!}

    {!! Form::open(['method'=>'DELETE','action'=>['AdminPostController@destroy',$posts->id],'files'=>true]) !!}
        {!! Form::token() !!}
        {!! Form::submit('Delete post',['class'=>'btn btn-danger col-sm-3']) !!}
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
    </div>
@stop