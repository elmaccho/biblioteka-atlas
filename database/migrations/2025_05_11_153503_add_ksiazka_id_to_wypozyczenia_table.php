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
        Schema::table('wypozyczenia', function (Blueprint $table) {
            $table->foreignId("ksiazka_id")->after('user_id')->constrained(table: "ksiazki", indexName: "wypozyczenia_ksiazka_id");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('wypozyczenia', function (Blueprint $table) {
            $table->dropForeign('wypozyczenia_ksiazka_id'); 
            $table->dropColumn('ksiazka_id');
        });
    }
};
