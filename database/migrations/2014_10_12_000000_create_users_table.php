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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('username', 20)->nullable()->unique();
            $table->string('password', 255)->nullable();
            $table->string("fullname", 255)->nullable();
            $table->string("avatar", 500)->nullable();
            $table->string("last_receiver", 255)->nullable();
            $table->string("last_address", 255)->nullable();
            $table->string("last_phone", 255)->nullable();
            $table->date("birthday")->nullable();
            $table->tinyInteger("gender")->default(0)->nullable();
            $table->string('invite_code', 10)->unique();
            $table->string('introduced_code', 10)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
