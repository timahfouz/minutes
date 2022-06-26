<?php

use Illuminate\Http\Request;
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

Route::get('/', function () {
    return view('index');
});


Route::post('add-models', function(Request $request){
    $output = [];
    $retval=null;
    $url = '/var/www/html/free/minutes';
    foreach ($request->models as $model) {
        $modelName = $model['name'];
        $options = (isset($model['migration']) || isset($model['factory'])) ? '-' : '';
        if (isset($model['migration'])) {
            $options .= 'm';
        }
        if (isset($model['factory'])) {
            $options .= 'f';
        }

        exec("cd $url && php artisan make:model $modelName $options 2>&1", $output,$retval);
    }

    return redirect()->back();
})->name('add.models');