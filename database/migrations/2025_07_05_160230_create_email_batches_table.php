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
        Schema::create('email_batches', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('email_list_id')->nullable();
            $table->string('subject');
            $table->text('content');
            $table->unsignedBigInteger('total_emails');
            $table->unsignedBigInteger('sent_emails')->default(0);
            $table->unsignedBigInteger('failed_emails')->default(0);
            $table->string('status')->default('pending');
            $table->timestamp('scheduled_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('email_list_id')->references('id')->on('email_lists')->onDelete('set null');
        });

        Schema::create('email_batch_failures', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('email_batch_id');
            $table->string('email');
            $table->string('reason');
            $table->timestamps();

            $table->foreign('email_batch_id')->references('id')->on('email_batches')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('email_batch_failures');
        Schema::dropIfExists('email_batches');
    }
};
