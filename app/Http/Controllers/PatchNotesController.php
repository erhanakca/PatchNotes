<?php

namespace App\Http\Controllers;

use App\Models\PatchNote;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PatchNotesController extends Controller
{
    public function index()
    {
        $tag = Tag::all();
        $patch_note = PatchNote::all();

        return view('/index', ['tag' => $tag], ['patch_note' => $patch_note]);
    }

    public function filter(Request $request)
    {
        $date = $request->input('date');
        session(['date' => $date]);
        return redirect()->back();
    }
}
