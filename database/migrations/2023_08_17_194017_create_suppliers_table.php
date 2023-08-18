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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tenant_id');
            $table->string('cod_external');
            $table->string('name');
            $table->string('fantasy');
            $table->string('email');
            $table->string('document');
            $table->string('phone');
            $table->string('mobilePhone')->nullable();
            $table->string('logo')->default('default.png');
            $table->tinyInteger('bol_active')->default(0);
            $table->timestamps();

            $table->foreign('tenant_id')->references('id')->on('tenants');
        });

        Schema::create('suppliers_address', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('supplier_id');
            $table->string('zipcode');
            $table->string('street');
            $table->integer('city_id');
            $table->string('neigborhood');
            $table->string('number');
            $table->string('complement')->nullable();
            $table->string('reference')->nullable();
            $table->timestamps();

            $table->foreign('supplier_id')->references('id')->on('suppliers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers_address');
        Schema::dropIfExists('suppliers');
    }
};
