<?php

namespace Database\Factories;

use App\Models\Curp; 
use Illuminate\Database\Eloquent\Factories\Factory;

class CurpFactory extends Factory
{
    protected $model = Curp::class;

    public function definition()
    {
        return [
            'curp' => strtoupper($this->faker->unique()->regexify('[A-Z0-9]{18}')),
            'nombre' => $this->faker->firstName,
            'apellido_paterno' => $this->faker->lastName,
            'apellido_materno' => $this->faker->lastName,
            'fecha_nacimiento' => $this->faker->date('Y-m-d', '2000-01-01'),
            'sexo' => $this->faker->randomElement(['M', 'F']),
            'entidad' => $this->faker->state,
        ];
    }
}

