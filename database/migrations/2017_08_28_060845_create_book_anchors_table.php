<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookAnchorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_anchors', function (Blueprint $table) {
            $table->char('id', 32)->primary();
            $table->char('book_id', 32);
            $table->char('anchor_id', 32);
//            $table->timestamps();

            // constraint
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
        Schema::dropIfExists('book_anchors');
    }
}
