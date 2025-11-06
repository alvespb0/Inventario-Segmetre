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
        Schema::create('item_setor', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('setor_id');
            $table->unsignedBigInteger('item_id');
            $table->integer('qtd_estoque');
            $table->foreign('item_id')->references('id')->on('item')->onDelete('cascade');
            $table->foreign('setor_id')->references('id')->on('setor')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_setor');
    }
};
