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
        Schema::create('joins', function (Blueprint $table) {
            $table->id();
            $table->date('joined_at')->usecurrent();
            $table->date('left_at')->nullable();
            $table->enum('role', ['member', 'owner'])->default('member');
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('colocation_id')->constrained('colocations')->cascadeOnDelete();
            $table->unique(['user_id', 'colocation_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('joins');
    }
};
