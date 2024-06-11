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
            Schema::create('contracts', function (Blueprint $table) {
                $table->id('contractId');
                $table->unsignedBigInteger('carId');
                $table->unsignedBigInteger('userId');
                $table->date('dateDeput');
                $table->date('dateFin');
                $table->decimal('montant');
                $table->timestamps();

                $table->foreign('carId')->references('id')->on('cars');
                $table->foreign('userId')->references('id')->on('users');
            });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
