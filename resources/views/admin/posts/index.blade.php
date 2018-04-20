@extends('layouts.admin')

@section('content')
    <p class="bg-info">{{session('deletepost_id')}}</p>
    <h1>Index post </h1>



    <table class="table table-striped">
      <thead>
        <tr>

          <th scope="col">id</th>
            <th scope="col">user</th>
          <th scope="col">user's email</th>
          <th scope="col">category</th>
            <th scope="col">title</th>
          <th scope="col">photo</th>

          <th scope="col">body</th>
            <th scope="col">created_at</th>
            <th scope="col">updated_at</th>

        </tr>
      </thead>
      <tbody>
      @if($posts)
       @foreach($posts as $post)
        <tr>

          <td>{{$post->id}}</td>
            <td>{{$post->user->name}}</td>
          <td>{{$post->user->email}}</td>
          <td>{{$post->category ? $post->category->name : 'no category decided yet'}}</td>
            <td><a href="{{route('adminpost.edit',$post->id)}}">{{$post->title}}</a></td>
          <td><img height="50" src="images/{{$post->photo ? $post->photo->path : 'default.jpg'}}" alt=""></td>

          <td>{{$post->body}}</td>
            <td>{{$post->created_at->diffForHumans()}}</td>
            <td>{{$post->updated_at->diffForHumans()}}</td>
            <td><a href="{{route('blog.post',$post->id)}}">view post</a></td>
            <td><a href="{{route('admincomments.show',$post->id)}}">view comments</a></td>
        </tr>
       @endforeach
        @endif
    </table>


    <div class="row">
        <div class="col-sm-6 col-sm-offset-5">
            {{$posts->render()}}
        </div>
    </div>


@stop