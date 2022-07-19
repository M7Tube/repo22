<?php

use App\Http\Controllers\ArabicExportController;
use App\Http\Controllers\AttrubireController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\HandOverController;
use App\Http\Controllers\SelectorController;
use App\Http\Controllers\SignatureController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\TextBoxController;
use App\Imports\UsersImport;
use App\Models\Attrubite;
use App\Models\Document;
use App\Models\ReportCategory;
use App\Models\Selector;
use App\Models\Signature;
use App\Models\Statu;
use App\Models\Template;
use GuzzleHttp\Psr7\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Route;
use League\CommonMark\Extension\Attributes\Event\AttributesListener;
use Stevebauman\Location\Facades\Location;
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

Route::redirect('/', '/login');
Route::view('/login', 'auth.login')->middleware('auth.admin');
Route::post('check', LoginController::class)->name('login');
Route::group(['prefix' => 'admin', 'middleware' => 'auth.admin'], function () { //, 'as' => 'web.' //'prefix' => 'admin',
    Route::group(['middleware' => 'auth.mainAdmin'], function () {
        Route::view('register', 'auth.register');
        Route::post('register', RegisterController::class)->name('register');
        Route::view('users', 'users.index')->name('controleUser');
        Route::view('control', 'control')->name('control');
    });
    Route::group(['middleware' => 'auth.questions'], function () {
        Route::resource('status', StatusController::class);
        Route::resource('attrubite', AttrubireController::class);
        Route::resource('selector', SelectorController::class);
        Route::resource('textbox', TextBoxController::class);
        Route::resource('handover', HandOverController::class);
        Route::view('inporgressInspections', 'inporgressInspections.index')->name('inporgressInspections');
        Route::view('document', 'document.index')->name('document');
        Route::view('visit_type', 'visit_type.index')->name('visit_type');
        Route::view('category', 'Category.create')->name('category.create');
        Route::view('category/control', 'Category.control')->name('category.control');
        Route::view('signatures', 'signatures.index')->name('signatures.index');
        Route::get('template/{id}/manage', function ($id) {
            $template = Template::find($id);
            return view('template.manage', compact('template'));
        })->name('template.manage');
        Route::get('template/{id}/delete', function ($id) {
            Attrubite::where('template_id', $id)->delete();
            ReportCategory::where('template_id', $id)->delete();
            Template::destroy($id);
            return redirect('/admin');
        })->name('template.delete');
        Route::resource('template', TemplateController::class);
        Route::resource('form', FormController::class);
        Route::get('Exportform', [FormController::class, 'Exportform'])->name('Exportform');
        Route::post('Exportform', [FormController::class, 'ExportformPost'])->name('Exportform.post');
        // Route::get('export', function () {
        //     $att = Attrubite::all();
        //     $stt = Statu::all();
        //     return view('export', compact('att', 'stt'));
        // });
        Route::post('/employee/pdf', [StatusController::class, 'createPDF'])->name('export');
    });

    Route::get('logout', function () {
        if (session()->has('LoggedAccount')) {
            session()->pull('LoggedAccount');
            return redirect('/login');
        } else {
            return redirect('/login');
        }
    })->name('logout');
    Route::view('/', 'dashboard')->name('dashboard');

    //test for the signuture system
    Route::get('signature-pad',  [SignatureController::class, 'index'])->name('signature');
    Route::post('signature-pad',  [SignatureController::class, 'store']);

    Route::group(['middleware' => 'auth.report'], function () {
        //new
        Route::get('export', ExportController::class)->name('export');
        Route::get('Arexport', ArabicExportController::class)->name('Arexport');
        Route::group(['middleware' => 'auth.mainAdmin'], function () { //, 'as' => 'web.' //'prefix' => 'admin',
            Route::view('import', 'import')->name('Viewimport');
            Route::post('import', function () {
                Excel::import(new UsersImport, request()->file('excel'));
                return back()->with('importmessage', 'Item Imported Successfully');
            })->name('import');
        });
        //English report
        Route::view('itemss', 'items.index');
        Route::view('Report', 'items.basic')->name('info');
        Route::view('Report2', 'items.basic2')->name('info2');
        //Arabic report
        Route::view('Arabicitemss', 'items.Arabicindex');
        Route::view('ArabicReport', 'items.Arabicbasic')->name('Arabicinfo');
        Route::view('ArabicReport2', 'items.Arabicbasic2')->name('Arabicinfo2');
    });
});

Route::get('test', function () {
    // session()->forget('files');
    // return Signature::all('name','signature');
    // return session()->get('LoggedAccount')['email'];
    // session()->flush();
    // session()->forget('Quinfo' . session()->get('LoggedAccount')['email'], []);

    return $info = session()->get('Quinfo' . session()->get('LoggedAccount')['email'], []);
    return $data = session()->get('data' . session()->get('LoggedAccount')['email'], []);
    // session()->forget('cart');
});
