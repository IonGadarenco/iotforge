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
        Schema::create('route_access_counts', function (Blueprint $table) {
            $table->id();
            $table->string('route_name')->unique(); // To store the route name
            $table->unsignedBigInteger('access_count')->default(0); // To store the access count
            $table->unsignedInteger('daily_access_count')->default(0);
            $table->date('last_access_date')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('route_access_counts');
    }
};
