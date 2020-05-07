<?php

use Illuminate\Database\Seeder;

class QuizzesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('quizzes')->insert([
            [
               'title' => 'HTML & CSS',
               'description' => 'Test je kennis van HTML & CSS na periode 1'
            ],
            [
                'title' => 'Scrum',
                'description' => 'Wat weet je van Scrum?'
             ],
        ]);
    }
}
