@extends('layouts.userside')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 ">

                @if($posts->count()>0)
                    @foreach($posts as $post)

                        <div class="container">
                            <div class="row">
                                <div class="col-md-2">
                                    <img height="120px" width="180px" src="images/{{$post->photo ? $post->photo->path : 'default.jpg'}}" alt="">
                                </div>
                                <div class="col-sm-9">
                                    <a href="{{route('blog.post',$post->id)}}">{{$post->title}}</a>
                                    <br><p class="small">{!! substr($post->body,0,5)!!} . . . . .</p>
                                </div>
                            </div>
                        </div>
                        <br><br>


                    @endforeach
                    @else
                    <h1 class="text-center">No search results.</h1>
                @endif

            </div>
        </div>
    </div>
@endsection
