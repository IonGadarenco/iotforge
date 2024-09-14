<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePosterTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poster_translations', function (Blueprint $table) {
            // mandatory fields
            $table->id();
            $table->string('locale')->index();
            $table->foreign('locale')->references('locale')->on('locale')->onDelete('restrict');

            // Foreign key to the main model
            $table->bigInteger('poster_id')->unsigned();
            $table->foreign('poster_id')->references('id')->on('posters')->onDelete('cascade');

            $table->unique(['poster_id', 'locale']);

            // Actual fields you want to translate
            $table->string('name')->nullable();
            $table->text('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('poster_translations');
    }
}
