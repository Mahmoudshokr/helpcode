@extends('layouts.admin')

@section('content')
    @if(count($comments) > 0)
        <h1>Comments</h1>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">body</th>
                <th scope="col">post title</th>
                <th scope="col">user</th>
                <th scope="col">email</th>
            </tr>
            </thead>

            @foreach($comments as $comment)
                <tbody>
                <tr>
                    <th scope="row">{{$comment->id}}</th>
                    <td>{{$comment->body}}</td>
                    <td>{{$comment->post->title}}</td>
                    <td>{{$comment->user}}</td>
                    <td>{{$comment->email}}</td>
                    <td><a href="{{route('admincommentreplies.show',$comment->id)}}">view replies</a></td>
                    <td><a href="{{route('blog.post',$comment->post->id)}}">view post</a></td>
                    <td>
                        {!! Form::open(['method'=>'DELETE','action'=>['PostCommentsController@destroy',$comment->id]]) !!}
                        {!! Form::token() !!}
                        {!! Form::submit('Delete',['class'=>'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    </td>
                    <td>
                        @if($comment->active == 1)
                            {!! Form::model($comment,['method'=>'PUT','action'=>['PostCommentsController@update',$comment->id]]) !!}
                            {!! Form::token() !!}
                            <input type="hidden" name="active" value="0">
                            {!! Form::submit('Dis-Approve',['class'=>'btn btn-info']) !!}
                            {!! Form::close() !!}
                        @else
                            {!! Form::model($comment,['method'=>'PUT','action'=>['PostCommentsController@update',$comment->id]]) !!}
                            {!! Form::token() !!}
                            <input type="hidden" name="active" value="1">
                            {!! Form::submit('Approve',['class'=>'btn btn-success']) !!}
                            {!! Form::close() !!}
                        @endif

                    </td>
                </tr>
            </tbody>
        @endforeach
        </table>
    @else
        <h1 class="text-center">No comments</h1>
    @endif

@stop