<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsuarioSeeder extends Seeder
{
    public function run(): void
    {
        $usuarios = [
            ['name' => 'José Tzunún',   'nombre_usuario' => 'encargado',  'rol' => 'Encargado', 'estado' => 'Activo'],
            ['name' => 'Luis Estrada',   'nombre_usuario' => 'atencion',   'rol' => 'Atencion',  'estado' => 'Activo'],
            ['name' => 'Carlos Ramírez', 'nombre_usuario' => 'tecnico',    'rol' => 'Tecnico',   'estado' => 'Activo'],
            ['name' => 'Rocío Marín',    'nombre_usuario' => 'rociomarin', 'rol' => 'Atencion',  'estado' => 'Inactivo'],
        ];

        foreach ($usuarios as $datos) {
            $datos['password'] = '12345'; // Laravel la cifra sola
            User::updateOrCreate(['nombre_usuario' => $datos['nombre_usuario']], $datos);
        }
    }
}