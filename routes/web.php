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
Route::get('/group/{key}', \App\Http\Livewire\Group\Page::class)->name('group.page');
Route::get('/group/{key}/manage/{adminKey}', \App\Http\Livewire\Group\Manage::class)->name('group.manage');

Route::get('/user/{key}', \App\Http\Livewire\Account::class)->name('account');
Route::get('/user/{key}/record-score', \App\Http\Livewire\Score\Record::class)->name('score.record');
