<?php

use App\Http\Livewire\Account\Store\CreateStore;
use App\Http\Livewire\Account\Store\ShowAllStore;
use Illuminate\Support\Facades\Route;


Route::get('/', ShowAllStore::class)->name('account');
Route::get('/stores', ShowAllStore::class)->name('account.store');
Route::get('/stores/create', CreateStore::class)->name('account.store.create');