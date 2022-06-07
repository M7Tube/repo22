<?php

use App\Http\Controllers\API\AppApiController;
use App\Http\Controllers\API\AuthController;
use App\Models\ReportCategory;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CONTROL\CategoryController;
use App\Models\Attrubite;
use App\Models\Template;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
        Route::get('Inspection/inProgress/history/perpage/{perpage}', [AppApiController::class, 'inProgressHistory'])->name('inProgressHistory');
        Route::get('Inspection/Complate/history/perpage/{perpage}', [AppApiController::class, 'ComplateHistory'])->name('ComplateHistory');
        Route::get('homepage/perpage/{perpage}', [AppApiController::class, 'homepage'])->name('homepage');
        //Create Route
        Route::group(['prefix' => '/create'], function () {
            Route::get('/inspection/{id}', [AppApiController::class, 'inspection'])->name('inspection');
            Route::post('/inspection/saveValue', [AppApiController::class, 'saveValue'])->name('saveValue');
            Route::post('/inspection/inprogress', [AppApiController::class, 'inspection_inprogress'])->name('inspection_inprogress');
            Route::post('/handover', [AppApiController::class, 'handover'])->name('handover');
            Route::post('/template', [AppApiController::class, 'template'])->name('template');
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
Route::get('Download/Test', function () {
    $file = public_path() . "/upload/Doc.53.pdf";

    $headers = array(
        'Content-Type: application/pdf',
    );
    //ssa
    return response()->download($file, 'filename.pdf', $headers);
});
Route::get('test', function () {
    $template_category = ['name' => 'FirstQuestion', 'template_id' => 1];
    foreach ([$template_category] as $data) {
        $category = ReportCategory::Create([
            'name' => $data['name'],
            'template_id' => $data['template_id'],
        ]);
        // if (!is_null($data->att)) {
        //     foreach ($data->att as $key2 => $data2) {
        //         $attrubite = Attrubite::Create([
        //             'name' => $data2->name,
        //             'template_id' => $newTemplate->template_id,
        //             'status' => $data2->status,
        //             'category_id' => $category->category_id,
        //         ]);
        //     }
        // } else {
        // }
        // if (!is_null($data->textbox)) {
        //     foreach ($data->textbox as $key3 => $data3) {
        //         $textbox = TextBox::Create([
        //             'name' => $data3->name,
        //             'template_id' => $newTemplate->template_id,
        //             'category_id' => $category->category_id,
        //         ]);
        //     }
        // } else {
        // }
        // if (!is_null($data->selector)) {
        //     foreach ($data->selector as $key4 => $data4) {
        //         $selector = Selector::Create([
        //             'name' => $data4->name,
        //             'values' => $data4->values,
        //             'template_id' => $newTemplate->template_id,
        //             'category_id' => $category->category_id,
        //         ]);
        //     }
        // } else {
        // }
    }
    return 'true';
});
