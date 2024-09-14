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
        Schema::create('partner_translations', function (Blueprint $table) {
             // mandatory fields
             $table->id('id');
             $table->string('locale')->index();
             $table->foreign('locale')->references('locale')->on('locale')->onDelete('restrict');

             // Foreign key to the main model
             $table->bigInteger('partner_id')->unsigned();
             $table->unique(['partner_id', 'locale']);
             $table->foreign('partner_id')->references('id')->on('partners')->onDelete('cascade');

             // Actual fields you want to translate
             $table->string('name')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partner_translations');
    }
};
