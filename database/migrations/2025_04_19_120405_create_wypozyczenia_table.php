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
        Schema::create('wypozyczenia', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained(table: "users", indexName: "wypozyczenia_users_id");
            $table->foreignId("copy_id")->constrained(table: "egzemplarze", indexName: "wypozyczenia_egzemplarze_id");
            $table->date("borrowed_at");
            $table->date("due_date");
            $table->date("returned_at");
            $table->boolean("przedluzono");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wypozyczenia');
    }
};
