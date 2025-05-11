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
            $table->dropForeign('wypozyczenia_egzemplarze_id'); 
            $table->dropColumn('copy_id'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('wypozyczenia', function (Blueprint $table) {
            $table->foreignId("copy_id")->constrained(table: "egzemplarze", indexName: "wypozyczenia_egzemplarze_id");
        });
    }
};
