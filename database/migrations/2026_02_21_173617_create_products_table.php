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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            // Relaciones
            $table->foreignId('category_id')->constrained('categories')->onDelete('restrict');
            $table->foreignId('tax_id')->constrained('taxes')->onDelete('restrict');

            // Datos del producto
            $table->string('name')->unique();
            $table->string('slug')->unique(); // Para URLs amigables en el front
            $table->text('description')->nullable();

            // Precios y Stock
            $table->decimal('cost_price', 12, 2)->default(0);
            $table->decimal('selling_price', 12, 2)->default(0);
            $table->integer('stock')->default(0);
            $table->integer('alert_quantity')->default(5);

            $table->boolean('is_active')->default(true);
            $table->string('image_path')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
