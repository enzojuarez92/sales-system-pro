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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('tax_condition_id')->constrained()->onDelete('restrict');

            $table->string('first_name', 100);
            $table->string('last_name', 100)->nullable(); 
            $table->string('identification_number')->unique()->nullable(); //CUIT o DNI 

            $table->string('email')->unique()->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();

            $table->boolean('is_customer')->default(true);
            $table->boolean('is_supplier')->default(false);

            $table->boolean('is_active')->default(true);
            $table->softDeletes();
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
