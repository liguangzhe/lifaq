<?php

use Illuminate\Database\Seeder;


class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = App\User::all();
        for ($i = 1; $i <= 6; $i++)
            $users->each(function ($user){
                $answer = App\Answer::inRandomOrder()->first();
                //$question = App\Question::inRandomOrder()->first();
                $comment = factory(\App\Comment::class)->make();
                $comment->user()->associate($user);
                $comment->answer()->associate($answer);
                //$comment->question()->associate($question);
                $comment->save();

            });
    }

}
