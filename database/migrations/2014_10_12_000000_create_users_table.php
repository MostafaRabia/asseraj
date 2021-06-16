<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 30);
            $table->string('last_name', 30);
            $table->string('email');
            $table->string('emailsig', 30)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone');
            $table->unsignedTinyInteger('age');
            $table->boolean('gender');
            $table->string('country');
            $table->string('state');
            $table->string('city');
            $table->string('section')->nullable();
            $table->string('image')->nullable();
            $table->json('reads')->nullable();
            $table->text('information')->nullable();
            $table->double('rate', 3, 2)->default(0);
            $table->unsignedTinyInteger('minutes')->default(0);
            $table->unsignedTinyInteger('money')->default(0);
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('google')->nullable();
            $table->string('ip', 45);
            $table->string('timezone', 64);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
