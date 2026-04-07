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
     Schema::create('purchase_items', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('purchase_id');
    $table->unsignedBigInteger('product_id');
    $table->integer('qty')->default(0);
    $table->decimal('mrp', 10, 2)->default(0);
    $table->decimal('purchase_exc_tax', 10, 2)->default(0);
    $table->decimal('purchase_inc_tax', 10, 2)->default(0);
    $table->decimal('tax_amount', 10, 2)->default(0);
    $table->decimal('unit_price', 10, 2)->default(0);
    $table->decimal('price', 10, 2)->default(0);
    $table->timestamps();

    $table->foreign('purchase_id')->references('id')->on('purchases')->onDelete('cascade');
   });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_items');
    }
};
