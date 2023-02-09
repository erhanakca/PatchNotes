<?php

namespace App\Http\Repositories\Eloquent;

use App\Models\PatchNote;
use App\Models\PatchNoteTags;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Collection\Collection;

class PatchNoteTagRepository extends BaseRepository
{
    public function __construct(PatchNoteTags $patchNoteTags)
    {
        parent::__construct($patchNoteTags);
    }

    public function all(): \Illuminate\Database\Eloquent\Collection
    {
        return PatchNote::all();
    }
}
