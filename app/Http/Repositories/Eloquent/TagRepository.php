<?php

namespace App\Http\Repositories\Eloquent;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class TagRepository extends BaseRepository
{
    public function __construct(Tag $tag)
    {
        parent::__construct($tag);
    }

    public function all(): Collection
    {
        return Tag::all();
    }

    public function findByName($name)
    {
        return $this->model->where('name', $name)->first();
    }
}
