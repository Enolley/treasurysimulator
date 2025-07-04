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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('from_account_id')->constrained('accounts');
            $table->foreignId('to_account_id')->constrained('accounts');
            $table->decimal('amount', 15, 2);
            $table->decimal('converted_amount', 15, 2)->nullable();
            $table->string('note')->nullable();
            $table->string('status')->default('completed');
            $table->timestamp('scheduled_for')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
