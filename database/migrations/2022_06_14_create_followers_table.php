<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('followers', function (Blueprint $table) {
            $table->string("follower");
            $table->string("following"); 

            $table->timestamps();

            $table->foreign("follower")->references("nomeUtente")->on("users");
            $table->foreign("following")->references("nomeUtente")->on("users");

            $table->primary(['follower', 'following']);
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
        Schema::dropIfExists('followers');
    }
}
