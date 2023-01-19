<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PatchNoteTags extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'patch_note_tag_id';
    protected $table = 'patch_note_tags';

    protected $fillable = [
        'patch_note_id',
        'tag_id'
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
}
