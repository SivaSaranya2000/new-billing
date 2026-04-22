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
        Schema::create('sells', function (Blueprint $table) {
        $table->id();
        $table->foreignId('customer_id')->nullable();
        $table->string('sales_code');
        $table->date('sales_date');
        $table->string('reference_no')->nullable();

        $table->decimal('subtotal', 10, 2)->default(0);
        $table->decimal('other_charges', 10, 2)->default(0);
        $table->decimal('discount', 10, 2)->default(0);
        $table->decimal('grand_total', 10, 2)->default(0);

        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sells');
    }
};
