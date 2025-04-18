<?php

use App\StatusEgzemp;
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
        Schema::create('egzemplarze', function (Blueprint $table) {
            $table->id();
            $table->foreignId("ksiazka_id")->constrained(table: 'ksiazki', indexName: 'id');
            $table->enum("status", array_column(StatusEgzemp::cases(), 'value'))
                    ->default(StatusEgzemp::DOSTEPNY);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('egzemplarze');
    }
};
