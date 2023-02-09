<?php

namespace App\Http\Repositories\Eloquent;

use App\Models\PatchNote;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class PatchNoteRepository extends BaseRepository
{
    public function __construct(PatchNote $patchNote)
    {
        parent::__construct($patchNote);
    }

    public function all(): Collection
    {
        return PatchNote::all();
    }

}
