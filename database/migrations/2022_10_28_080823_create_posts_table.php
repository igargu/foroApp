<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('post', function (Blueprint $table) {
            $table->id();
            $table->string('titulo', 100);
            $table->string('mensaje', 200);
            $table->foreignId('idusuario');
            $table->foreignId('idcategoria');
            
            $table->timestamps();
            
            $table->foreign('idusuario')->references('id')->on('usuario')->onDelete('cascade');
            $table->foreign('idcategoria')->references('id')->on('categoria')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('post');
    }
};
