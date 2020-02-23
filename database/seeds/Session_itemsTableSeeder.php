<?php

use Illuminate\Database\Seeder;

class Session_itemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('session_items')->insert([
            'session_date' => '2020/02/28',
            'session_category' => '練習試合',
            'session_minutes' => '120'
            'session_rpe' => '8',
            'remarks' => '特になし',
            'session_work' => $request->session_minutes* $request->session_rpe,
            'team_id' => $request->user_id->team_id,
            ])
    }
}
