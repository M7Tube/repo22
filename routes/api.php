<?php

use App\Http\Controllers\API\AppApiController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CONTROL\CategoryController;
use App\Models\Template;
use Carbon\Carbon;
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



//Protected Route
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::group(['as' => 'Auth.'], function () {
        //get route
        Route::get('handover/perpage/{perpage}', [AppApiController::class, 'gethandover'])->name('gethandover');
        Route::get('Inspection/history', [AppApiController::class, 'History'])->name('History');
        // Route::get('ComplateInspection/history', [AppApiController::class, 'ComplateHistory'])->name('ComplateHistory');
        Route::get('homepage/perpage/{perpage}', [AppApiController::class, 'homepage'])->name('homepage');
        //Create Route
        Route::group(['prefix' => '/create'], function () {
            Route::get('/inspection/{id}', [AppApiController::class, 'inspection'])->name('inspection');
            Route::post('/inspection/saveValue', [AppApiController::class, 'saveValue'])->name('saveValue');
            Route::post('/inspection/inprogress', [AppApiController::class, 'inspection_inprogress'])->name('inspection_inprogress');
            Route::post('/template', [AppApiController::class, 'template'])->name('template');
            Route::post('/handover', [AppApiController::class, 'handover'])->name('handover');
        });
        //auth route
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    });
});
Route::post('/form', [AppApiController::class, 'form'])->name('form');

//Un Protected Route
Route::group(['as' => 'noAuth.'], function () {
    //auth route
    Route::post('login', [AuthController::class, 'login'])->name('login');
});

//this route for delete
Route::get('/migrate', function () {
    Artisan::call('migrate:refresh');
    Artisan::call('db:seed');
    //
    return "Cache is cleared";
});
Route::get('test', function () {
    return Carbon::now();
});
Route::get('Download/Test', function () {
    $file = public_path() . "/upload/Doc.53.pdf";

    $headers = array(
        'Content-Type: application/pdf',
    );
    //ssa
    return response()->download($file, 'filename.pdf', $headers);
});
