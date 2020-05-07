<?php

use Illuminate\Database\Seeder;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('questions')->insert([
            [
                'quiz_id' => 1,
                'text' => 'Waar staat de afkorting HTML voor?',
                'display_order' => 1
            ],
            [
                'quiz_id' => 1,
                'text' => 'Welk HTML element geeft de grootste koptekst?',
                'display_order' => 2
            ]

        ]);
    }
}
