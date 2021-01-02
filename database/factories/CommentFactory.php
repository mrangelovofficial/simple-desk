<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        if(\App\Models\User::count() != 0 && \App\Models\Ticket::count() != 0 ){
            $user_id = random_int(1, \App\Models\User::count());
            $ticket_id = random_int(1, \App\Models\Ticket::count());
        
            return [
                'content'       => $this->faker->paragraph,
                'user_id'       =>  $user_id,
                'ticket_id'       =>  $ticket_id,
            ];
        }
    }
}
