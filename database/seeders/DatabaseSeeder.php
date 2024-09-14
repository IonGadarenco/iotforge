<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    private $tables = array(
        'roles',
        'permissions',


    );
    public function run(): void
    {
        Model::unguard();
        $this->cleanDatabase();
        \Database\Seeders\AdminsTableSeeder::run();
        User::factory(10)->hasDevices(3)->create();

        // User::create([
        //     "Name" => "ion"
        // ]);
    }
    public function cleanDatabase()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        foreach ($this->tables as $table) {
            DB::table($table)->truncate();
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
