@extends('layouts.admin')

@section('content')
  <div class="bg-info">
    <p>{{session('Deletecategory_id')}}</p>
  </div>
  <div class="col-sm-6">
    <h1>Create Categories</h1>
    {!! Form::open(['method'=>'POST','action'=>'AdminCategoriesController@store']) !!}

    {!! Form::token() !!}
    <div class="form-group">
      {!! Form::label('name','Name:'); !!}
      {!! Form::text('name',null,['class'=>'form-control','required','placeholder'=>'']) !!}<br>

      {!! Form::submit('Create Category',['class'=>'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}
  </div>
  <div class="col-sm-6">
    <h1>Categories</h1>
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">id</th>
          <th scope="col">name</th>
          <th scope="col">created</th>
          <th scope="col">updated</th>
        </tr>
      </thead>
      <tbody>
      @if($categories)
        @foreach($categories as $category)
        <tr>
          <th scope="row">{{$category->id}}</th>
          <td><a href="{{route('admincategories.edit',$category->id)}}">{{$category->name}}</a></td>
          <td>{{$category->created_at ? $category->created_at->diffForHumans() : 'unknown'}}</td>
          <td>{{$category->updated_at ? $category->updated_at->diffForHumans() : 'unknown'}}</td>
        </tr>
        @endforeach
      @endif
      </tbody>
    </table>
  </div>
@stop