<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\Posts;
use App\Photo;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts=Post::all();
        return view('admin.posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories=Category::pluck('name','id')->all();
        return view('admin.posts.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Posts $request)
    {
        //
        $user=Auth::user();
        $input=$request->all();
        if ($file=$request->file('photo_id')){
            $name=time().$file->getClientOriginalName();
            $size=$file->getClientSize();
            $file->move('images',$name);
            $photo=Photo::create(['path'=>$name,'size'=>$size]);
            $input['photo_id']=$photo->id;
        }
        $user->post()->create($input);

        return redirect('adminpost');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $posts=Post::findOrfail($id);
        $categories=Category::pluck('name','id')->all();
        return view('admin.posts.edit',compact('posts','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Posts $request, $id)
    {
        //
        $input=$request->all();
        $user=Auth::user(); // only the owner of the post can update it
        if ($file=$request->file('photo_id')){
            $name=time().$file->getClientOriginalName();
            $size=$file->getClientSize();
            $file->move('images',$name);
            $photo=Photo::create(['path'=>$name]);
            $input['photo_id']=$photo->id;
        }
        $user->post()->where('id',$id)->first()->update($input);
        return redirect('adminpost');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $posts=Post::findOrfail($id);
        if ($posts->photo_id){
            unlink(public_path().'\images\\'.$posts->photo->path);
        }
        $posts->delete();
        Session::flash('deletepost_id','post number '.$id.' has been deleted');
        return redirect('adminpost');
    }
}
