<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->string("code", 16)->unique();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('shop_id');
            $table->unsignedBigInteger('carrier_id');
            $table->string('receiver', 50);
            $table->string('phone', 20);
            $table->string('address', 500);
            $table->unsignedDouble('shipping_fee')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->unsignedDouble('total')->default(0);
            $table->tinyInteger("payment_method");
            $table->string("note")->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('bills');
    }
};
