<?php

namespace Database\Factories;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Payment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'invoice_id' => $this->faker->text,
            'user_id' => User::factory(),
            'type' => $this->faker->randomElement(['paypal','card','wallet','vf cash','orange cash','etisalat cash']),
            'price' => 10.2,
            'minutes' => 100,
            'status' => $this->faker->randomElement(['pending','accepted','cancelled']),
        ];
    }
}
