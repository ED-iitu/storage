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
        Schema::create('warehouses', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->text('category_name')->nullable();
            $table->text('subcategory')->nullable();
            $table->text('code');
            $table->text('add_code')->nullable();
            $table->integer('quantity')->default(0);
            $table->string('measure')->nullable();
            $table->integer('purchase_price')->default(0);
            $table->integer('sell_price')->default(0);
            $table->integer('purchase_amount')->default(0);
            $table->integer('sell_amount')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warehouses');
    }
};
