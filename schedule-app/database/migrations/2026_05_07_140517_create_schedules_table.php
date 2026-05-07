<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('schedules', function (Blueprint $table) {
        $table->id();
        $table->string('produto');
        $table->string('tamanho');
        $table->string('cor');
        $table->integer('quantidade');
        $table->string('customerName');
        $table->string('customerEmail');
        $table->string('customerPhone');
        $table->dateTime('scheduledDate');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};

