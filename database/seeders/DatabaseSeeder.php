<?php

namespace Database\Seeders;


use App\Models\PatchNote;
use App\Models\PatchNoteLink;
use App\Models\PatchNoteTags;
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
        Tag::factory()->count(10)->create();
        PatchNoteTags::factory()->count(10)->create();
        PatchNoteLink::factory()->count(10)->create();
        PatchNote::factory()->count(10)->create();
    }
}
