<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->unsignedBigInteger('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('location')->nullable();
            $table->string('gender')->nullable();
            $table->string('age')->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->string('relationship')->nullable();
            $table->string('hair')->nullable();
            $table->string('occupation')->nullable();
            $table->string('body_type')->nullable();
            $table->string('interests')->nullable();
            $table->string('children')->nullable();
            $table->string('sports')->nullable();
            $table->string('personality')->nullable();
            $table->string('nationality')->nullable();
            $table->string('religion')->nullable();
            $table->string('smoking')->nullable();
            $table->string('avatar')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
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
        Schema::dropIfExists('profiles');
    }
}
