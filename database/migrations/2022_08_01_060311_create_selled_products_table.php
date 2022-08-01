<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSelledProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('selled_products', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->integer('mehsul_id');
            $table->integer('say');
            $table->decimal('cari_qiymet');
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
        Schema::dropIfExists('selled_products');
    }
}
