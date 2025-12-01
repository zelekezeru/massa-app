<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up() {
    Schema::create('sales_locations', function (Blueprint $table){
      $table->id();
      $table->string('name');
      $table->string('address')->nullable();
      $table->string('city')->nullable();
      $table->string('state')->nullable();
      $table->string('gps_location')->nullable();
      $table->foreignId('company_id')->constrained('companies')->default(auth()->user()?->company_id);
      $table->timestamps();
    });
  }
  public function down() {
    Schema::dropIfExists('sales_locations');
  }
};

