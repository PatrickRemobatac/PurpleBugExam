<?php

use App\Models\Expenses;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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

    if(Auth::guest())
    {
        return view('auth.login');
    }
    else
    {
        return redirect('/home');
    }

});

Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('auth');


Route::group(['middleware' => 'auth'], function () {

    //role
    Route::get('/user_manage/role',[\App\Http\Controllers\RoleController::class,'index'])->name('user_manage.role');
    Route::get('/user_manage/role/add',[\App\Http\Controllers\RoleController::class,'update_add'])->name('role.add');
    Route::get('/user_manage/role/update',[\App\Http\Controllers\RoleController::class,'update_role'])->name('role.update');
    Route::get('/user_manage/role/delete',[\App\Http\Controllers\RoleController::class,'delete_role'])->name('role.delete');

    //user
    Route::get('/user_manage/users',[\App\Http\Controllers\UserController::class,'index'])->name('user_manage.users');
    Route::put('/user_manage/users/register',[\App\Http\Controllers\UserController::class,'add_user'])->name('user_manage.register');
    Route::get('/user_manage/users/update',[\App\Http\Controllers\UserController::class,'update_user'])->name('user_manage.update');
    Route::get('/user_manage/users/delete',[\App\Http\Controllers\UserController::class,'delete_user'])->name('user_manage.delete');
    Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
    Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
    Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);

    //adding of category
    Route::get('/expense_manage/categories',[\App\Http\Controllers\ExpensesController::class,'index_exp_cat'])->name('expense_manage.expense_cat');
    Route::get('/expense_manage/categories/add',[\App\Http\Controllers\ExpensesController::class,'add_cat'])->name('expense_manage.add_cat');
    Route::get('/expense_manage/categories/update',[\App\Http\Controllers\ExpensesController::class,'update_cat'])->name('expense_manage.update_cat');
    Route::get('/expense_manage/categories/delete',[\App\Http\Controllers\ExpensesController::class,'delete_cat'])->name('expense_manage.delete_cat');

    //adding of expenses
    Route::get('/expense_manage/expenses',[\App\Http\Controllers\ExpensesController::class,'index_expenses'])->name('expense_manage.expenses');
    Route::get('/expense_manage/expenses/add',[\App\Http\Controllers\ExpensesController::class,'add_expenses'])->name('expense_manage.add_expenses');
    Route::get('/expense_manage/expenses/update',[\App\Http\Controllers\ExpensesController::class,'update_expenses'])->name('expense_manage.update_expenses');
    Route::get('/expense_manage/expenses/delete',[\App\Http\Controllers\ExpensesController::class,'delete_expenses'])->name('expense_manage.delete_expenses');

    //dasboard
    Route::get('/dashboard/getdata',[\App\Http\Controllers\ChartController::class,'get_data'])->name('dash.get_data');
//	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);

});


//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
