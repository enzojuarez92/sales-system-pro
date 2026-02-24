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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contact_id')->constrained('contacts');
            $table->foreignId('user_id')->constrained('users');

            // Datos de AFIP
            $table->integer('pos_number');       // Ej: 1
            $table->bigInteger('number');        // Ej: 123
            $table->string('type', 2);           // A, B, C, M
            $table->integer('cbte_tipo');        // Código AFIP (1, 6, 11...)

            // Datos de la Operación
            $table->date('date');
            $table->decimal('total_amount', 15, 2);
            $table->enum('status', ['pending', 'paid', 'cancelled'])->default('paid');

            // Resultados de la autorización
            $table->string('cae', 20)->nullable();
            $table->date('cae_expiration')->nullable();

            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
