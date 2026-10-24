<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('nombre_usuario')->nullable()->unique()->after('name');
            $table->string('rol')->default('Atencion')->after('password');
            $table->string('estado')->default('Activo')->after('rol');

            // El login ya no usa correo, así que lo dejamos opcional
            $table->string('email')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['nombre_usuario', 'rol', 'estado']);
        });
    }
};