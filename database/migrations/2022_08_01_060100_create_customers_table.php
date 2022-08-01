<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('ad')->nullable();
            $table->string('soyad')->nullable();
            $table->string('unvan')->nullable();
            $table->string('poct_kodu')->nullable();
            $table->string('email')->nullable();
            $table->string('telefon')->nullable();
            $table->text('elave_serh')->nullable();
            $table->boolean('kuryerle_odenis')->default(0)->comment('1 - kuryerlə ödənişdi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
