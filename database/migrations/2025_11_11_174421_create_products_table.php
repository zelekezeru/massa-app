<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('sku')->nullable()->index();
            $table->string('name');
            $table->string('unit')->default('kg'); // kg, pcs, bunch etc.
            $table->decimal('base_price', 12, 2)->default(0); // default price
            $table->integer('stock')->default(0);
            $table->foreignId('sales_location_id')->nullable()->constrained('sales_locations');
            $table->foreignId('company_id')->constrained('companies');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }
    public function down() {
        Schema::dropIfExists('products');
    }
};
