<?php

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
    return view('welcome');
});

Route::get('/group/create', \App\Http\Livewire\Group\Create::class)->name('group.create');
Route::get('/group/{group}', \App\Http\Livewire\Group\Home::class)->name('group.home');
Route::get('/group/{group}/verify-email', \App\Http\Livewire\Group\VerifyEmailNotification::class)->name('group.verify-email-notification');
Route::get('/group/{group}/verify', \App\Http\Livewire\Group\Verify::class)->name('group.verify');
//Route::get('/group/{key}/manage/{adminKey}', \App\Http\Livewire\Group\Manage::class)->name('group.manage');



Route::get('/u/{user}', \App\Http\Livewire\Account\Home::class)->name('account.public-view');
Route::get('/account', \App\Http\Livewire\Account\Home::class)->name('account.home');
Route::get('/login', \App\Http\Livewire\Account\Login::class)->name('account.login');

Route::get('/user/{key}/record-score', \App\Http\Livewire\Score\Record::class)->name('score.record');

