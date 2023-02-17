<?php

use App\Http\Controllers\PatchNotesController;
use Illuminate\Support\Facades\Route;


Route::group([
    'prefix' => 'patchNotes'
], function (){
Route::get('/index', [PatchNotesController::class, 'index'])->name('index');
Route::get('/dateFilter/', [PatchNotesController::class, 'dateFilter'])->name('dateFilter');
Route::get('/tagFilter/', [PatchNotesController::class, 'tagFilter'])->name('tagFilter');
Route::post('/create/', [PatchNotesController::class, 'create'])->name('create');
Route::put('/update/{patch_note_id}', [PatchNotesController::class, 'update'])->name('update');
Route::delete('/delete/{patch_note_id}', [PatchNotesController::class, 'delete'])->name('delete');
});

