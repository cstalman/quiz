<?php

use Illuminate\Database\Seeder;

class AnswersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('answers')->insert([
            [
                'question_id' => 3,
                'text' => 'Hyperlinks and Text Markup Language',
                'score' => 1,
                'correct' => 0
            ],
            [
                'question_id' => 3,
                'text' => 'Hyper Text Markup Language',
                'score' => 1,
                'correct' => 1
            ],[
                'question_id' => 3,
                'text' => 'Hyper Trend Makeup Language',
                'score' => 1,
                'correct' => 0
            ],
            [
                'question_id' => 3,
                'text' => 'Homepage Tool Making Language',
                'score' => 1,
                'correct' => 0
            ]
    
        ]);
    }
}
