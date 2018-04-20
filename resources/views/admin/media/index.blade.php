
@extends('layouts.admin')

@section('script')
  <script>
      $(document).ready(function(){
          $('#options').click(function () {
             if(this.checked){
                 $('.checkbox').each(function () {
                     this.checked=true
                 })
             }else{
                 $('.checkbox').each(function () {
                   this.checked=false
                 })
             }
          });
        });
  </script>
@stop

@section('content')
  <p class="bg-info"> {{session('deletemedia_id')}}</p>
    <h1>Media</h1>

  <form action="deletebycheck" name="deleteselected" method="POST" class="form-inline">
    {{csrf_field()}}
    {{method_field('delete')}}

    <select name="checkboxarray" id="chs">
      <option value="delete">Delete</option>
    </select>
    <input type="submit" class="btn btn-primary">

    <table class="table table-striped">
      <thead>
        <tr>
          <th><input type="checkbox" id="options"></th>
          <th scope="col">id</th>
          <th scope="col">name</th>
          <th scope="col">size</th>
          <th scope="col">created</th>
          <th scope="col">show</th>
          <th scope="col">user</th>
          <th scope="col">post</th>
        </tr>
      </thead>
      <tbody>
      @if($medias)
          @foreach($medias as $media)
        <tr>
          <td><input type="checkbox" name="checkboxarray[]" value={{$media->id}} class="checkbox"></td>
          <th scope="row">{{$media->id}}</th>
          <td>{{$media->path}}</td>
          <td>{{$media->size ? $media->size : 'unknown'}}</td>
          <td>{{$media->created_at ? $media->created_at->diffForHumans() : 'unknown'}}</td>
          <td><img height="100" src="images/{{$media->path ? $media->path : 'default.jpg'}}" alt=""> </td>
          <td>{{$media->user ? $media->user()->name : 'Notmine'}}</td>
          <td>{{$media->post ? $media->post()->title : 'Not mine'}}</td>
          <td>
            {!! Form::open(['method'=>'DELETE','action'=>['AdminMediaController@destroy',$media->id]]) !!}
                {!! Form::token() !!}
                {!! Form::submit('Delete',['class'=>'btn btn-danger']) !!}
                {!! Form::close() !!}

          </td>
        </tr>
          @endforeach
        @endif
      </tbody>
    </table>
  </form>
  <div class="row">
    <div class="col-sm-6 col-sm-offset-5">
      {{$medias->render()}}
    </div>
  </div>

@stop