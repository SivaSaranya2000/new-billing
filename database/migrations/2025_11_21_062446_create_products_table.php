<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('sku')->nullable();
            $table->string('hsn_code')->nullable();
            $table->string('barcode_type')->nullable();

            $table->unsignedBigInteger('unit')->nullable();
            $table->unsignedBigInteger('brand')->nullable();
            $table->unsignedBigInteger('category')->nullable();
            $table->unsignedBigInteger('sub_category')->nullable();
            $table->unsignedBigInteger('business_location')->nullable();

            $table->integer('alert_quantity')->default(0);
            $table->boolean('manage_stock')->default(false);

            $table->string('product_type')->nullable();
            $table->string('tax_type')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
