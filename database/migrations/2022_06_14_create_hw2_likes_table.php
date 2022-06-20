<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHw2LikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hw2Likes', function (Blueprint $table) {
            $table->unsignedBigInteger("post_id");
            $table->string("nomeUtente"); 

            $table->timestamps();

            $table->foreign("post_id")->references("id")->on("posts");
            $table->foreign("nomeUtente")->references("nomeUtente")->on("users");

            $table->primary(['post_id', 'nomeUtente']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('hw2Likes');
    }
}
