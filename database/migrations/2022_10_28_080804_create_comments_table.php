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
        Schema::create('comment', function (Blueprint $table) {
            $table->id();
            $table->string('mensaje', 200);
            $table->foreignId('idpost');
            $table->foreignId('idusuario');
            
            $table->timestamps();
            
            $table->foreign('idpost')->references('id')->on('post')->onDelete('cascade');
            $table->foreign('idusuario')->references('id')->on('usuario')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('comment');
    }
};
