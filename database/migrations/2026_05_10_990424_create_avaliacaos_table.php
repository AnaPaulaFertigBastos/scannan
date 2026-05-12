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
        Schema::create('avaliacoes', function (Blueprint $table) {

            $table->id();

            $table->integer('nota');

            $table->text('comentario')->nullable();

            $table->foreignId('usuario_id')
                  ->constrained('usuario')
                  ->onDelete('cascade');

            $table->foreignId('obra_id')
                  ->constrained('obras')
                  ->onDelete('cascade');

            //PARA NAO DAR DUPLICIDADE
            $table->unique(['usuario_id','obra_id']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('avaliacoes');
    }
};
