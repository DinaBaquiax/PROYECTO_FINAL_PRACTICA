<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('producto', function (Blueprint $t) {
            $t->id('id_producto');
            $t->string('codigo', 30)->unique();
            $t->string('nombre', 100);
            $t->string('categoria', 50);
            $t->decimal('precio_compra', 10, 2);
            $t->decimal('precio_venta', 10, 2);
            $t->string('estado', 20)->default('Activo');
            $t->date('fecha_registro');
            $t->integer('stock')->default(0);
        });

        Schema::create('precio_servicio', function (Blueprint $t) {
            $t->id('id_precio');
            $t->string('tipo_servicio', 100);
            $t->string('modelo_equipo', 100);
            $t->decimal('precio', 10, 2);
            $t->string('estado', 20)->default('Activo');
        });

        Schema::create('reparacion', function (Blueprint $t) {
            $t->id('id_orden');
            $t->foreignId('id_usuario')->constrained('users');
            $t->string('nombre_cliente', 100);
            $t->string('telefono_cliente', 20);
            $t->string('dpi', 13)->nullable();
            $t->string('modelo_equipo', 100);
            $t->string('falla_reportada');
            $t->decimal('costo_estimado', 10, 2);
            $t->decimal('costo_final', 10, 2)->nullable();
            $t->string('estado', 20)->default('Pendiente');
            $t->date('fecha_ingreso');
            $t->date('fecha_entrega')->nullable();
        });

        Schema::create('detalle_reparacion', function (Blueprint $t) {
            $t->id('id_detalle_reparacion');
            $t->foreignId('id_orden')->constrained('reparacion', 'id_orden')->cascadeOnDelete();
            $t->foreignId('id_precio')->constrained('precio_servicio', 'id_precio');
            $t->decimal('precio_aplicado', 10, 2);
        });

        Schema::create('repuesto_usados', function (Blueprint $t) {
            $t->id('id_repuesto');
            $t->string('descripcion', 100);
            $t->decimal('cantidad', 10, 2);
            $t->decimal('costo_unitario', 10, 2);
            $t->decimal('precio_cobrado', 10, 2);
            $t->foreignId('id_orden')->constrained('reparacion', 'id_orden')->cascadeOnDelete();
        });

        Schema::create('venta', function (Blueprint $t) {
            $t->id('id_venta');
            $t->foreignId('id_usuario')->constrained('users');
            $t->date('fecha_venta');
            $t->string('metodo_pago', 30);
            $t->decimal('monto_total', 10, 2);
        });

        Schema::create('detalle_venta', function (Blueprint $t) {
            $t->foreignId('id_venta')->constrained('venta', 'id_venta')->cascadeOnDelete();
            $t->foreignId('id_producto')->constrained('producto', 'id_producto');
            $t->integer('cantidad');
            $t->decimal('precio_unitario', 10, 2);
            $t->primary(['id_venta', 'id_producto']);
        });
    }

    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        foreach (['detalle_venta', 'venta', 'repuesto_usados', 'detalle_reparacion', 'reparacion', 'precio_servicio', 'producto'] as $tabla) {
            Schema::dropIfExists($tabla);
        }
        Schema::enableForeignKeyConstraints();
    }
};