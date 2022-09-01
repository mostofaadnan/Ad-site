<?php

use App\Http\Controllers\BackEnd\addBannerController;
use App\Http\Controllers\BackEnd\AdminLoginController;
use App\Http\Controllers\BackEnd\AdminReportController;
use App\Http\Controllers\BackEnd\AdminResetPasswordController;
use App\Http\Controllers\BackEnd\AdminUserController;
use App\Http\Controllers\BackEnd\AdminUserProfileController;
use App\Http\Controllers\BackEnd\ApiController;
use App\Http\Controllers\BackEnd\CategoryController;
use App\Http\Controllers\BackEnd\CityController;
use App\Http\Controllers\BackEnd\CountryController;
use App\Http\Controllers\BackEnd\ExtendDayTypeController;
use App\Http\Controllers\BackEnd\FeatureTypeController;
use App\Http\Controllers\BackEnd\HomeController;
use App\Http\Controllers\BackEnd\menuController;
use App\Http\Controllers\BackEnd\notificationController;
use App\Http\Controllers\BackEnd\PackageController;
use App\Http\Controllers\BackEnd\PageController;
use App\Http\Controllers\BackEnd\postController;
use App\Http\Controllers\BackEnd\PostManageController;
use App\Http\Controllers\BackEnd\ReportOptionController;
use App\Http\Controllers\BackEnd\seitesettingController;
use App\Http\Controllers\BackEnd\StateController;
use App\Http\Controllers\BackEnd\SubcategoryController;
use App\Http\Controllers\BackEnd\UserBalanceHistoryController;
use App\Http\Controllers\BackEnd\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'Admin'], function () {

//Login
    Route::get('login', [AdminLoginController::class, 'showLoginFrom'])->name('admin.login');
    Route::post('login', [AdminLoginController::class, 'login'])->name('admin.login.submit');
    Route::post('logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

    Route::group(['middleware' => ['auth:admin', 'verified']], function () {

        //Home
        Route::get('/', [HomeController::class, 'index'])->name('admin.home');
        Route::get('/coundata', [HomeController::class, 'CountData'])->name('admin.countdata');
        Route::get('/RecentPost', [HomeController::class, 'RecentPost'])->name('admin.RecentPost');

        Route::group(['prefix' => 'Notifications'], function () {
            Route::get('/markAsReadmessage/{id}', [notificationController::class, 'markAsReadmessage'])->name('admin.markAsReadmessage');
        });
        //Country Router
        Route::group(['prefix' => 'Country'], function () {
            Route::get('/', [CountryController::class, 'index'])->name('countrys');
            Route::get('/loadall', [CountryController::class, 'LoadAll'])->name('country.loadall');
            Route::post('/store', [CountryController::class, 'store'])->name('country.store');
            Route::post('/delete/{id}', [CountryController::class, 'destroy'])->name('country.delete');
            Route::get('/show', [CountryController::class, 'show'])->name('country.show');
            Route::post('/update', [CountryController::class, 'update'])->name('country.update');
            Route::post('/filterdelete', [CountryController::class, 'Filterdelete'])->name('country.filterdelete');
        });

        //State Router
        Route::group(['prefix' => 'State'], function () {
            Route::get('/', [StateController::class, 'index'])->name('states');
            Route::get('/loadall', [StateController::class, 'LoadAll'])->name('state.loadall');
            Route::post('/store', [StateController::class, 'store'])->name('state.store');
            Route::post('/delete/{id}', [StateController::class, 'destroy'])->name('state.delete');
            Route::get('/show', [StateController::class, 'show'])->name('state.show');
            Route::post('/update', [StateController::class, 'update'])->name('state.update');
            Route::get('/get-state-list', [StateController::class, 'getStateList']);
            Route::get('/inactive/{id}', [StateController::class, 'inActive'])->name('state.inactive');
            Route::get('/active/{id}', [StateController::class, 'Active'])->name('state.active');
        });

        //State Router
        Route::group(['prefix' => 'City'], function () {
            Route::get('/', [CityController::class, 'index'])->name('citys');
            Route::get('/loadall', [CityController::class, 'LoadAll'])->name('city.loadall');
            Route::post('/store', [CityController::class, 'store'])->name('city.store');
            Route::post('/delete/{id}', [CityController::class, 'destroy'])->name('city.delete');
            Route::get('/show', [CityController::class, 'show'])->name('city.show');
            Route::post('/update', [CityController::class, 'update'])->name('city.update');
            Route::get('/get-city-list', [CityController::class, 'getCityList']);
            Route::get('/inactive/{id}', [CityController::class, 'inActive'])->name('city.inactive');
            Route::get('/active/{id}', [CityController::class, 'Active'])->name('city.active');
        });
        //Category Router
        Route::group(['prefix' => 'Category'], function () {
            Route::get('/', [CategoryController::class, 'index'])->name('categories');
            Route::get('/loadall', [CategoryController::class, 'LoadAll'])->name('category.loadall');
            Route::post('/store', [CategoryController::class, 'store'])->name('category.store');
            Route::post('/delete/{id}', [CategoryController::class, 'destroy'])->name('category.delete');
            Route::get('/show', [CategoryController::class, 'show'])->name('category.show');
            Route::post('/update', [CategoryController::class, 'update'])->name('category.update');
            Route::get('/getlist', [CategoryController::class, 'GetList'])->name('category.getlist');
        });

//subcategory Router
        Route::group(['prefix' => 'Sub-Category'], function () {
            Route::get('/', [SubcategoryController::class, 'index'])->name('subcategories');
            Route::get('/loadall', [SubcategoryController::class, 'LoadAll'])->name('subcategory.loadall');
            Route::get('/show', [SubcategoryController::class, 'show'])->name('subcategory.show');
            Route::post('/store', [SubcategoryController::class, 'store'])->name('subcategory.store');
            Route::post('/delete/{id}', [SubcategoryController::class, 'destroy'])->name('subcategory.delete');
            Route::post('/update', [SubcategoryController::class, 'update'])->name('subcategorys.update');
        });

        //Feature Router
        Route::group(['prefix' => 'Feature'], function () {
            Route::get('/', [FeatureTypeController::class, 'index'])->name('features');
            Route::get('/loadall', [FeatureTypeController::class, 'LoadAll'])->name('feature.loadall');
            Route::post('/store', [FeatureTypeController::class, 'store'])->name('feature.store');
            Route::post('/delete/{id}', [FeatureTypeController::class, 'destroy'])->name('feature.delete');
            Route::get('/show', [FeatureTypeController::class, 'show'])->name('feature.show');
            Route::post('/update', [FeatureTypeController::class, 'update'])->name('feature.update');
            Route::get('/getlist', [FeatureTypeController::class, 'GetList'])->name('feature.getlist');
        });
        //Extend Router
        Route::group(['prefix' => 'Extend'], function () {
            Route::get('/', [ExtendDayTypeController::class, 'index'])->name('extends');
            Route::get('/loadall', [ExtendDayTypeController::class, 'LoadAll'])->name('extend.loadall');
            Route::post('/store', [ExtendDayTypeController::class, 'store'])->name('extend.store');
            Route::post('/delete/{id}', [ExtendDayTypeController::class, 'destroy'])->name('extend.delete');
            Route::get('/show', [ExtendDayTypeController::class, 'show'])->name('extend.show');
            Route::post('/update', [ExtendDayTypeController::class, 'update'])->name('extend.update');
            Route::get('/getlist', [ExtendDayTypeController::class, 'GetList'])->name('extend.getlist');
        });

        //Extend Router
        Route::group(['prefix' => 'PostManage'], function () {
            Route::get('/', [PostManageController::class, 'index'])->name('PostManages');
            Route::get('/loadall', [PostManageController::class, 'LoadAll'])->name('PostManages.loadall');
            Route::get('/show/{id}', [PostManageController::class, 'show'])->name('PostManages.show');
            Route::get('/inactive/{id}', [PostManageController::class, 'inActive'])->name('PostManages.inactive');
            Route::get('/active/{id}', [PostManageController::class, 'Active'])->name('PostManages.active');
            Route::delete('/delete/{id}', [PostManageController::class, 'Destroy'])->name('PostManages.delete');
        });
   //Report Option
        Route::group(['prefix' => 'ReportOption'], function () {
            Route::get('/', [ReportOptionController::class, 'index'])->name('reportoptions');
            Route::get('/loadall', [ReportOptionController::class, 'LoadAll'])->name('reportoption.loadall');
            Route::post('/store', [ReportOptionController::class, 'store'])->name('reportoption.store');
            Route::post('/delete/{id}', [ReportOptionController::class, 'destroy'])->name('reportoption.delete');
            Route::get('/show', [ReportOptionController::class, 'show'])->name('reportoption.show');
            Route::post('/update', [ReportOptionController::class, 'update'])->name('reportoption.update');
            /*  Route::get('/getlist', [ReportOptionController::class, 'GetList'])->name('category.getlist'); */
        });
        //Package
        Route::group(['prefix' => 'Package'], function () {
            Route::get('/', [PackageController::class, 'index'])->name('packages');
            Route::get('/create', [PackageController::class, 'create'])->name('package.create');
            Route::post('/store', [PackageController::class, 'store'])->name('package.store');
            Route::get('/edit/{id}', [PackageController::class, 'edit'])->name('package.edit');
            Route::post('/update', [PackageController::class, 'update'])->name('package.update');
            Route::get('/inactive/{id}', [PackageController::class, 'Inactive'])->name('package.Inactive');
            Route::get('/active/{id}', [PackageController::class, 'Active'])->name('package.Active');
            Route::delete('/delete/{id}', [PackageController::class, 'Destroy'])->name('package.delete');
        });

        Route::group(['prefix' => 'UserList'], function () {
            Route::get('/', [UserController::class, 'index'])->name('userlist');
            Route::get('/loadall', [UserController::class, 'LoadAll'])->name('userlist.loadall');
            Route::get('/postlist/{id}', [UserController::class, 'userPostList'])->name('userlist.postlist');
            Route::get('/postlist/loadall/{id}', [UserController::class, 'LoadAllUerPost'])->name('userlist.postlist.loadall');

            Route::get('/reloadbalance/{id}', [UserController::class, 'userReloadBalance'])->name('userlist.userReloadBalance');
            Route::get('/reloadbalance/reloadStore', [UserController::class, 'reloadStore'])->name('userlist.userReloadBalance.reloadStore');
       
       
        });

        Route::group(['prefix' => 'Page'], function () {
            Route::get('/', [PageController::class, 'index'])->name('pages');
            Route::get('/loadall', [PageController::class, 'LoadAll'])->name('page.loadall');
            Route::get('/create', [PageController::class, 'create'])->name('page.create');
            Route::post('/store', [PageController::class, 'store'])->name('page.store');
            Route::get('/edit/{id}', [PageController::class, 'edit'])->name('page.edit');
            Route::post('/update', [PageController::class, 'update'])->name('page.update');
            Route::delete('/delete/{id}', [PageController::class, 'destroy'])->name('page.delete');
            Route::get('/GetList', [PageController::class, 'GetList'])->name('page.getlist');
        });
        Route::group(['prefix' => 'Post'], function () {
            Route::get('/', [postController::class, 'index'])->name('posts');
            Route::get('/loadall', [postController::class, 'LoadAll'])->name('post.loadall');
            Route::get('/create', [postController::class, 'create'])->name('post.create');
            Route::post('/store', [postController::class, 'store'])->name('post.store');
            Route::get('/edit/{id}', [postController::class, 'edit'])->name('post.edit');
            Route::post('/update', [postController::class, 'update'])->name('post.update');
            Route::delete('/delete/{id}', [postController::class, 'destroy'])->name('post.delete');

        });

        Route::group(['prefix' => 'menu'], function () {
            Route::get('/', [menuController::class, 'index'])->name('menus');
            Route::get('/loadall', [menuController::class, 'LoadAll'])->name('menu.loadall');
            Route::post('/store', [menuController::class, 'store'])->name('menu.store');
            Route::get('/show', [menuController::class, 'show'])->name('menu.show');
            Route::post('/update', [menuController::class, 'update'])->name('menu.update');
            Route::delete('/delete/{id}', [menuController::class, 'destroy'])->name('menu.delete');
        });
        //admin user
        Route::group(['prefix' => 'Admin'], function () {
            Route::get('/', [AdminUserController::class, 'index'])->name('admins');
            Route::get('/create', [AdminUserController::class, 'create'])->name('admin.create');
            Route::post('/store', [AdminUserController::class, 'store'])->name('admin.store');
            Route::get('/edit/{id}', [AdminUserController::class, 'edit'])->name('admin.edit');
            Route::post('/update/{id}', [AdminUserController::class, 'update'])->name('admin.update');
            Route::get('/loadall', [AdminUserController::class, 'LoadAll'])->name('admin.loadall');
            Route::post('/delete/{id}', [AdminUserController::class, 'destroy'])->name('admin.delete');
        });

        Route::group(['prefix' => 'Reset-Password'], function () {
            Route::get('/', [AdminResetPasswordController::class, 'index'])->name('admin.reset.password');
            Route::post('reset-password', [AdminResetPasswordController::class, 'updatePassword'])->name('admin.reset.update');
        });
        Route::group(['prefix' => 'UserProfile'], function () {
            Route::get('/profile', [UserProfileController::class, 'Profile'])->name('user.profile');
            Route::get('/UserOperationByUser/{id}', [UserProfileController::class, 'UserOperationByUser'])->name('user.UserOperationByUser');
            Route::get('/UserOperationByUserCurrentdate/{id}', [UserProfileController::class, 'UserOperationByUserCurrentdate'])->name('user.UserOperationByUserCurrentdate');
            Route::post('/ImageChange', [UserProfileController::class, 'ImageChange'])->name('user.ImageChange');
        });

        Route::group(['prefix' => 'UserProfile'], function () {
            Route::get('/profile', [AdminUserProfileController::class, 'Profile'])->name('admin.profile');
            Route::post('/ImageChange', [AdminUserProfileController::class, 'ImageChange'])->name('admin.ImageChange');
        });

        Route::group(['prefix' => 'UserBalanceHistory'], function () {
            Route::get('/', [UserBalanceHistoryController::class, 'index'])->name('userbalancesHistory');
            Route::get('/loadall', [UserBalanceHistoryController::class, 'LoadAll'])->name('userbalance.loadall');
            Route::get('/show/{id}', [UserBalanceHistoryController::class, 'show'])->name('userbalance.show');
            Route::get('/userBalanceCheck/{id}', [UserBalanceHistoryController::class, 'UserCheck'])->name('userbalance.balancechek');
            Route::get('/loadall/userBalanceCheck', [UserBalanceHistoryController::class, 'LoadAllUser'])->name('userbalance.balancechek.loadall');
        });

        Route::group(['prefix' => 'AdReports'], function () {
            Route::get('/', [AdminReportController::class, 'index'])->name('AdReports');
            Route::get('/loadall', [AdminReportController::class, 'LoadAll'])->name('AdReport.loadall');
            Route::get('/show/{id}', [AdminReportController::class, 'show'])->name('AdReport.show');
            Route::delete('/delete/{id}', [AdminReportController::class, 'destroy'])->name('AdReport.delete');

        });

        Route::group(['prefix' => 'Api'], function () {
            Route::get('/show', [ApiController::class, 'show'])->name('api.show');
            Route::post('/update', [ApiController::class, 'update'])->name('api.update');

        });
        Route::group(['prefix' => 'General-Setting'], function () {
            Route::get('/show', [seitesettingController::class, 'show'])->name('general.show');
            Route::post('/update', [seitesettingController::class, 'update'])->name('general.update');

        });
        //Ad Banner
        Route::group(['prefix' => 'Ad-Banner'], function () {
            Route::get('/', [addBannerController::class, 'index'])->name('adbanners');
            Route::get('/loadall', [addBannerController::class, 'LoadAll'])->name('adbanners.loadall');
            Route::get('/edit/{id}', [addBannerController::class, 'edit'])->name('adbanners.edit');
            Route::post('/store', [addBannerController::class, 'store'])->name('adbanners.store');
            Route::post('/delete/{id}', [addBannerController::class, 'destroy'])->name('adbanners.delete');
            Route::post('/update', [addBannerController::class, 'update'])->name('adbanners.update');
        });
    });
});