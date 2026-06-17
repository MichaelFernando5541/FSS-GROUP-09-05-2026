<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    public function definition(): array
    {
        return [
            // Membuat nama orang acak (format Indonesia jika locale di .env sudah 'id')
            'nama' => $this->faker->name(),
            
            // Membuat nomor telepon acak berawalan 08 (contoh: 081234567890)
            'telepon' => $this->faker->numerify('08##########'),
            
            // Membuat alamat lengkap acak
            'alamat' => $this->faker->address(),
        ];
    }
}