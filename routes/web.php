<?php

use Illuminate\Support\Facades\Route;

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

$route_prefix = '';

Route::get($route_prefix . '/', function () {
    return view('welcome');
})->name('index');

class Person implements Stringable
{
    public $age = 55;

    public function __toString()
    {
        return '{ "age": "' . $this->age . '" }';
    }
}

Route::get($route_prefix . '/home', function () {
    return view('home', ["letters" => [new Person, new Person]]);
})->name('home');

Route::get($route_prefix . '/about-us',  ['middleware' => 'auth', function () {
    return view('about');
}])->name('regular.about');

Route::get($route_prefix . '/{text}', function ($text) {
    return view('home', ["var" => $text]);
})->where('text', '^.onas');

Route::get($route_prefix . '/1', function () {
    return "<h1>Hello</h1>";
});

Route::group(['prefix' => 'admin'], function () {
    Route::get('/1', function () {
        return "Success 1";
    });
    Route::get('/2', function () {
        return "Success 2";
    });
    Route::get('/3', function () {
        return "Success 3";
    });
});


// // <=L7
// Route::get('/posts', 'App\Http\Controllers\BlogPostController@index');
// Route::get('/posts/{id}', 'App\Http\Controllers\BlogPostController@show');

// >=L8
use App\Http\Controllers\BlogPostController;

Route::get('/posts', [BlogPostController::class, 'index'])->name('posts.index');
Route::get('/posts/{id}', [BlogPostController::class, 'show'])->name('posts.show');
Route::post('/posts', [BlogPostController::class, 'store'])->name('posts.store');
Route::delete('/posts/{id}', [BlogPostController::class, 'destroy'])->name('posts.destroy');
Route::put('/posts/{id}', [BlogPostController::class, 'update'])->name('posts.update');

Route::post('/posts/{id}/comments', [BlogPostController::class, 'storePostComment'])->name('posts.comments.store');

// Route::get('/posts', [
//     'uses' => 'App\Http\Controllers\BlogPostController@index', // koks kontroleris naudojamas
//     'as' => 'posts.index' // route’o vardas
// ]);

// tas pat kaip: 
// Route::get('/posts', 'App\Http\Controllers\BlogPostController@index')->name('posts.index');
// Route::get('/posts', [BlogPostController::class, 'index'])->name('posts.index');


// Route::get('/db', function () {
//     var_dump(Illuminate\Support\Facades\DB::connection()->getPdo());
//     return view('welcome');
// })->name('testdb');


Route::get('/bp', function () {
    $bp = new App\Models\BlogPost();
    // $bp->title = "Bp 1";
    // $bp->text = "Bp text 1";
    // $bp->save();
    // return App\Models\BlogPost::where('title', 'Bp 1')->latest()->first();
    return App\Models\BlogPost::all();
});


Route::get('/test-m2m', function () {
    // dump(\App\Models\User::find(1)->roles);
    // dump(\App\Models\Role::find(1)->users()->orderBy('name')->get());
    // $roles = \App\Models\User::find(1)->roles()->orderBy('name')->get();
    $roles = \App\Models\Role::orderByDesc('name')->get();
    foreach ($roles as $role) {
        print($role->name . '<br>');
    }

    // $user = \App\Models\User::find(1);
    // foreach ($user->roles as $role) {
    //     print($role);
    // }
});


use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
