<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up() {
    Schema::create('commissions', function (Blueprint $table) {
      $table->id();
      $table->foreignId('sale_id')->constrained('sales')->cascadeOnDelete();
      $table->foreignId('sales_agent_id')->constrained('users');
      $table->decimal('rate', 5,2)->default(0); // percent
      $table->decimal('amount', 12,2)->default(0);
      $table->boolean('paid')->default(false);
            $table->foreignId('company_id')->constrained('companies')->default(auth()->user()?->company_id);
      $table->timestamps();
    });
  }
  public function down() {
    Schema::dropIfExists('commissions');
  }
};

