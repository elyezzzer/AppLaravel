<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void{

        Schema::create('obras', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('cidade')->nullable();
            $table->string('bairro')->nullable();
            $table->string('rua')->nullable();
            $table->string('numero')->nullable();
            $table->string('telefone')->nullable();
            $table->date('data_inicio')->nullable();
            $table->boolean('ativo')->default(true);
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['nome', 'deleted_at']);
        });
    }

    public function down(): void{
        Schema::dropIfExists('obras');

    }
};
