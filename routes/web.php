<?php

use App\Http\Controllers\PachNotesController;
use Illuminate\Support\Facades\Route;


Route::group([
    'prefix' => 'patchNotes'
], function (){
Route::get('/home', [PachNotesController::class, 'index'])->name('index');
});
