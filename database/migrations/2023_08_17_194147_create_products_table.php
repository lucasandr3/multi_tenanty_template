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
            $table->unsignedBigInteger('tenant_id');
            $table->unsignedBigInteger('supplier_id');
            $table->unsignedBigInteger('process_id');
            $table->longText('name');
            $table->string('url');
            $table->longText('description');
            $table->float('price');
            $table->string('unit');
            $table->unsignedBigInteger('brand_id');
            $table->unsignedBigInteger('model_id');
            $table->timestamps();

            $table->foreign('tenant_id')->references('id')->on('tenants');
            $table->foreign('supplier_id')->references('id')->on('suppliers');
            $table->foreign('process_id')->references('id')->on('process');
            $table->foreign('brand_id')->references('id')->on('brands');
            $table->foreign('model_id')->references('id')->on('models');
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
