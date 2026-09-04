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
        if (!Schema::hasTable('products')) {
            Schema::create('products', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('category'); // brownies, cookies, hampers, cake, pudding
                $table->text('description')->nullable();
                $table->decimal('price', 12, 2)->default(0);
                $table->string('price_unit')->default('/pcs');
                $table->string('badge')->nullable(); // Best Seller, Favorit, Spesial, Gift, etc.
                $table->string('image')->nullable();
                $table->boolean('is_active')->default(true);
                $table->integer('sort_order')->default(0);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
