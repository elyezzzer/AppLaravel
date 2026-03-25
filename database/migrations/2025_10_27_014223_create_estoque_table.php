<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void{

         Schema::create('estoque', function (Blueprint $table) {
            $table->id();
            $table->foreignId('acessorio_id')->constrained()->cascadeOnDelete();
            $table->string('cor')->nullable();
            $table->integer('quantidade')->default(0);
            $table->decimal('preco', 10, 2);
            $table->timestamps();
            $table->unique(['acessorio_id','cor']);

        });
    }

    public function down(): void{
        Schema::dropIfExists('estoque');

    }
};
