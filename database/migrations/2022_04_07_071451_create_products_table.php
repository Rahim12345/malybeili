<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->string('name_az');
            $table->string('name_en');
            $table->string('name_ru');
            $table->string('slug_az');
            $table->string('slug_en');
            $table->string('slug_ru');
            $table->text('about_az');
            $table->text('about_en');
            $table->text('about_ru');
            $table->float('price',10,2);
            $table->float('discount',10,2)->default(0);
            $table->integer('stock');
            $table->string('color_az')->nullable();
            $table->string('color_en')->nullable();
            $table->string('color_ru')->nullable();
            $table->string('size_az')->nullable();
            $table->string('size_en')->nullable();
            $table->string('size_ru')->nullable();
            $table->boolean('hidden')->default(0)->comment('0 - show, 1 - hide');
            $table->timestamps();

            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
