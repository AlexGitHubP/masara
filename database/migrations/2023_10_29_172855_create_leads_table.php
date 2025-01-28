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
        Schema::create('leads', function (Blueprint $table) {
            $table->bigIncrements('id')->length(10);
            $table->string('name',255);
            $table->string('email',255);
            $table->string('phone',255);
            $table->string('county',255);
            $table->string('city',255);
            $table->string('subject', 255);
            $table->text('message');
            $table->boolean('terms');
            $table->boolean('gdpr');
            $table->boolean('nl');
            $table->string('source',255);
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leads');
    }
};
