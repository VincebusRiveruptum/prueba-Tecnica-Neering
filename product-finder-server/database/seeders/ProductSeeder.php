<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::factory()->create([
            'name' => 'Amplificador Freeman GA10',
            'sku' => 'ga10freeman1',
            'description' => 'Amplificador de Guitarra Freeman GA10 de 10 watts: - Potencia: 10 watts - Ecualizador de 2 bandas - Parlante de 6.5".',
            'price' => 60000,
            'stock' => 7,
            'available' => true,
        ]);

        Product::factory()->create([
            'name' => 'Amplificador Freeman GA15',
            'sku' => 'ga15freeman1',
            'description' => 'Amplificador de Guitarra Freeman GA15 de 15 watts: - Potencia: 15 watts - Ecualizador de 3 bandas - Parlante de 6.5".',
            'price' => 70000,
            'stock' => 12,
            'available' => true,
        ]);

        Product::factory()->create([
            'name' => 'Amplificador Marshall MG15',
            'sku' => 'mg15marshall1',
            'description' => 'Amplificador de Guitarra Marshall MG15 de 15 watts: - Potencia: 15 watts - Ecualizador de 3 bandas - Parlante de 8".',
            'price' => 120000,
            'stock' => 12,
            'available' => false,
        ]);

        Product::factory()->create([
            'name' => 'Amplificador Marshall MG25',
            'sku' => 'mg25marshall1',
            'description' => 'Amplificador de Guitarra Marshall MG25 de 25 watts: - Potencia: 25 watts - Ecualizador de 3 bandas - Reverb - Parlante de 10".',
            'price' => 180000,
            'stock' => 11,
            'available' => true,
        ]);

        Product::factory()->create([
            'name' => 'Amplificador Line 6 Spider IV 30',
            'sku' => 'iv30line61',
            'description' => 'Amplificador de Guitarra Spider IV 30 de 30 watts: - Potencia: 30 watts - Ecualizador de 3 bandas - Dos canales - Efectos digitales - Parlante de 12".',
            'price' => 150000,
            'stock' => 8,
            'available' => true,
        ]);

        Product::factory()->create([
            'name' => 'Cabezal Amplificador Laney LA 50',
            'sku' => 'la50laney1',
            'description' => 'Cabezal Amplificador de Guitarra Laney LA50 50 watts: - Potencia: 50 watts - Ecualizador de 3 bandas - Dos canales - Loop de Efectos',
            'price' => 300000,
            'stock' => 3,
            'available' => true,
        ]);

        Product::factory()->create([
            'name' => 'Cabezal Amplificador Laney Supergroup 60',
            'sku' => 'sp60laney1',
            'description' => 'Cabezal Amplificador de Guitarra a tubos Laney Supergroup 60 de watts: - Potencia: 60 watts - 2xEL34 en la salida y 3xECC83 en el preamplificador - Ecualizador de 3 bandas - Dos canales',
            'price' => 18000000,
            'stock' => 12,
            'available' => true,
        ]);

        Product::factory()->create([
            'name' => 'Amplificador Laney CUB 12',
            'sku' => 'cub12laney1',
            'description' => 'Amplificador de Guitarra a tubos Laney CUB 12 de 10 de watts: - Potencia: 10 watts - 2xEL84 en la salida y 2xECC83 en el preamplificador - Ecualizador de 3 bandas - Parlante de 12"',
            'price' => 180000,
            'stock' => 12,
            'available' => false,
        ]);
    }
}
