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
        Schema::create('invitations', function (Blueprint $table) {
            $table->id();
            $table->date('date_expiration');
            $table->enum('status', ['enattente', 'accepter', 'refuse'])->default('enattente');
            $table->string('token')->unique();//i have a problem in this line i don't know how to creat email or now i will creat token and send it to email 
            $table->foreignId('colocation_id')->constrained('colocations')->cascadeOnDelete();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invitations');
    }
};
