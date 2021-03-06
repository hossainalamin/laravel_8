<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Users;
use App\Http\Controllers\UserAuth;
use App\Http\Controllers\ModelConnection;
use App\Http\Controllers\FileUpload;
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
Route::get('/', function () {
    return view('welcome');
});
Route::get('login',function(){
    return view('userform');
});
Route::view("noaccess","noaccess");
Route::view("http","http");
Route::view("fileupload","fileupload");
Route::view("addmember","addmember");
Route::view("add","add");
Route::get('profile',function(){
    if(!session()->has('name')){
        return redirect('login');
    }
});
Route::get('/userlogin',function(){
    if(session()->has('name')){
        return redirect('profile');
    }
});
Route::get('/logout',function(){
    if(session()->has('name')){
        session()->pull('name');
    }
    return redirect('login');
});
Route::get('/language/{lang}',function($lang){
App::setlocale($lang);
return view('language');
});
//rediection from  page
Route::get('/about',function(){
return view('about');
//return redirect ("/");
})->middleware('protectedpage');
//another way of routing
//Route::view('contact','contact');

//passing data with routing with route contraints
Route::get('/contact/{number}',function($number){
    return view ('contact',["number"=>"$number"]);
})->where('number','[0-9]+');

//Routing for controllers
Route::get("users/{name}",[Users::class,'index']);
Route::get("about",[Users::class,'userAbout']);
//Route::post("userform",[Users::class,'userForm']);
Route::get('modelconnection',[ModelConnection::class,'getData']);
Route::get('delete/{id}',[ModelConnection::class,'deleteData']);
Route::get('edit/{id}',[ModelConnection::class,'editData']);
Route::get('datashow',[ModelConnection::class,'showData']);
Route::post('adduser',[ModelConnection::class,'userAdd']);
Route::post('edit',[ModelConnection::class,'updateData']);
Route::get("show",[ModelConnection::class,'accessors']);
Route::get("save",[ModelConnection::class,'mutators']);
Route::get("get",[ModelConnection::class,'company']);
Route::get("double",[ModelConnection::class,'list']);
Route::get('model/{key:company_name}',[ModelConnection::class,"model"]);
Route::get('database',[Users::class,'database']);
Route::get('data',[Users::class,'queryBuilder']);
Route::get('http',[Users::class,'httpRequest']);
Route::delete("method",[Users::class,'httpMethod']);
Route::get("list",[Users::class,'agrigate']);
Route::get("list",[Users::class,'innerJoin']);
Route::post('userlogin',[UserAuth::class,'userLogin']);
Route::post('useradd',[UserAuth::class,'userAdd']);
Route::post('fileupload',[FileUpload::class,'index']);

//route for middleware
Route::group(['middleware'=>['protectedpage']],function(){
    Route::get('/contact',function(){
        return view('contact');
        });
});
//fluent String
$data = "hi from laravel fluent String";
$data = Str::of($data)
->ucfirst($data)
->camel($data)
->replaceFirst("hi","Hello",$data);
echo $data;