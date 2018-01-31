@extends('layouts.blog-post')


@section('content')



    <!-- Blog Post -->

    <!-- Title -->
    <h1>{{$post->title}}</h1>

    <!-- Author -->
    <p class="lead">
        by <a href="#">{{$post->user->name}}</a>
    </p>

    <hr>

    <!-- Date/Time -->
    <p><span class="glyphicon glyphicon-time"></span> Posted {{$post->created_at->diffForHumans()}}</p>

    <hr>

    <!-- Preview Image -->
    <img class="img-responsive" src="http://localhost/helpcode/public/images/{{$post->photo->path}}" alt="">

    <hr>

    <!-- Post Content -->

    <p>{{$post->body}}</p>

    <hr>


    @if(Session::has('comment_message'))

        {{session('comment_message')}}


    @endif

    <!-- Blog Comments -->


    @if(Auth::check())

        <!-- Comments Form -->
        <div class="well">
            <h4>Leave a Comment:</h4>


            {!! Form::open(['method'=>'POST', 'action'=> 'PostCommentsController@store']) !!}


            <input type="hidden" name="post_id" value="{{$post->id}}">


            <div class="form-group">
                {!! Form::label('body', '') !!}
                {!! Form::textarea('body', null, ['class'=>'form-control','rows'=>3])!!}
            </div>

            <div class="form-group">
                {!! Form::submit('Submit comment', ['class'=>'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}


        </div>


    @endif

    <hr>

    <!-- Posted Comments -->



    @if(count($comments) > 0)


        @foreach($comments as $comment)

            <!-- Comment -->
            <div class="media">
                <a class="pull-left" href="#">
                    <img height="64" class="media-object" src="http://localhost/helpcode/public/images/{{$comment->path}}" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">{{$comment->user}}
                        <small>{{$comment->created_at->diffForHumans()}}</small>
                    </h4>
                    <p>{{$comment->body}}</p>



                @if(count($comment->commentreplies) > 0)


                    @foreach($comment->commentreplies as $reply)






                            <!-- Nested Comment -->
                                <div id="nested-comment" class=" media">
                                    <a class="pull-left" href="#">
                                        <img height="64" class="media-object" src="http://localhost/helpcode/public/images/{{$reply->path}}" alt="">
                                    </a>
                                    <div class="media-body">
                                        <h4 class="media-heading"{{$reply->user}}>
                                        <small>{{$reply->created_at->diffForHumans()}}</small>
                                        </h4>
                                        <p>{{$reply->body}}</p>
                                    </div>
                                    <!-- End Nested Comment -->

                                </div>
                        @endforeach
                                    <div class="comment-reply-container">


                                        <button class="toggle-reply btn btn-primary pull-right">Reply</button>


                                        <div class="comment-reply col-sm-6">


                                            {!! Form::open(['method'=>'POST', 'action'=> 'CommentRepliesController@store']) !!}
                                            <div class="form-group">

                                                <input type="hidden" name="comment_id" value="{{$comment->id}}">


                                                {!! Form::textarea('body', null, ['class'=>'form-control','rows'=>1])!!}
                                            </div>

                                            <div class="form-group">
                                                {!! Form::submit('submit', ['class'=>'btn btn-primary']) !!}
                                            </div>
                                            {!! Form::close() !!}


                                        </div>

                                    </div>
                    @else
                             {{--dublicated reply form to make the reply buttom appear if there is not any replies--}}
                                <h1 class="text-center">No Replies</h1>
                                <div class="comment-reply-container">


                                    <button class="toggle-reply btn btn-primary pull-right">Reply</button>


                                    <div id="comment-reply" class="comment-reply col-sm-6">


                                        {!! Form::open(['method'=>'POST', 'action'=> 'CommentRepliesController@store']) !!}
                                        <div class="form-group">

                                            <input type="hidden" name="comment_id" value="{{$comment->id}}">

                                            {!! Form::textarea('body', null, ['class'=>'form-control','rows'=>1])!!}
                                        </div>

                                        <div class="form-group">
                                            {!! Form::submit('submit', ['class'=>'btn btn-primary']) !!}
                                        </div>
                                        {!! Form::close() !!}


                                    </div>

                                </div>

                    @endif






                </div>
            </div>

        @endforeach

    @endif



@stop


@section('scripts')

    <script>

        $(".comment-reply-container .toggle-reply").click(function(){


            $(this).next().slideToggle("slow");




        });




    </script>



@stop

