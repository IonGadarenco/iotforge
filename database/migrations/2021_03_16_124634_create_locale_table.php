<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocaleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locale', function (Blueprint $table) {
            $table->id();
            $table->string('locale')->unique()->index();
            $table->string('language');
            $table->timestamps();
        });

        DB::table('locale')->insert(['locale' => 'en','language' => 'English']);
        DB::table('locale')->insert(['locale' => 'ro','language' => 'Română']);
        DB::table('locale')->insert(['locale' => 'ru','language' => 'Russian']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('locale');
    }
}
