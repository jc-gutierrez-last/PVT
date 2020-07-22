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

 /*
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

Route::get('{any}', function () {
    return view('index');
})->where('any', '^(?!.*(api|docs|logs)).*$')->name('index.php');
*/

//mio
use App\Http\Controllers\CategoriaController;
use Illuminate\Support\Facades\Route;

//proyecto user
Route::get("/", function(){
    return view("inicio");
});

Route::post("/inicio", "LoginController@inicio");


/*
Route::get('/notas/{id}/editar', function ($id) {
    $note = DB::table('login')
        ->where('login', $id)
        ->first();
 
    return ['note' => $note];
});
*/