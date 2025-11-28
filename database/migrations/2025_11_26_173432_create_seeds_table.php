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
        Schema::create('seeds', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('variety')->nullable();
            $table->text('description')->nullable();
            $table->date('productionDate')->nullable();
            $table->date('expireDate')->nullable();
            $table->foreignId('farm_id')->constrained('farms')->nullable();
            $table->foreignId('crop_id')->constrained('crops');
            $table->foreignId('supplier_id')->constrained('suppliers');
            $table->foreignId('company_id')->constrained('companies')->default(auth()->user()?->company_id);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seeds');
    }
};
