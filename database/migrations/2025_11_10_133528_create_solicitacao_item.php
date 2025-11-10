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
        Schema::create('solicitacao_item', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('setor_id');
            $table->unsignedBigInteger('item_id');
            $table->integer('quantidade');
            $table->enum('status', ['pendente', 'negado', 'aprovado_andamento', 'aprovado_finalizado'])->default('pendente');
            $table->date('data_solicitacao');
            $table->text('observacao')->nullable();
            $table->foreign('setor_id')->references('id')->on('setor')->onDelete('cascade');
            $table->foreign('item_id')->references('id')->on('item')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitacao_item');
    }
};
