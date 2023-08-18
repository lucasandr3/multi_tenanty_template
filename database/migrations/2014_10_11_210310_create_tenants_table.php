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
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('plan_id')->nullable(); // plano
            $table->uuid();
            $table->string('document')->unique();
            $table->string('name')->unique();
            $table->string('fantasy')->unique();
            $table->string('url')->unique();
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('mobile')->nullable();
            $table->string('logo')->nullable();

            // status do tenant
            $table->tinyInteger('bol_active',)->default(0);

            //subscription
            $table->date('subscription')->nullable(); // data que se inscrevey
            $table->date('expires_at')->nullable(); // data que expira o acesso
            $table->string('subscription_id', 255)->nullable(); // indentificador do gateway de pagamento
            $table->boolean('subscription_active')->default(false); // assinatura ativa
            $table->boolean('subscription_suspended')->default(false); // assinatuda cancelada

            $table->timestamps();

            $table->foreign('plan_id')->references('id')->on('plans');
        });

        Schema::create('tenants_addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tenant_id');
            $table->string('zipcode');
            $table->string('street');
            $table->string('city');
            $table->string('uf');
            $table->string('neighborhood');
            $table->string('number');
            $table->string('complement')->nullable();
            $table->timestamps();

            $table->foreign('tenant_id')->references('id')->on('tenants');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenants_addresses');
        Schema::dropIfExists('tenants');
    }
};
