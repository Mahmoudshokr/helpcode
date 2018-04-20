@extends('layouts.admin')

@section('content')

    <div class="col-sm-6">
        <h1>Create Tags</h1>
        {!! Form::open(['method'=>'POST','action'=>'TagController@store']) !!}

        {!! Form::token() !!}
        <div class="form-group">
            {!! Form::label('name','Name:'); !!}
            {!! Form::text('name',null,['class'=>'form-control','required','placeholder'=>'']) !!}<br>

            {!! Form::submit('Create Tag',['class'=>'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    </div>
    <div class="col-sm-6">
        <h1>Tags</h1>
        @if(count($tags)>0)
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">name</th>
                <th scope="col">created</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @if($tags)
                @foreach($tags as $tag)
                    <tr>
                        <th scope="row">{{$tag->id}}</th>
                        <td>{{$tag->name}}</td>
                        <td>{{$tag->created_at ? $tag->created_at->diffForHumans() : 'unknown'}}</td>
                        <td>
                            {!! Form::model($tag,['align'=>'','method'=>'DELETE','action'=>['TagController@destroy',$tag->id]]) !!}
                                {!! Form::token() !!}
                                {!! Form::submit('X',['class'=>'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
         @else
            <div><h3>No tags yet.</h3></div>
         @endif
    </div>
@stop