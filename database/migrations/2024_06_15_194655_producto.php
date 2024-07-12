<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('sabor')->nullable();
            $table->string('descripcion');
            $table->string('material');
            $table->decimal('capacidad', 10, 2);
            $table->integer('unidades');
            $table->string('tipoBebida');
            $table->string('marca');
            $table->integer('existencias');
            $table->decimal('precioCompra', 10, 2)->nullable();
            $table->decimal('precioVenta', 10, 2);
            $table->string('imagen');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
