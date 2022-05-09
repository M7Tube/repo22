<?php

use App\Http\Controllers\API\AppApiController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CONTROL\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
//sss
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::group(['as' => 'Auth.'], function () {
        Route::get('handover/perpage/{perpage}', [AppApiController::class, 'gethandover'])->name('gethandover');
        // Route::get('handover/id/{id}', [AppApiController::class, 'getOnehandover'])->name('getOnehandover');
        Route::get('homepage/perpage/{perpage}', [AppApiController::class, 'homepage'])->name('homepage');
        Route::post('create/handover', [AppApiController::class, 'handover'])->name('handover');
        Route::get('create/inspection/{id}', [AppApiController::class, 'inspection'])->name('inspection');
        Route::post('create/template', [AppApiController::class, 'template'])->name('template');
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    });
    // //
    // Route::group(['as' => 'Auth.'], function () {
    //     Route::apiResource('category', CategoryController::class);
    // });
});
Route::group(['as' => 'noAuth.'], function () {
    Route::post('login', [AuthController::class, 'login'])->name('login');
});
// Route::get('clear',function(){
//     Artisan::call('config:cache');
//     return 'sss';
// });

Route::get('/migrate', function() {
    Artisan::call('migrate:refresh');
    Artisan::call('db:seed');
    //
    return "Cache is cleared";
});
Route::get('Test', function () {

    return 'true';
});
Route::get('Download/Test', function () {
    $file = public_path() . "/upload/Doc.53.pdf";

    $headers = array(
        'Content-Type: application/pdf',
    );
    //ssa
    return response()->download($file, 'filename.pdf', $headers);
});



// Route::post('t', function (Request $request) {
//     return [
//         'only_Example' => $request->only(['name', 'password']),
//         'except_Example' => $request->except(['name', 'password']),
//     ];
// });
