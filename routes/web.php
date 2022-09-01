<?php

/* use App\Http\Controllers\BackEnd\AdminLoginController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CityController;
use App\Http\Controllers\Backend\CountryController;
use App\Http\Controllers\Backend\HomeController;
use App\Http\Controllers\Backend\StateController;
use App\Http\Controllers\Backend\SubcategoryController; */

use App\Http\Controllers\FrontEnd\AdCategoryController;
use App\Http\Controllers\FrontEnd\AdPostController;
use App\Http\Controllers\FrontEnd\EmailAdController;
use App\Http\Controllers\FrontEnd\FrontPackageController;
use App\Http\Controllers\FrontEnd\FrontPageController;
use App\Http\Controllers\FrontEnd\HomeController;
use App\Http\Controllers\FrontEnd\ReloadBalanceController;
use App\Http\Controllers\FrontEnd\ReportController;
use App\Http\Controllers\FrontEnd\UserControllerManagement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//FronEnd

Route::get('/', [HomeController::class, 'index'])->name('fronthome');
//Ad Category
Route::get('Category/{id}', [AdCategoryController::class, 'index'])->name('AdCategorys');
Route::get('AdCollection/{id}', [AdCategoryController::class, 'AdCollection'])->name('AdCollection');
Route::get('AdDetails/{id}', [AdCategoryController::class, 'AdDetails'])->name('AdDetails');
Route::get('page/{id}', [FrontPageController::class, 'page'])->name('front.page');
//Dashboard
Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/Dashboard', [UserControllerManagement::class, 'index'])->name('user.dashboard');
    Route::get('/ManagePost', [UserControllerManagement::class, 'ManagePost'])->name('user.ManagePost');
    Route::get('/Setting', [UserControllerManagement::class, 'UserSetting'])->name('user.Setting');
    Route::post('/Update', [UserControllerManagement::class, 'UserUpdate'])->name('user.Update');
    Route::post('/ManagePost/delete/{id}', [UserControllerManagement::class, 'PostDestroy'])->name('user.ManagePost.delete');

    Route::get('/reloadBalance', [ReloadBalanceController::class, 'index'])->name('user.reloadBalance');
    Route::get('/reloadBalance/store', [ReloadBalanceController::class, 'CreateCharge'])->name('user.reloadBalance.store');
    Route::get('/reloadBalance/ComplitedTransection', [ReloadBalanceController::class, 'ComplitedTransection'])->name('user.reloadBalance.ComplitedTransection');
    Route::get('/reloadBalance/Cancel', [ReloadBalanceController::class, 'CancelTransection'])->name('user.reloadBalance.CancelTransection');

//post Ad
    Route::get('/LocationSet', [AdPostController::class, 'index'])->name('adpost.locationSet');
    Route::get('/postcategory/{id}', [AdPostController::class, 'postCategory'])->name('adpost.postcategory');
    Route::get('/postcategoryByState/{id}', [AdPostController::class, 'postCategoryBystate'])->name('adpost.postcategoryByState');
    Route::get('/postSubcategory/{id}', [AdPostController::class, 'posSubCategory'])->name('adpost.postSubcategory');
    Route::get('/createPost/{id}', [AdPostController::class, 'NewPost'])->name('adpost.create');
    Route::get('/pCategory', [AdPostController::class, 'Category'])->name('adpost.category');
    Route::post('/store', [AdPostController::class, 'StorePost'])->name('adpost.store');
    Route::get('/edit/{id}', [AdPostController::class, 'edit'])->name('adpost.edit');
    Route::post('/update', [AdPostController::class, 'update'])->name('adpost.update');
    Route::post('/DeleteImage/{id}', [AdPostController::class, 'DeleteImage'])->name('adpost.DeleteImage');

    Route::get('Package', [FrontPackageController::class, 'index'])->name('front.package');

    Route::get('ReportAd/{id}', [ReportController::class, 'create'])->name('Report.create');
    Route::post('ReportAd/store', [ReportController::class, 'store'])->name('Report.store');
    Route::get('ReportAd/show/{id}', [ReportController::class, 'show'])->name('Report.show');

    Route::get('EmailAd/{id}', [EmailAdController::class, 'create'])->name('Emailad.create');
    Route::post('EmailAd/store', [EmailAdController::class, 'store'])->name('Emailad.store');
    Route::get('EmailAd/show/{id}', [EmailAdController::class, 'show'])->name('Emailad.show');

});
//Admin
include 'BackEnd.php';

Auth::routes(['verify' => true]);
