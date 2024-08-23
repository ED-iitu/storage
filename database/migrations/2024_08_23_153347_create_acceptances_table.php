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
        Schema::create('acceptances', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->text('code');
            $table->integer('quantity')->nullable();
            $table->string('remaining_quantity')->nullable();
            $table->integer('invoice_price')->nullable();
            $table->string('markup')->nullable();
            $table->integer('selling_price')->nullable();
            $table->integer('discount')->nullable();
            $table->integer('price_with_discount')->nullable();
            $table->integer('total')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acceptances');
    }
};
