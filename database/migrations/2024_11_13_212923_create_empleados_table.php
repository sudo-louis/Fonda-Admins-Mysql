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
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();
            $table->string('foto', 255);
            $table->string('nombre', 100);
            $table->string('apellido', 100);
            $table->string('email')->unique();
            $table->string('telefono', 15)->nullable();
            $table->string('direccion', 255)->nullable();
            $table->decimal('salario', 10, 2)->nullable();
            $table->date('fecha_contratacion')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};
