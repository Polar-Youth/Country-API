<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class ThreadStatusSeed
 */
class ThreadStatusSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            // ['name' => ''],
            ['name' => 'open'],
            ['name' => 'solved'],
            ['name' => 'closed'],
        ];

        $table = DB::table('thread_statuses');
        $table->delete();
        $table->insert($data);
    }
}
