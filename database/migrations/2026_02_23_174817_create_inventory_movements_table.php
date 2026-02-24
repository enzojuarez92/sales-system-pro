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
        Schema::create('inventory_movements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained();

            $table->decimal('quantity', 15, 2); // Ejemplo: 10.00 o -5.00
            $table->decimal('stock_before', 15, 2);
            $table->decimal('stock_after', 15, 2);

            // Esto es lo que lo hace polimórfico ✅
            $table->nullableMorphs('movable');

            $table->string('concept')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_movements');
    }
};
