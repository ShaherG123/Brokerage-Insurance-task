<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $actions = ['call', 'visit', 'follow-up'];
        for ($i = 0; $i < count($actions); $i++) {
            DB::table('actions')->updateOrInsert([
                'name' => $actions[$i]
            ], [
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
