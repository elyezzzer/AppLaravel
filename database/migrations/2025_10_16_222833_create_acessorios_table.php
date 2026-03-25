<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void{

        Schema::create('acessorios', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();
            $table->string('descricao');
            $table->string('cor')->nullable();
            $table->integer('estoque_minimo')->default(0);
            $table->decimal('preco', 10, 2)->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void{
        Schema::dropIfExists('acessorios');

    }
};
