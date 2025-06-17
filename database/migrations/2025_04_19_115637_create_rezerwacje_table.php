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
        Schema::create('rezerwacje', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained(table: "users", indexName: "rezerwacje_user_id");
            $table->foreignId("ksiazka_id")->constrained(table: "ksiazki", indexName: "rezerwacje_ksiazki_id");
            $table->date("reserved_at");
            $table->date("cancelled_at")->nullable();
            $table->boolean("zrealizowano");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rezerwacje');
    }
};
