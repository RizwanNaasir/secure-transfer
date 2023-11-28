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
        Schema::table('contract_statuses', function (Blueprint $table) {
            $table->string('buyer_status')->default('pending')->nullable();
            $table->string('seller_status')->default('pending')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contract_statuses', function (Blueprint $table) {
            //
        });
    }
};
