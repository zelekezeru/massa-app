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
        Schema::create('nurseries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('location')->nullable();
            $table->date('plantationDate');
            $table->date('harvestDate')->nullable();
            $table->string('status')->default('planted');
            $table->foreignId('farm_id')->constrained('farms')->nullable();
            $table->foreignId('seed_id')->constrained('seeds');
            $table->foreignId('product_id')->constrained('products');
            $table->foreignId('company_id')->constrained('companies')->default(auth()->user()?->company_id);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nurseries');
    }
};
