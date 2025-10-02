<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gastos', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo', ['fijo', 'dinamico']); // gasto fijo o dinámico
            $table->string('categoria'); // ejemplo: transporte, mercado, vivienda
            $table->decimal('monto', 12, 2); // valor del gasto
            $table->date('fecha'); // fecha en que se realizó
            $table->timestamps(); // created_at, updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gastos');
    }
};
