<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void{

        Schema::create('historico', function (Blueprint $table) {
            $table->id();
            $table->foreignId('acessorio_id')->constrained()->cascadeOnDelete();
            $table->string('cor');
            $table->foreignId('obra_id')->nullable()->constrained()->nullOnDelete();
            $table->enum('tipo',['entrada','saida']);
            $table->integer('quantidade');
            $table->timestamps();

        });
    }

    public function down(): void{
        Schema::dropIfExists('historico');
        
    }
};
