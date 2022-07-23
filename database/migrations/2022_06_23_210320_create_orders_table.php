<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('carrier_id')->nullable();
            $table->unsignedBigInteger('cart_id');
            $table->unsignedBigInteger('coupon_id')->nullable();
            $table->double('total_cost');
            $table->text('rejection_reason')->nullable();
            $table->float('coupon_value')->nullable();
            $table->boolean('is_special')->default(0);
            $table->enum('status', ['pending','on-way','completed','rejected'])->default('pending');
            $table->timestamps();
            $table->foreign('user_id')->on('users')->references('id');
            $table->foreign('cart_id')->on('carts')->references('id');
            $table->foreign('coupon_id')->on('coupons')->references('id')->onDelete('set null');
            $table->foreign('carrier_id')->on('carriers')->references('id')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
