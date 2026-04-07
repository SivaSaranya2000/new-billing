<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('supplier_id');
            $table->date('purchase_date');
            $table->string('purchase_invoice_no');
            $table->decimal('shipping_charges', 10, 2)->default(0);
            $table->decimal('paid_amount', 10, 2)->default(0);
            $table->string('payment_mode')->nullable();

            $table->decimal('round_off', 10, 2)->default(0);
            $table->decimal('discount', 10, 2)->default(0);
            $table->decimal('total_amount', 12, 2)->default(0);

            $table->timestamps();
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};

