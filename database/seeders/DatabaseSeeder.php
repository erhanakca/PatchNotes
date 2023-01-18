<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Http\Controllers\BugController;
use App\Http\Controllers\InnovationController;
use App\Http\Controllers\PatchNotesController;
use App\Http\Controllers\TagController;
use App\Models\Bug;
use App\Models\Innovation;
use App\Models\PatchNote;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        PatchNote::factory()->count(10)->create();
        Bug::factory()->count(10)->create();
        Innovation::factory()->count(10)->create();
        Tag::factory()->count(10)->create();

    }
}
