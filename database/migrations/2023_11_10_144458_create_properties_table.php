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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('description');
            $table->integer('surface');
            $table->integer('rooms'); // nombre de pièce
            $table->integer('bedrooms'); // nombre de chambre
            $table->integer('floor'); // l'etage
            $table->integer('price'); // le prix de la maison
            $table->string('city'); // la ville
            $table->string('address');
            $table->string('postal_code');
            $table->boolean('sold'); // pour savoir si le bien a été vendu
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
