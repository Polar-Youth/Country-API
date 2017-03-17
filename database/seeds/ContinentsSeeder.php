<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class ContinentsSeeder
 */
class ContinentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $continentData = [
            // ['code' => '', 'name' => ''],
            ['code' => 'AF', 'name' => 'Africa'],
            ['code' => 'AS', 'name' => 'Asia'],
            ['code' => 'EU', 'name' => 'Europe'],
            ['code' => 'NA', 'name' => 'North America'],
            ['code' => 'SA', 'name' => 'South America'],
            ['code' => 'OC', 'name' => 'Oceania'],
            ['code' => 'AN', 'name' => 'Antartica'],
        ];

        $table = DB::table('continents');
        $table->delete();
        $table->insert($continentData);
    }
}
