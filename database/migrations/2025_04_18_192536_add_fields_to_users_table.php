<?php

use App\Role;
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
        Schema::table('users', function (Blueprint $table) {
            $table->string("lastname")->after("name");
            $table->string("phone_number")->after("lastname")->nullable();
            $table->string("profile_img_src")->after("phone_number")->nullable();
            $table->enum("rola", array_column(Role::cases(), 'value'))
                    ->default(Role::USER->value)
                    ->after("phone_number");
            $table->boolean("is_active")->default(1)->after('rola');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['lastname', 'phone_number', 'profile_img_src', 'rola', 'is_active']);
        });
    }
};
