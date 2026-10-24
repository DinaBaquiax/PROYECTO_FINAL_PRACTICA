<?php

namespace Database\Seeders;

use App\Models\Producto;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(UsuarioSeeder::class);

        Producto::insert([
            ['codigo' => 'TEL-01', 'nombre' => 'Samsung Galaxy A14', 'categoria' => 'Teléfono',  'precio_compra' => 1200, 'precio_venta' => 1500, 'fecha_registro' => '2026-08-02', 'stock' => 5],
            ['codigo' => 'ACC-01', 'nombre' => 'Cargador tipo C',    'categoria' => 'Accesorio', 'precio_compra' => 40,   'precio_venta' => 75,   'fecha_registro' => '2026-08-02', 'stock' => 20],
            ['codigo' => 'REP-01', 'nombre' => 'Batería Samsung A14','categoria' => 'Repuesto',  'precio_compra' => 60,   'precio_venta' => 120,  'fecha_registro' => '2026-05-01', 'stock' => 8],
        ]);
    }
}