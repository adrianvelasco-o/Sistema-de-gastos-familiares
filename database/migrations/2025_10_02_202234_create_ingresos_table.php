<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ingresos', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo', ['fijo', 'adicional']); // tipo de ingreso
            $table->decimal('monto', 12, 2); // valor del ingreso
            $table->date('fecha'); // fecha en que se recibió
            $table->timestamps(); // created_at, updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ingresos');
    }
};
