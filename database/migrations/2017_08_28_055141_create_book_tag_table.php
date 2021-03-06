<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_tag', function (Blueprint $table) {
            $table->char('book_id', 32);
            $table->char('tag_id', 32);
            $table->timestampTz('created_at');
//            $table->timestamps();

            // constraints
            $table->primary(['book_id', 'tag_id']);
            $table->foreign('book_id')->references('id')->on('books');
            $table->foreign('tag_id')->references('id')->on('tags');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_tag');
    }
}
