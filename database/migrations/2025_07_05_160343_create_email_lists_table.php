<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
     public function up()
    {
        Schema::create('email_lists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('email_list_subscribers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('email_list_id');
            $table->string('email');
            $table->timestamps();

            $table->foreign('email_list_id')->references('id')->on('email_lists')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('email_list_subscribers');
        Schema::dropIfExists('email_lists');
    }
};
