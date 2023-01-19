<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

class PatchNote extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'patch_note_id';
    protected $table = 'patch_notes';

    protected $fillable = [
        'type',
        'text',
        'date'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function patchNoteTag(): HasManyThrough
    {
        return $this->hasManyThrough(PatchNote::class, PatchNoteTags::class, 'patch_note_id', 'tag_id', 'patch_note_id');
    }

    public function patchNoteLink()
    {
        return $this->hasMany(PatchNoteLink::class, 'patch_note_id', 'patch_note_id');
    }

}
