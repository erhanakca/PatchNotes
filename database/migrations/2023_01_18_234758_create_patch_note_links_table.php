<?php

use App\Models\PatchNote;
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
        Schema::create('patch_note_links', function (Blueprint $table) {
            $table->id('patch_note_link_id')->autoIncrement();
            $table->foreignIdFor(PatchNote::class, 'patch_note_id');
            $table->string('link');
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
        Schema::dropIfExists('patch_note_links');
    }
};
