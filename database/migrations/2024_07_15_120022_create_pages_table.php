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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('link_name')->nullable();
            $table->string('picture')->nullable();
            $table->bigInteger('parent')->nullable()->unsigned();
            $table->foreign('parent')->references('id')->on('pages')->onDelete('restrict');
            $table->integer('ord')->default(0);
            $table->boolean('first_menu')->default(0);
            $table->boolean('second_menu')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
