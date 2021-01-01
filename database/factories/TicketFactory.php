<?php

namespace Database\Factories;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ticket::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        if(\App\Models\Category::count() != 0 && \App\Models\Priority::count() != 0 && \App\Models\Status::count() != 0 && \App\Models\User::count() != 0 ){
            $user_id = random_int(1, \App\Models\User::count());
            $priority_id = random_int(1, \App\Models\Priority::count());
            $category_id = random_int(1, \App\Models\Category::count());
            $status_id = random_int(1, \App\Models\Status::count());
        
            $completed_at = (\App\Models\Status::find($status_id)->name == "Closed" ? now() : null);
            return [
                'subject'       => $this->faker->sentence,
                'content'       => $this->faker->paragraph,
                'user_id'       =>  $user_id,
                'priority_id'   =>  $priority_id,
                'category_id'   =>  $category_id,
                'status_id'     =>  $status_id,
                'completed_at'  =>  $completed_at
            ];
        }
    }
}
