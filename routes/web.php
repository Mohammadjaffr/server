<?php

use App\Http\Controllers\archives;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DiggerController;
use App\Http\Controllers\Home;
use App\Http\Controllers\InvoicedetailsController;
use App\Http\Controllers\InvoiceIssController;
use App\Http\Controllers\InvoiceissueController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PackingController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReceivinginvoiceController;
use App\Http\Controllers\reportes;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\TransportController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;
use App\Models\invoice_iss;
use App\Models\invoiceissue;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('auth.signin');
});


Route::get('/index', [Home::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
Route::group(['middleware'=> 'auth'],function (){
    Route::resource('permissions', PermissionController::class);
    Route::resource('roles', RoleController::class);
//    Route::get('roles/{id}/add-premissions',[RoleController::class,'addPermissionToRole']);
    Route::get('roles/{roleId}/give-premissions',[RoleController::class,'addPermissionToRole']);
//    Route::put('roles/{roleId}/update-premissions',[RoleController::class,'givePermissionToRole']);
    Route::put('/roles/{roleId}/update-permission', [RoleController::class, 'updatePermissions'])->name('roles.update.permissions');
});
Route::resource('user',UserController::class);
Route::resource('digger',DiggerController::class);
Route::resource('unit',UnitController::class);
Route::resource('pk',PackingController::class);
Route::resource('client',ClientController::class);
Route::resource('vendor',VendorController::class);
Route::resource('store',StoreController::class);
Route::resource('com',CompanyController::class);
Route::resource('item',ItemController::class);
Route::get('/packing/{id}',[ItemController::class,'getunit']);

Route::get('/fetch-items/{id}',[ReceivinginvoiceController::class,'fetchItems']);
Route::get('/fetch-unit/{id}',[ReceivinginvoiceController::class,'fetchUnit']);


Route::get('/item/{id}',[ItemController::class,'rec_unit']);
Route::get('receive/{id}/print', [ReceivinginvoiceController ::class,'print']);
Route::get('MarkAsRead_all', [ItemController ::class,'MarkAsRead_all'])->name('read_all');
Route::get('unreadNotifications', [ItemController ::class,'unreadNotifications'])->name('unreadNotifications');
Route::get('unreadNotifications_count', [ItemController ::class,'unreadNotifications_count'])->name('unreadNotifications_count');

Route::get('issue/{id}/print', [InvoiceIssController::class,'print']);
Route::get('receive/{id}/pdf', [ReceivinginvoiceController ::class,'genpdf']);
Route::get('issue/{id}/pdf', [InvoiceIssController::class,'genpdf']);
Route::resource('receive',ReceivinginvoiceController::class );
Route::resource('transport',TransportController::class );
Route::resource('issue',InvoiceIssController::class );
Route::get('show_notify/n',[ItemController::class,'notiy' ])->name('show_notify');
//start archives //

Route::resource('arch',archives::class);
Route::get('arch_rec',[ReceivinginvoiceController::class ,'archives']);
Route::get('arch_rec/restore/{id}', [ReceivinginvoiceController ::class,'restore_inv_rec'])->name('restore_rec');
Route::get('arch_iss/restore/{id}', [InvoiceIssController ::class,'restore_inv_iss'])->name('restore_iss');
Route::get('arch_rec/delete/{id}', [ReceivinginvoiceController ::class,'delete_inv_rec'])->name('delete_rec');
Route::get('arch_iss/delete/{id}', [InvoiceIssController ::class,'delete_inv_iss'])->name('delete_iss');
Route::get('arch_iss',[InvoiceIssController::class ,'archives_iss']);
///end archives
//// start report
Route::get('report_vendor',[reportes::class,'index']);
Route::get('/Search_vendor',[reportes::class,'Search_vendor']);

Route::get('report_client',[reportes::class,'report_client']);
Route::get('/Search_client',[reportes::class,'Search_client']);

Route::get('report_invoice_rec',[reportes::class,'report_invoice_rec']);
Route::get('/Search_invoice_rec',[reportes::class,'Search_invoice_rec']);
Route::get('report_invoice_iss',[reportes::class,'report_invoice_iss']);
Route::get('/Search_invoice_iss',[reportes::class,'Search_invoice_iss']);

/////end report
Route::get('products',[ReceivinginvoiceController::class,'getProducts']);
Route::get('v', function () {
    return view('editprofile');
});
Route::get('r', function () {
    return view('404');
});








