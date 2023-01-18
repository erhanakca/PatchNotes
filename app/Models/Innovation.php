<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Innovation extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'innovation_id';
    protected $table = 'innovations';

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

    public function patchNote()
    {
        return $this->hasMany(Innovation::class, 'innovation_id', 'innovation_id');
    }
}
