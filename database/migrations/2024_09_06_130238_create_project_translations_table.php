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
        Schema::create('project_translations', function (Blueprint $table) {
            // mandatory fields
            $table->id('id');
            $table->string('locale')->index();
            $table->foreign('locale')->references('locale')->on('locale')->onDelete('restrict');

            // Foreign key to the main model
            $table->bigInteger('project_id')->unsigned();
            $table->unique(['project_id', 'locale']);
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');

            // Actual fields you want to translate
            $table->string('name')->nullable();
            $table->longText('content')->nullable();
            $table->longText('scope')->nullable();
            $table->longText(column: 'funder')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_translations');
    }
};
