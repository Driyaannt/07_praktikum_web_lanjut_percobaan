<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mahasiswa>
 */
class MahasiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'Nim' => '0',
            'Nama' => fake()->name(),
            'Email' => fake()->unique()->safeEmail(),
            'Kelas' => '2H',
            'Jurusan' => 'Teknologi Informasi',
            'No_Handphone' => fake()->phoneNumber(),
            'tanggal_lahir' => fake()->date()
        ];
    }
}
