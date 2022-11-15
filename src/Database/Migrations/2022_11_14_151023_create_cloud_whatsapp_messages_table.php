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
        Schema::create('cloud_whatsapp_messages', function (Blueprint $table) {
            $table->id();
            $table->string('message_key');
            $table->string('message_id')->nullable();
            $table->text('message')->nullable();
            $table->string('number_phone')->nullable();
            $table->string('status')->nullable();
            $table->string('state')->nullable();
            $table->string('status_description')->nullable();
            $table->dateTime('send_date')->nullable();
            $table->dateTime('delivered_date')->nullable();
            $table->dateTime('read_date')->nullable();
            $table->dateTime('dispatched_date')->nullable();
            $table->text('errors')->nullable();
            $table->text('error_details')->nullable();
            $table->boolean('billable')->default(true);
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
        Schema::dropIfExists('cloud_whatsapp_messages');
    }
};
