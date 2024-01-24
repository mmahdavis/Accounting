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
        Schema::create('bank_checks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('account_id')->nullable()->constant('accounts')->NullOnDelete();
            $table->foreignId('bank_id')->nullable()->constant('banks')->NullOnDelete();
            $table->string('type');
            $table->integer('amount');
            $table->date('pey_date');
            $table->text('description')->nullable();
            $table->string('check_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bank_checks');
    }
};
