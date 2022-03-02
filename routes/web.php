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

Route::get('/', \App\Http\Livewire\Home::class)->name('home');

Route::get('/group/create', \App\Http\Livewire\Group\Create::class)->name('group.create');
Route::get('/group/{group}', \App\Http\Livewire\Group\Home::class)->name('group.home');
Route::get('/group/{group}/verify-email', \App\Http\Livewire\Group\VerifyEmailNotification::class)->name('group.verify-email-notification');
Route::get('/group/{group}/verify', \App\Http\Livewire\Group\Verify::class)->name('group.verify');
//Route::get('/group/{key}/manage/{adminKey}', \App\Http\Livewire\Group\Manage::class)->name('group.manage');


Route::middleware(['auth'])->group(function(){
    Route::get('/account', \App\Http\Livewire\Account\Home::class)->name('account.home');
    Route::get('/logout', \App\Http\Controllers\LogoutController::class)->name('logout');
});

Route::middleware(['guest'])->group(function(){
    Route::get('/login', \App\Http\Livewire\Account\Login::class)->name('login');
    Route::get('/register', \App\Http\Livewire\Account\Register::class)->name('register');
    Route::get('/account/{user}/verify-email', \App\Http\Livewire\Account\VerifyEmailNotification::class)->name('account.verify-email-notification');
    Route::get('/account/{user}/verify', \App\Http\Livewire\Account\Verify::class)->name('account.verify');

});

Route::get('/u/{user}', \App\Http\Livewire\Account\Home::class)->name('account.public-view');

Route::get('/user/{key}/record-score', \App\Http\Livewire\Score\Record::class)->name('score.record');

