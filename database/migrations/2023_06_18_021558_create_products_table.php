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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('shop_id');
            $table->unsignedBigInteger('cat_id');
            $table->unsignedBigInteger('condition_id');
            $table->json('images')->nullable();
            $table->tinyInteger('is_variant')->nullable();
            $table->tinyInteger('is_pre_order')->nullable();
            $table->tinyInteger('is_buy_more_discount')->nullable();
            $table->tinyInteger('is_hidden')->nullable();
            $table->string('name', 255);
            $table->string('slug', 300)->unique();
            $table->string('detail', 1500);
            $table->string('brand', 100)->nullable();
            $table->unsignedInteger('inventory')->default(0);
            $table->unsignedInteger('sold')->default(0);
            $table->unsignedDouble('price');
            $table->unsignedDouble('promotional_price')->nullable();
            $table->unsignedDouble('rating')->default(0);
            $table->unsignedDouble('weight');
            $table->unsignedDouble('length');
            $table->unsignedDouble('width');
            $table->unsignedDouble('height');
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
        Schema::dropIfExists('products');
    }
};
