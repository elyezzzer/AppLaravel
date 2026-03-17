<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('obras', function (Blueprint $table) {

        $table->string('cidade')->nullable()->after('nome');
        $table->string('bairro')->nullable();
        $table->string('rua')->nullable();
        $table->string('numero')->nullable();

        $table->string('telefone')->nullable();

        $table->date('data_inicio')->nullable();

    });
}

public function down()
{
    Schema::table('obras', function (Blueprint $table) {

        $table->dropColumn([
            'cidade',
            'bairro',
            'rua',
            'numero',
            'telefone',
            'data_inicio'
        ]);

    });
}
};
