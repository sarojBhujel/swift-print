<?php

use App\Http\Controllers\ChalanController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MachineController;
use App\Http\Controllers\PaperController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SignatureController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\UserController;
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
    // dd('jhghg');
    return redirect()->route('dashboard');
});
Route::get('/login', [LoginController::class,'show'])->name('login');
Route::post('/login', [LoginController::class,'login'])->name('login.perform');
Route::group(
    [
        // 'middleware' => ['auth']
    ]
    , function () {
    Route::get('/dashboard', function () {
        // dd('dsfsd');
        return view('backend.dashboard');
    })->name('dashboard');
    Route::resource('/jobs', JobController::class);
    Route::get('/jobs-datatables', [JobController::class, 'getDataTableData'])->name('getDataTableData');
    Route::get('/customer-list', [CustomerController::class, 'getCustomerList'])->name('getCustomerList');
    Route::get('/papers-datatables', [PaperController::class, 'getPaperData'])->name('getPaperData');
    Route::get('/customers-datatables', [CustomerController::class, 'getCustomerData'])->name('getCustomerData');
    Route::resource('/customers', CustomerController::class);
    Route::resource('/papers', PaperController::class);
    Route::get('/papers-list', [PaperController::class, 'getPaperList']);
    Route::get('/equipment-list', [MachineController::class, 'getEquipmentList']);
    Route::resource('/equipments', MachineController::class);
    Route::get('/equipments-datatables', [MachineController::class, 'getMachineData'])->name('getMachineData');
    Route::resource('/quotations', QuotationController::class);
    Route::get('/quotations-datatables', [QuotationController::class, 'getQuotationData'])->name('getQuotationData');
    Route::get('/users-list', [QuotationController::class, 'userList'])->name('userList');
    Route::resource('/signatures', SignatureController::class);
    Route::get('/signatures-datatables', [SignatureController::class, 'getSignatureData'])->name('getSignatureData');
    Route::resource('/chalans', ChalanController::class);
    Route::get('/chalans-datatables', [ChalanController::class, 'getChalanData'])->name('getChalanData');
    Route::get('/signatures-active/{id}', [SignatureController::class, 'changeActive'])->name('changeSignatureActive');
    
    // Route::resource('/paper-stocks', StockController::class);
    Route::get('/view-paper-stocks/{paper_id}', [StockController::class, 'index'])->name('paperStocks.index');
    Route::get('/paper-stocks/{id}/edit', [StockController::class, 'edit'])->name('paperStocks.index');
    Route::post('/paper-stocks', [StockController::class, 'store'])->name('paperStocks.store');
    Route::delete('/paper-stocks/{id}', [StockController::class, 'destroy'])->name('paperStocks.delete');
    Route::get('/paper-stocks-datatables/{paper_id}', [StockController::class, 'getStockData'])->name('getStockData');
    Route::get('/logout', [LoginController::class,'logout'])->name('logout.perform');
    Route::resource('/roles', RoleController::class);
    Route::get('/roles-datatables', [RoleController::class,'getRoleData'])->name('getRoleData');
    Route::get('/roles-list', [UserController::class,'getRoleList'])->name('getRoleList');
    Route::resource('/users', UserController::class);
    Route::get('/users-datatables', [UserController::class,'getUserData'])->name('getUserData');
    Route::get('/get-paper-balance/{id}', [StockController::class,'getbalance'])->name('getpaperData');
    Route::post('/create-customer', [JobController::class,'createCustomer'])->name('createCustomer');
});
route::get('quotation-design',function(){
    return view('quotationDesign');
});
Route::get('generate-pdf/{id}', [QuotationController::class, 'renderDynamicBladeView'])->name('generatePdf');
Route::get('getLatestQuotation', [QuotationController::class, 'getLatestQuotation'])->name('getLatestQuotation');
// Route::get('/customers-list',[CustomerController::class,'list']);
Route::get('migrate246820',function(){
    \Artisan::call('migrate');
    return 'migrated successfully';
});