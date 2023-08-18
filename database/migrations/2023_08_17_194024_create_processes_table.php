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
        Schema::create('process', function (Blueprint $table) {
            $table->integer('id');
            $table->unsignedBigInteger('tenant_id');
            $table->id('cod_external');
            $table->string('number');
            $table->string('process');
            $table->longText('object');
            $table->string('year');
            $table->integer('type_process');
            $table->integer('modality');
            $table->timestamps();

            $table->foreign('tenant_id')->references('id')->on('tenants');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('process');
    }
};
