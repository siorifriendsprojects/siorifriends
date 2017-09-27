<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnchorBookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anchor_book', function (Blueprint $table) {
            $table->char('book_id', 32);
            $table->char('anchor_id', 32);
            $table->string('name');
            $table->timestampsTz();

            // constraints
            $table->primary(['book_id', 'anchor_id']);
            $table->foreign('book_id')->references('id')->on('books');
            $table->foreign('anchor_id')->references('id')->on('anchors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('anchor_book');
    }
}
