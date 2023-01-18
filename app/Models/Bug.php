<?php

namespace App\Models;

use App\Http\Controllers\PatchNotesController;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bug extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'bug_id';
    protected $table = 'bugs';

    protected $fillable = [
        'explanation'
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

    public function patchNotes()
    {
        return $this->hasMany(Bug::class,'bug_id', 'bug_id');
    }

}
