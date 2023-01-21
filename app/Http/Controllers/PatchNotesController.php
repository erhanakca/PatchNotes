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

        return view('/index', ['tag' => $tag]);
    }
}
