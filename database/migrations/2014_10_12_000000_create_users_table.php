<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * 一般ユーザー
 *
 * Class CreateUsersTable
 */
class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id', 16)->unique();
            $table->string('screen_name', 16);
            $table->string('email', 256)->unique();
            $table->string('password')->nullable();
            $table->string('avatar')->default('http://placehold.it/150x150'); // TODO: デフォルトのパスを書く
            $table->string('biography', 128)->default('');
            $table->string('access_token')->nullable();
            $table->unsignedBigInteger('posted')->default(0);
            $table->unsignedBigInteger('following')->default(0);
            $table->unsignedBigInteger('followed')->default(0);
            $table->timestamp('access_token_deadline_at')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('users');
    }
}
