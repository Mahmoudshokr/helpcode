@extends('layouts.admin')

@section('content')
    @if(count($replies) > 0)
        <h1>Comments</h1>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">body</th>
                <th scope="col">user</th>
                <th scope="col">email</th>
            </tr>
            </thead>

            @foreach($replies as $reply)
                <tbody>
                <tr>
                    <th scope="row">{{$reply->id}}</th>
                    <td>{{$reply->body}}</td>
                    <td>{{$reply->user}}</td>
                    <td>{{$reply->email}}</td>
                    <td><a href="{{route('blog.post',$reply->comment->post->id)}}">view post</a></td>
                    <td>
                        {!! Form::open(['method'=>'DELETE','action'=>['CommentRepliesController@destroy',$reply->id]]) !!}
                        {!! Form::token() !!}
                        {!! Form::submit('Delete',['class'=>'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    </td>
                    <td>
                        @if($reply->active == 1)
                            {!! Form::model($reply,['method'=>'PUT','action'=>['CommentRepliesController@update',$reply->id]]) !!}
                            {!! Form::token() !!}
                            <input type="hidden" name="active" value="0">
                            {!! Form::submit('Dis-Approve',['class'=>'btn btn-info']) !!}
                            {!! Form::close() !!}
                        @else
                            {!! Form::model($reply,['method'=>'PUT','action'=>['CommentepliesController@update',$reply->id]]) !!}
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