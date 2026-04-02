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
        Schema::create('product_prices', function (Blueprint $table) {
         $table->id();
         $table->unsignedBigInteger('product_id');
         $table->decimal('mrp', 10, 2)->nullable();
         $table->decimal('unit_price', 10, 2)->nullable();
         $table->decimal('purchase_exc_tax', 10, 2)->nullable();
         $table->decimal('purchase_inc_tax', 10, 2)->nullable();
         $table->decimal('margin', 5, 2)->nullable();
         $table->decimal('sell_exc_price', 10, 2)->nullable();
         $table->decimal('sell_inc_price', 10, 2)->nullable();
         $table->decimal('tax_percentage', 5, 2)->nullable();
         $table->decimal('tax_amount', 5, 2)->nullable();
         $table->timestamps();

        // Foreign key
        $table->foreign('product_id')
              ->references('id')
              ->on('products')
              ->onDelete('cascade');
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_prices');
    }
};
