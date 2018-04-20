<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CatController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($id)
    {
        //
        $cats=Category::find($id);
        return view('user.postsbycats',compact('cats'));

    }
}
