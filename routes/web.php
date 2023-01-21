<?php

use App\Http\Controllers\PatchNotesController;
use Illuminate\Support\Facades\Route;


Route::group([
    'prefix' => 'patchNotes'
], function (){
Route::get('/index', [PatchNotesController::class, 'index'])->name('index');
});

