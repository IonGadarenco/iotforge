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
        Schema::create('source_translations', function (Blueprint $table) {
            $table->id('id');
            $table->string('locale')->index();
            $table->foreign('locale')->references('locale')->on('locale')->onDelete('restrict');

            // Foreign key to the main model
            $table->bigInteger('source_id')->unsigned();
            $table->unique(['source_id', 'locale']);
            $table->foreign('source_id')->references('id')->on('sources')->onDelete('cascade');

            // Actual fields you want to translate
            $table->string('name')->nullable();
            $table->string('content')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('source_translations');
    }
};
