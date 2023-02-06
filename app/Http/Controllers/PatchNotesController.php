<?php

namespace App\Http\Controllers;

use App\Models\PatchNote;
use App\Models\Tag;
use Faker\Provider\ka_GE\Text;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\TableSelect;

class PatchNotesController extends Controller
{
    public function index()
    {
        $tag = Tag::all();
        $patch_note = PatchNote::whereIn('type', [0,1])
            ->orderBy('date', 'desc')
            ->get();

        return view('/index', ['tag' => $tag], ['patch_note' => $patch_note]);
    }

    public function dateFilter()
    {
        $tag = Tag::all();
        $patch_note = PatchNote::whereIn('type', [0,1])
            ->where('date', '=', $_GET)
            ->orderBy('date', 'desc')
            ->get();

        return view('/index', ['tag' => $tag], ['patch_note' => $patch_note]);
    }
}
