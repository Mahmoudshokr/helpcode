@extends('layouts.admin')

@section('content')

    <h1>Admin dashboard</h1>

    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="panel panel-info">
                    <div class="panel-heading" >
                        <h1 class="text-center">Posts</h1>
                    </div>

                    <div class="panel-body">
                        <h1 class="text-center">
                            {{count(\App\Post::all())}}

                        </h1>
                    </div>

                    <div class="panel-footer">

                    </div>

                </div>
            </div>

            <div class="col-sm-3">
                <div class="panel panel-success">
                    <div class="panel-heading" >
                        <h1 class="text-center">Images</h1>
                    </div>

                    <div class="panel-body">
                        <h1 class="text-center">{{count(\App\Photo::all())}}</h1>
                    </div>

                    <div class="panel-footer">

                    </div>

                </div>
            </div>

            <div class="col-sm-3">
                <div class="panel panel-danger">
                    <div class="panel-heading" >
                        <h1 class="text-center">Categories</h1>
                    </div>

                    <div class="panel-body">
                        <h1 class="text-center">{{count(\App\Category::all())}}</h1>
                    </div>

                    <div class="panel-footer">

                    </div>

                </div>
            </div>

            <div class="col-sm-offset-3 col-sm-3">
                <div class="panel panel-yellow">
                    <div class="panel-heading" >
                        <h1 class="text-center">Users</h1>
                    </div>

                    <div class="panel-body">
                        <h1 class="text-center">{{count(\App\User::all())}}</h1>
                    </div>

                    <div class="panel-footer">

                    </div>

                </div>
            </div>

        </div>
    </div>



@stop