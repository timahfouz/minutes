<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cart_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('offer_id')->nullable();
            $table->bigInteger('qty')->default(1);
            $table->float('price');
            $table->string('unit');
            $table->timestamps();
            $table->foreign('cart_id')->on('carts')->references('id');
            $table->foreign('product_id')->on('products')->references('id');
            $table->foreign('offer_id')->on('offers')->references('id')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_items');
    }
}
