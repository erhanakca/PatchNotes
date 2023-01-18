<?php

use App\Http\Controllers\BugController;
use App\Http\Controllers\InnovationController;
use App\Http\Controllers\TagController;
use App\Models\Bug;
use App\Models\Innovation;
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
        Schema::create('patch_notes', function (Blueprint $table) {
            $table->id('patch_note_id')->autoIncrement();
            $table->foreignIdFor(Bug::class, 'bug_id');
            $table->foreignIdFor(Innovation::class, 'innovation_id');
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
        Schema::dropIfExists('patch_notes');
    }
};
