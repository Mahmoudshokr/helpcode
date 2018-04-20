@extends('layouts.userside')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 ">

                @if($posts)
                    @foreach($posts as $post)

                    <div class="container">
                        <div class="row">
                            <div class="col-md-2">
                                <img height="120px" width="180px" src="images/{{$post->photo ? $post->photo->path : 'default.jpg'}}" alt="">
                            </div>
                            <div class="col-sm-9">
                                <a href="{{route('blog.post',$post->id)}}">{{$post->title}}</a>
                                <br><p class="small">{{ substr($post->body,0,10)}} ..... <br><br><br> to read the full article press the link
                                                 if you like the article please share it. many thanks...</p>
                            </div>
                        </div>
                    </div>
                    <br><br>


                @endforeach
                @endif

                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-5">
                            {{$posts->render()}}
                        </div>
                    </div>


        </div>
    </div>
</div>
@endsection
