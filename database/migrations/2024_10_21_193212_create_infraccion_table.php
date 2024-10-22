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
        Schema::create('infraccion', function (Blueprint $table) {
            $table->id(); // id: int(11)
            $table->string('dni', 8); // dni: varchar(8)
            $table->dateTime('fecha'); // fecha: datetime
            $table->string('placa', 7); // placa: varchar(7)
            $table->string('infraccion', 200); // infraccion: varchar(200)
            $table->string('descripcion', 255); // descripcion: varchar(255)
            $table->timestamps(); // created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('infraccion');
    }
};
