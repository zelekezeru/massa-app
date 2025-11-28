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
        Schema::create('trays', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('type')->nullable();
            $table->string('productionDate')->nullable();
            $table->integer('capacity')->default(0);
            $table->foreignId('company_id')->constrained('companies')->default(auth()->user()?->company_id);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trays');
    }
};
