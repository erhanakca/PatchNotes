<?php

use App\Http\Controllers\PatchNotesController;
use Illuminate\Support\Facades\Route;


Route::group([
    'prefix' => 'patchNotes'
], function (){
Route::get('/index', [PatchNotesController::class, 'index'])->name('index');
Route::get('/dateFilter/', [PatchNotesController::class, 'dateFilter'])->name('dateFilter');
Route::POST('/tagFilter/', [PatchNotesController::class, 'tagFilter'])->name('tagFilter');
Route::POST('/create/', [PatchNotesController::class, 'create'])->name('create');
});

