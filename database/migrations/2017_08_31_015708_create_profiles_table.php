<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->char('id', 32)->primary();
            $table->char('user_id', 32);
            $table->string('icon_path');
            $table->text('intro');
            $table->date('birthday');
            $table->string('gender');
            $table->string('twitter')->default('');
            $table->string('facebook')->default('');
            $table->string('instagram')->default('');
//            $table->timestamps();

            // constraint
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
