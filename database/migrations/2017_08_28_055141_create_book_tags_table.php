<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_tags', function (Blueprint $table) {
            $table->char('id', 32)->primary();
            $table->char('book_id', 32);
            $table->foreign('book_id')->references('id')->on('books');
            $table->char('tag_id', 32);
            $table->foreign('tag_id')->references('id')->on('tags');
//            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_tags');
    }
}
