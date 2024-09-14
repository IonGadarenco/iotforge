<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('person_translations', function (Blueprint $table) {
            $table->id('id');
            $table->string('locale')->index();
            $table->foreign('locale')->references('locale')->on('locale')->onDelete('restrict');

            // Foreign key to the main model
            $table->bigInteger('person_id')->unsigned();
            $table->unique(['person_id', 'locale']);
            $table->foreign('person_id')->references('id')->on('persons')->onDelete('cascade');

            // Actual fields you want to translate
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->text('content')->nullable();
            $table->string('position')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('person_translations');
    }
};
