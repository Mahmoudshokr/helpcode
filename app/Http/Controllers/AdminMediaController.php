<?php

namespace App\Http\Controllers;

use App\Photo;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminMediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $medias=Photo::paginate(5);
        return view('admin.media.index',compact('medias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.media.uploadmedia');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $file = $request->file('file');
        $name=time().$file->getClientOriginalName();
        $size=$file->getClientSize();
        $file->move('images',$name);
        Photo::create(['path'=>$name,'size'=>$size]);

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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
        Session::flash('deletemedia_id','photo number '.$id.' has been deleted');
        $media=Photo::findOrfail($id);
        unlink(public_path(). '\images\\' . $media->path);
        $media->delete();
        return redirect('adminmedia');
    }
    public function deletebycheck(Request $request)
    {
        if(isset($request->deleteselected) && !empty($request->checkboxarray)) {
            $photos = Photo::findOrFail($request->checkboxarray);
            foreach ($photos as $photo) {
                $photo->delete();
            }

            return redirect()->back();
        }else{
            return redirect()->back();
        }
    }
}
