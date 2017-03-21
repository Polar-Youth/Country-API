<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class SupportCategorySeeder
 */
class SupportCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            // ['module' => '', 'name' => '', 'description' => ''],
            ['module' => 'support', 'name' => 'Converstation', 'description' => 'Indicate conversations.'],
            ['module' => 'support', 'name' => 'Implementations', 'description' => 'Indicate issues about implementations'],
            ['module' => 'support', 'name' => 'Question', 'description' => 'Indicate questions'],
        ];

        $table = DB::table('categories');
        $table->delete();
        $table->insert($data);
    }
}
