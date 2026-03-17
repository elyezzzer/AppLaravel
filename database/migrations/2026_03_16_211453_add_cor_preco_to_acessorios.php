<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('acessorios', function (Blueprint $table) {
            $table->enum('cor',['branco','preto','natural','todas'])->after('descricao');
            $table->decimal('preco',10,2)->after('cor');
        });
    }

    public function down(): void
    {
        Schema::table('acessorios', function (Blueprint $table) {
            $table->dropColumn(['cor','preco']);
        });
    }
};
