<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin;
use App\Http\Requests\UserRequest;
use App\Photo;
use App\User;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::all();
        return view('admin.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $roles=Role::pluck('name','id')->all();
        return view('admin.users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        //

//        User::create($request->all());
          $input=$request->all();
        if ($file=$request->file('photo_id'))
        {
            $name=time().$file->getClientOriginalName();
            $size=$file->getClientSize();
            $file->move('images',$name);
            $photo=Photo::create(['path'=>$name,'size'=>$size]);
            $input['photo_id']=$photo->id;
        }
        $input['password']=bcrypt($request->password);
        User::create($input);
        return redirect('adminuser');
       //  return $request->all();
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
        $user=User::find($id);
        $roles=Role::pluck('name','id')->all();
        return view('admin.users.edit',compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Admin $request, $id)
    {
        //
        $user=User::findOrfail($id);
        if (trim($request->password)==''){
            $input=$request->except('password');
        }else{
            $input=$request->all();
        }
        if ($file=$request->file('photo_id'))
        {
            $name=time().$file->getClientOriginalName();
            $file->move('images',$name);
            $size=$file->getClientSize();
            $photo=Photo::create(['path'=>$name,'size'=>$size]);
            $input['photo_id']=$photo->id;
        }

        $input['password']=bcrypt($request->password);
        $user->update($input);
        return redirect('adminuser');
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
        $user=User::findOrfail($id);
        if ($user->photo_id) {
            unlink(public_path() . '\images\\' . $user->photo->path);
          }
        $user->delete();

        Session::flash('deleteflash_id','Id number '.$id.' has been deleted ');

        return redirect('adminuser');

    }
}
