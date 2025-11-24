<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('contact_person')->nullable();
            $table->string('phone')->nullable()->index();
            $table->string('email')->nullable();
            $table->text('address')->nullable();
            $table->enum('type', ['retail','wholesale','hotel','other'])->default('retail');
            $table->decimal('credit_limit', 12,2)->default(0);
            $table->foreignId('sales_location_id')->nullable()->constrained('sales_locations');
            $table->timestamps();
        });
    }
    public function down() {
        Schema::dropIfExists('customers');
    }
};

