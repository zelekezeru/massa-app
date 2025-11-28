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
        Schema::create('nursery_tray', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nursery_id')->constrained('nurseries')->onDelete('cascade');
            $table->foreignId('tray_id')->constrained('trays')->onDelete('cascade');
            $table->integer('quantity')->default(0);
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nursery_tray');
    }
};
