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
        Schema::create('tagihan_mitras', function (Blueprint $table) {
            $table->id();
            $table->string('id_tagmit')->unique();
            $table->string('id_mitra');
            $table->string('invoice')->nullable();
            $table->string('total')->nullable();
            $table->string('status')->default('0')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tagihan_mitras');
    }
};