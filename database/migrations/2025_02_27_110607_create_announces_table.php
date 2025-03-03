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
        Schema::create('announces', function (Blueprint $table) {
            $table->id();
            $table->string('date_debut');
            $table->string('date_arriver');
            $table->string('heure_debut');
            $table->string('heure_arriver');
            $table->enum('status', ['panding', 'fin']);
            $table->unsignedBigInteger('societe_id'); // Declare foreign key column
            $table->foreign('societe_id')->references('id')->on('societes')->onDelete('cascade'); // Fix table name
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('announces');
    }
};
