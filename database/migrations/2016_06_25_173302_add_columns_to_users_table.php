<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('lastname')->after('name')->nullable();
            $table->string('phone')->after('email_verified_at')->nullable();
            $table->string('country')->after('phone')->nullable();
            $table->timestamp("last_seen")->nullable();
            $table->tinyInteger("is_online")->default(0)->nullable();
            $table->tinyInteger("is_active")->default(0)->nullable();
            $table->text("about")->nullable();
            $table->string("photo_url")->nullable();
            $table->string("activation_code")->nullable();
            $table->tinyInteger("is_system")->default(0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('lastname');
            $table->dropColumn('phone');
            $table->dropColumn('country');
        });
    }
}
