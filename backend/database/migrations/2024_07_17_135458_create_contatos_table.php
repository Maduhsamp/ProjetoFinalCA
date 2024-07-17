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
        Schema::create('contatos', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('funil_id');
            $table->unsignedBigInteger('etapa_id');
            $table->string('phone_number');
            $table->string('email');
            $table->string('cpf');
            $table->date('birth_date');
            $table->string('address');
            $table->decimal('value');
            $table->timestamps();

            $table->foreign('funil_id')->references('id')->on('funils')->onDelete('cascade');
            $table->foreign('etapa_id')->references('id')->on('etapas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contatos');
    }
};
