<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PatchNoteLink extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'patch_note_link_id';
    protected $table = 'patch_note_links';

    protected $fillable = [
        'patch_note_id',
        'link'
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
