<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up() {
    Schema::create('payments', function (Blueprint $table) {
      $table->id();
      $table->foreignId('sale_id')->constrained('sales')->cascadeOnDelete();
      $table->decimal('amount', 12,2);
      $table->string('method')->nullable(); // cash, mobile, bank, credit note
      $table->date('paid_at')->nullable();
      $table->foreignId('received_by')->nullable()->constrained('users');
      $table->text('notes')->nullable();
      $table->timestamps();
    });
  }
  public function down() {
    Schema::dropIfExists('payments');
  }
};
