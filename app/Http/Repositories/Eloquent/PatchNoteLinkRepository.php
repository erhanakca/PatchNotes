<?php

namespace App\Http\Repositories\Eloquent;

use App\Models\PatchNoteLink;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class PatchNoteLinkRepository extends BaseRepository
{
    public function __construct(PatchNoteLink $patchNoteLink)
    {
        parent::__construct($patchNoteLink);
    }

    public function all(): Collection
    {
        return Model::all();
    }
}
