<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    public function definition(): array
    {
        $merk = $this->faker->randomElement(['Toyota', 'Honda', 'Mitsubishi', 'Daihatsu', 'Suzuki', 'Nissan']);
        
        // Menyesuaikan tipe dengan merk agar sedikit lebih realistis
        $tipe = match($merk) {
            'Toyota' => $this->faker->randomElement(['Avanza', 'Innova', 'Fortuner', 'Rush', 'Yaris']),
            'Honda' => $this->faker->randomElement(['Brio', 'HR-V', 'CR-V', 'Civic', 'City']),
            'Mitsubishi' => $this->faker->randomElement(['Xpander', 'Pajero Sport', 'Triton']),
            'Daihatsu' => $this->faker->randomElement(['Xenia', 'Terios', 'Ayla', 'Sigra']),
            'Suzuki' => $this->faker->randomElement(['Ertiga', 'XL7', 'Ignis']),
            default => 'Tipe ' . $this->faker->randomNumber(2),
        };

        return [
            'merk' => $merk,
            'tipe' => $tipe,
            'tahun' => $this->faker->numberBetween(2015, 2024),
            'kondisi' => $this->faker->randomElement(['Baru', 'Bekas']),
            'status' => $this->faker->randomElement(['Tersedia', 'Tersedia', 'Tersedia', 'Terjual']), // Diperbanyak status tersedia
            'nopol' => 'BG ' . $this->faker->numberBetween(1000, 9999) . ' ' . strtoupper($this->faker->lexify('??')),
            'no_rangka' => strtoupper($this->faker->bothify('MHK##############')),
            'no_mesin' => strtoupper($this->faker->bothify('1NZ#######')),
            'harga_beli' => $this->faker->numberBetween(100, 450) * 1000000, // Antara 100jt - 450jt
            'biaya_operasional' => $this->faker->numberBetween(1, 5) * 1000000,
        ];
    }
}