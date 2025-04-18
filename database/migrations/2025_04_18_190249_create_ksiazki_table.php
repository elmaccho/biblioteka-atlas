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
        Schema::create('ksiazki', function (Blueprint $table) {
            $table->id();
            $table->string("tytul")->unique();
            $table->string("opis");
            $table->foreignId("kategoria_id")->constrained(table: 'kategorie', indexName: "ksiazki_kategoria_id");
            $table->foreignId("autor_id")->constrained(table: 'autorzy', indexName: "ksiazki_autor_id");
            $table->boolean("is_blocked");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ksiazki');
    }
};
