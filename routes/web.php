<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\User;
use App\Role;

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/admin',function (){
//    return view('admin.index');
//});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/blogpost/{id}',['as'=>'blog.post','uses'=>'PostCommentsController@post']);

Route::resource('/postbycat','CatController');

Route::group(['middleware'=>'auth'],function (){

    Route::get('/result',function (){

        $posts=\App\Post::Where('title','like','%'.request('query').'%')->get();
        return view('user.results',compact('posts'));
    });

});


Route::group(['middleware'=>'admin'],function (){

    Route::get('/admin',function (){
        return view('admin/index');
    });




    Route::resource('/admincomments','PostCommentsController');
    Route::resource('/admincommentreplies','CommentRepliesController');


    Route::resource('/adminuser','AdminUserController');
    Route::resource('/adminpost','AdminPostController');
    Route::resource('/admincategories','AdminCategoriesController');
    Route::resource('/adminmedia','AdminMediaController');

    Route::delete('/deletebycheck','AdminMediaController@deletebycheck');

    Route::resource('/tag','TagController');


});

Route::get('/{provider}/auth',['uses'=>'SocialController@auth','as'=>'social.auth']);
Route::get('/{provider}/redirect',['uses'=>'SocialController@auth_callback','as'=>'social.callback']);


