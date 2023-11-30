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
        Schema::create('jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('queue')->index(); // On a le nom de file d'attente
            $table->longText('payload'); // On a les données qui corresponde à notre tâche a effectuer
            $table->unsignedTinyInteger('attempts'); // permet de relancer une tâche si elle echoue
            $table->unsignedInteger('reserved_at')->nullable(); // permet de bloquer la tâche si elle est en train d'être utiliser
            $table->unsignedInteger('available_at');
            $table->unsignedInteger('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
