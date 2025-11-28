<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_no')->unique();
            $table->foreignId('customer_id')->constrained();
            $table->foreignId('sales_agent_id')->nullable()->constrained('users');
            $table->enum('status', ['draft','confirmed','paid','partially_paid','cancelled'])->default('draft');
            $table->date('invoice_date')->nullable();
            $table->decimal('sub_total', 12,2)->default(0);
            $table->decimal('discount', 12,2)->default(0);
            $table->decimal('tax', 12,2)->default(0);
            $table->decimal('total', 12,2)->default(0);
            $table->decimal('balance_due', 12,2)->default(0);
            $table->text('notes')->nullable();
            $table->foreignId('company_id')->constrained('companies')->default(auth()->user()?->company_id);
            $table->timestamps();
        });
    }
    public function down() {
        Schema::dropIfExists('sales');
    }
};
