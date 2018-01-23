@extends('layouts.admin')




@section('content')

@if(Session::has('deleteflash_id'))
    <p class="bg-info">{{session('deleteflash_id')}}</p>
@endif

    <h1>Users</h1>
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">id</th>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Role</th>
          <th scope="col">Active</th>
          <th scope="col">created</th>
          <th scope="col">updated</th>
          <th scope="col">photo</th>
          <th scope="col">photo size</th>
        </tr>
      </thead>
      @if($users)
        @foreach($users as $user)
      <tbody>
        <tr>
          <th scope="row">{{$user->id}}</th>
          <td><a href="{{route('adminuser.edit',$user->id)}}">{{$user->name}}</a></td>
          <td>{{$user->email}}</td>
          <td>{{$user->role->name}}</td>
          <td>{{$user->active == 1 ? 'Active':'Not active'}}</td>
          <td>{{$user->created_at->diffForHumans()}}</td>
          <td>{{$user->updated_at->diffForHumans()}}</td>
          <td><img height="50" width="50" src="images/{{$user->photo ? $user->photo->path:'default.jpg'}}" class="img-rounded img-responsive" alt=""></td>
          <td>{{$user->photo ? $user->photo->size.' KB':' 0 KB'}}</td>
        </tr>
      </tbody>
        @endforeach
        @endif
    </table>
@stop


@section('footer')

@stop