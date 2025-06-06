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
        Schema::dropIfExists('categorie_livre');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::create('categorie_livre', function (Blueprint $table) {
            $table->unsignedBigInteger('categorie_id');
            $table->unsignedBigInteger('livre_id');
            $table->foreign('categorie_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('livre_id')->references('id')->on('livres')->onDelete('cascade');
            $table->primary(['categorie_id', 'livre_id']);
        });
    }
};
