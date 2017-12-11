<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApiTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('api_tokens', function (Blueprint $table) {
            $table->char('user_id',32);
            $table->char('application_id',32);
            $table->string('token');
            $table->timestamp('expire');
            $table->timestamps();

            $table->primary(['user_id', 'application_id']);
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('application_id')->references('id')->on('api_applications');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('api_tokens');
    }
}
