<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PatchNote extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'patch_note_id';
    protected $table = 'patch_notes';

    protected $fillable = [
        'bug_id',
        'innovation_id',
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

    public function bug()
    {
        return $this->hasOne(Bug::class, 'bug_id', 'bug_id');
    }

    public function innovation()
    {
        return $this->hasOne(Innovation::class, 'innovation_id', 'innovation_id');
    }

    public function tag()
    {
        return $this->hasOne(Tag::class, 'tag_id', 'tag_id');
    }
}
