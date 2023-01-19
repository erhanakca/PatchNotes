<?php

use App\Models\PatchNote;
use App\Models\Tag;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patch_note_tags', function (Blueprint $table) {
            $table->id('patch_note_tag_id')->autoIncrement();
            $table->foreignIdFor(PatchNote::class, 'patch_note_id');
            $table->foreignIdFor(Tag::class, 'tag_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patch_note_tags');
    }
};
