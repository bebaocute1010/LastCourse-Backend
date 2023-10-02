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
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('code', 12);
            $table->date('date_begin');
            $table->date('date_end');
            $table->unsignedTinyInteger('discount_unit');
            $table->integer('discount_level');
            $table->integer('quantity')->nullable()->default(null);
            $table->text('destination');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vouchers');
    }
};
